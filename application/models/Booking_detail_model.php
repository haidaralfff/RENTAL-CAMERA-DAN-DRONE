<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_detail_model extends CI_Model
{
    protected $table = 'booking_detail';

    public function get_by_booking($booking_id)
    {
        $this->db->select('booking_detail.*, produk.nama as nama_produk, produk.kategori, produk.foto');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id = booking_detail.produk_id');
        $this->db->where('booking_detail.booking_id', $booking_id);
        return $this->db->get()->result();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function create_batch($data_array)
    {
        return $this->db->insert_batch($this->table, $data_array);
    }

    public function delete_by_booking($booking_id)
    {
        return $this->db->delete($this->table, ['booking_id' => $booking_id]);
    }
}
