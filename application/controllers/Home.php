<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Guest_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Produk_model', 'Review_model']);
    }

    public function index()
    {
        if (is_logged_in()) {
            $role = normalize_role($this->session->userdata('role'));
            if (empty($role) || !in_array($role, ['user', 'admin', 'superadmin'], true)) {
                $this->load->model('User_model');
                $user = $this->User_model->get_by_id($this->session->userdata('user_id'));
                if ($user) {
                    $role = normalize_role($user->role);
                    $this->session->set_userdata('role', $role);
                }
            }

            if ($role !== 'user') {
                redirect_by_role($role);
            }
        }
        $produk_unggulan = $this->Produk_model->get_tersedia();
        $data = [
            'title'           => 'RENTCAM — Sewa Kamera & Drone',
            'produk_unggulan' => $produk_unggulan,
        ];
        $this->load->view('user/home', $data);
    }
}
