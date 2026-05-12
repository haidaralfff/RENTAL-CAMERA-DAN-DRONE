<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Superadmin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Laporan_model', 'Pembayaran_model', 'Booking_model']);
    }

    public function index()
    {
        $tahun = $this->input->get('tahun', TRUE) ?? date('Y');
        $data  = [
            'title'                 => 'Laporan — Super Admin RENTCAM',
            'pendapatan_bulanan'    => $this->Laporan_model->get_pendapatan_bulanan($tahun),
            'produk_terlaris'       => $this->Laporan_model->get_produk_terlaris(10),
            'total_pendapatan_tahun'=> $this->Pembayaran_model->get_total_pendapatan($tahun),
            'total_pendapatan_all'  => $this->Pembayaran_model->get_total_pendapatan(),
            'list_tahun'            => $this->Laporan_model->get_list_tahun(),
            'tahun'                 => $tahun,
            'all_bookings'          => $this->Booking_model->get_all(),
        ];
        $this->load->view('superadmin/laporan/index', $data);
    }

    public function detail($id)
    {
        $this->load->model(['Booking_model', 'Booking_detail_model']);
        $booking = $this->Booking_model->get_by_id($id);
        if (!$booking) show_404();

        $data = [
            'title'      => 'Detail Laporan #' . $id,
            'booking'    => $booking,
            'detail'     => $this->Booking_detail_model->get_by_booking($id),
            'pembayaran' => $this->Pembayaran_model->get_by_booking($id),
        ];
        $this->load->view('superadmin/laporan/detail', $data);
    }

    public function export()
    {
        $this->load->helper('export');
        $bookings = $this->Booking_model->get_all();
        $site_name = $this->config->item('site_name');
        
        $filename = "Laporan_Keuangan_" . str_replace(' ', '_', $site_name) . "_" . date('Y-m-d') . ".csv";
        
        // Definisikan Header Tabel
        $headers = ['ID Booking', 'Pelanggan', 'Mulai', 'Selesai', 'Total', 'Status'];
        
        // Siapkan Data
        $export_data = [];
        $total_pendapatan = 0;
        
        foreach ($bookings as $b) {
            $export_data[] = [
                "#" . $b->id,
                $b->nama_user,
                date('d M Y', strtotime($b->tanggal_mulai)),
                date('d M Y', strtotime($b->tanggal_selesai)),
                "Rp " . number_format($b->total_harga, 0, ',', '.'),
                strtoupper($b->status)
            ];
            
            if (in_array($b->status, ['confirmed', 'kembali'])) {
                $total_pendapatan += $b->total_harga;
            }
        }
        
        // Metadata Laporan
        $metadata = [
            'title'    => "Laporan Keuangan " . $site_name,
            'subtitle' => "Rekapitulasi seluruh transaksi penyewaan kamera & drone",
            'footer'   => [
                ['', '', '', 'TOTAL PENDAPATAN:', "Rp " . number_format($total_pendapatan, 0, ',', '.')]
            ]
        ];

        // Eksekusi Helper
        export_to_excel($filename, $headers, $export_data, $metadata);
    }
}
