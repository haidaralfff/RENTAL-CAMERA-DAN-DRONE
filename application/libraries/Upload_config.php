<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * upload_config.php
 * Library for centralized file upload configuration.
 */
class Upload_config
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Upload bukti pembayaran (image only).
     * Returns array ['status' => bool, 'data' => filename|error_msg]
     */
    public function upload_bukti($field_name = 'bukti_bayar')
    {
        $upload_path = FCPATH . 'assets/uploads/bukti/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp|jfif',
            'max_size'      => 71680, // 70MB (KB)
            'encrypt_name'  => TRUE,
        ];

        if (!isset($this->CI->upload)) {
            $this->CI->load->library('upload', $config);
        } else {
            $this->CI->upload->initialize($config);
        }

        if (!$this->CI->upload->do_upload($field_name)) {
            return ['status' => false, 'data' => $this->CI->upload->display_errors('', '')];
        }

        $upload_data = $this->CI->upload->data();
        return ['status' => true, 'data' => $upload_data['file_name']];
    }

    /**
     * Upload foto produk (image only).
     */
    public function upload_produk($field_name = 'foto')
    {
        $upload_path = FCPATH . 'assets/uploads/produk/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp|jfif',
            'max_size'      => 71680, // 70MB (KB)
            'encrypt_name'  => TRUE,
        ];

        if (!isset($this->CI->upload)) {
            $this->CI->load->library('upload', $config);
        } else {
            $this->CI->upload->initialize($config);
        }

        if (!$this->CI->upload->do_upload($field_name)) {
            return ['status' => false, 'data' => $this->CI->upload->display_errors('', '')];
        }

        $upload_data = $this->CI->upload->data();
        return ['status' => true, 'data' => $upload_data['file_name']];
    }
}
