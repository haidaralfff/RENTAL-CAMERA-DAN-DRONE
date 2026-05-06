<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Superadmin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Laporan_model', 'Booking_model']);
    }

    public function index()
    {
        $this->Booking_model->expire_pending();
        $summary = $this->Laporan_model->get_summary();
        $data = [
            'title'              => 'Dashboard Super Admin — RENTCAM',
            'summary'            => $summary,
            'pendapatan_bulanan' => $this->Laporan_model->get_pendapatan_bulanan(),
            'produk_terlaris'    => $this->Laporan_model->get_produk_terlaris(),
            'booking_status'     => $this->Laporan_model->get_booking_status_summary(),
        ];
        $this->load->view('superadmin/dashboard', $data);
    }
}
