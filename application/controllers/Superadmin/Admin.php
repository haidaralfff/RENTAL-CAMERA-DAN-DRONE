<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Superadmin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->db->where('role', 'admin');
        $admins = $this->db->get('users')->result();
        $data   = [
            'title'  => 'Manajemen Admin — Super Admin RENTCAM',
            'admins' => $admins,
        ];
        $this->load->view('superadmin/admin/index', $data);
    }

    public function tambah()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama',     'Nama',     'required');
            $this->form_validation->set_rules('email',    'Email',    'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('superadmin/admin/tambah', ['error' => validation_errors()]);
                return;
            }

            $email = $this->input->post('email', TRUE);
            if ($this->User_model->email_exists($email)) {
                $this->load->view('superadmin/admin/tambah', ['error' => 'Email sudah terdaftar.']);
                return;
            }

            $this->db->insert('users', [
                'nama'     => $this->input->post('nama', TRUE),
                'email'    => $email,
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role'     => 'admin',
                'status'   => 1,
            ]);

            $this->session->set_flashdata('success', 'Admin berhasil ditambahkan.');
            redirect('superadmin/admin');
        }

        $this->load->view('superadmin/admin/tambah', ['title' => 'Tambah Admin — Super Admin RENTCAM']);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id)->where('role', 'admin')->delete('users');
        $this->session->set_flashdata('success', 'Admin berhasil dihapus.');
        redirect('superadmin/admin');
    }
}
