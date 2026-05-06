<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Booking_model', 'Booking_detail_model', 'Produk_model']);
    }

    public function index()
    {
        $this->Booking_model->expire_pending();
        $data = [
            'title'    => 'Manajemen Booking — Admin RENTCAM',
            'bookings' => $this->Booking_model->get_all(),
        ];
        $this->load->view('admin/booking/index', $data);
    }

    public function detail($id)
    {
        $booking = $this->Booking_model->get_by_id($id);
        if (!$booking) show_404();

        $data = [
            'title'   => 'Detail Booking #' . $id,
            'booking' => $booking,
            'detail'  => $this->Booking_detail_model->get_by_booking($id),
        ];
        $this->load->view('admin/booking/detail', $data);
    }

    public function update_status($id)
    {
        $status = $this->input->post('status', TRUE);
        $valid  = ['pending', 'confirmed', 'dipinjam', 'kembali', 'batal'];

        if (!in_array($status, $valid)) {
            $this->session->set_flashdata('error', 'Status tidak valid.');
            redirect('admin/booking/detail/' . $id);
        }

        $this->Booking_model->update_status($id, $status);
        $this->session->set_flashdata('success', 'Status booking berhasil diperbarui.');
        redirect('admin/booking/detail/' . $id);
    }
}
