<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function get_booking_harian($days = 14)
    {
        $start = date('Y-m-d', strtotime('-' . (int)$days . ' days'));
        $this->db->select('DATE(booking.created_at) as tanggal, COUNT(*) as total');
        $this->db->from('booking');
        $this->db->where('booking.status !=', 'batal');
        $this->db->where('booking.created_at >=', $start);
        $this->db->group_by('DATE(booking.created_at)');
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get()->result();
    }

    public function get_pembayaran_by_status()
    {
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('pembayaran');
        $this->db->group_by('status');
        return $this->db->get()->result();
    }

    public function get_stok_rendah($limit = 5, $threshold = 3)
    {
        $this->db->select('nama, stok');
        $this->db->from('produk');
        $this->db->where('status', 'tersedia');
        $this->db->where('stok <=', (int)$threshold);
        $this->db->order_by('stok', 'ASC');
        $this->db->limit((int)$limit);
        return $this->db->get()->result();
    }

    public function get_booking_status_summary()
    {
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('booking');
        $this->db->group_by('status');
        return $this->db->get()->result();
    }

    public function get_pendapatan_bulanan($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        $this->db->select('MONTH(pembayaran.created_at) as bulan, SUM(booking.total_harga) as total');
        $this->db->from('pembayaran');
        $this->db->join('booking', 'booking.id = pembayaran.booking_id');
        $this->db->where('pembayaran.status', 'verified');
        $this->db->where('YEAR(pembayaran.created_at)', $tahun);
        $this->db->group_by('MONTH(pembayaran.created_at)');
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get()->result();
    }

    public function get_produk_terlaris($limit = 5)
    {
        $this->db->select('produk.nama, produk.kategori, SUM(booking_detail.qty) as total_sewa');
        $this->db->from('booking_detail');
        $this->db->join('produk', 'produk.id = booking_detail.produk_id');
        $this->db->join('booking', 'booking.id = booking_detail.booking_id');
        $this->db->where_in('booking.status', ['confirmed', 'dipinjam', 'kembali']);
        $this->db->group_by('booking_detail.produk_id');
        $this->db->order_by('total_sewa', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_summary()
    {
        $CI =& get_instance();
        $CI->load->model(['Booking_model', 'Pembayaran_model', 'User_model', 'Produk_model']);
        return [
            'total_booking'    => $CI->Booking_model->count_all(),
            'total_user'       => $CI->User_model->count_by_role('user'),
            'total_produk'     => $CI->Produk_model->count_all(),
            'total_pendapatan' => $CI->Pembayaran_model->get_total_pendapatan(),
            'pending_bayar'    => $CI->Pembayaran_model->count_by_status('pending'),
            'booking_pending'  => $CI->Booking_model->count_by_status('pending'),
        ];
    }
}
