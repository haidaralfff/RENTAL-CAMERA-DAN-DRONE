<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * rupiah_helper.php
 * Helper functions for Indonesian Rupiah currency formatting.
 */

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = [
            1  => 'Januari', 2  => 'Februari', 3  => 'Maret',
            4  => 'April',   5  => 'Mei',       6  => 'Juni',
            7  => 'Juli',    8  => 'Agustus',   9  => 'September',
            10 => 'Oktober', 11 => 'November',  12 => 'Desember',
        ];
        $pecah = explode('-', $tanggal);
        return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
    }
}

if (!function_exists('hitung_durasi')) {
    function hitung_durasi($tanggal_mulai, $tanggal_selesai)
    {
        $mulai   = new DateTime($tanggal_mulai);
        $selesai = new DateTime($tanggal_selesai);
        $diff    = $mulai->diff($selesai);
        
        return ($diff->days == 0) ? 1 : $diff->days;
    }
}
