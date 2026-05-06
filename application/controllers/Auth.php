<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        // Jika sudah login, lempar ke dashboard sesuai role
        if ($this->session->userdata('user_id')) {
            redirect_by_role($this->session->userdata('role'));
        }
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email',    'Email',    'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('auth/login', ['error' => validation_errors()]);
                return;
            }

            $email    = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $user     = $this->User_model->get_by_email($email);

            if (!$user || !$this->User_model->verify_password($password, $user->password)) {
                $this->load->view('auth/login', ['error' => 'Email atau password salah.']);
                return;
            }

            if (!$user->status) {
                $this->load->view('auth/login', ['error' => 'Akun Anda dinonaktifkan. Hubungi admin.']);
                return;
            }

            $role = normalize_role($user->role);
            $this->session->set_userdata([
                'user_id' => $user->id,
                'nama'    => $user->nama,
                'email'   => $user->email,
                'role'    => $role,
            ]);

            redirect_by_role($role);
        }

        $this->load->view('auth/login');
    }

    public function register()
    {
        // Jika sudah login, jangan boleh daftar lagi
        if ($this->session->userdata('user_id')) {
            redirect_by_role($this->session->userdata('role'));
        }
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama',     'Nama',            'required|min_length[3]');
            $this->form_validation->set_rules('email',    'Email',            'required|valid_email');
            $this->form_validation->set_rules('password', 'Password',         'required|min_length[6]');
            $this->form_validation->set_rules('confirm',  'Konfirmasi Password', 'required|matches[password]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('auth/register', ['error' => validation_errors()]);
                return;
            }

            $email = $this->input->post('email', TRUE);
            if ($this->User_model->email_exists($email)) {
                $this->load->view('auth/register', ['error' => 'Email sudah terdaftar.']);
                return;
            }

            $this->User_model->create([
                'nama'     => $this->input->post('nama', TRUE),
                'email'    => $email,
                'password' => $this->input->post('password'),
            ]);

            $this->session->set_flashdata('success', 'Registrasi berhasil! Silahkan login.');
            redirect('login');
        }

        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
