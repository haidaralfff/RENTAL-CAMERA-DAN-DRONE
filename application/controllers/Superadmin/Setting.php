<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Superadmin_Controller
{
    public function index()
    {
        $data = ['title' => 'Pengaturan Sistem — Super Admin RENTCAM'];
        $this->load->view('superadmin/setting/index', $data);
    }
}
