<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Laporan_model', 'Booking_model', 'Pembayaran_model']);
    }

    public function index()
    {
        $this->Booking_model->expire_pending();
        $summary = $this->Laporan_model->get_summary();
        $data = [
            'title'           => 'Dashboard Admin — RENTCAM',
            'summary'         => $summary,
            'recent_bookings' => $this->Booking_model->get_recent(5),
            'produk_terlaris' => $this->Laporan_model->get_produk_terlaris(5),
            'booking_harian'  => $this->Laporan_model->get_booking_harian(14),
            'pembayaran_status' => $this->Laporan_model->get_pembayaran_by_status(),
            'stok_rendah'     => $this->Laporan_model->get_stok_rendah(5),
        ];
        $this->load->view('admin/dashboard', $data);
    }
}
