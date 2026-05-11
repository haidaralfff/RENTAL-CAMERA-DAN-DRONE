<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| RENTCAM System Configuration
|--------------------------------------------------------------------------
| Centralized settings for the application.
*/

$config['site_name'] = 'RENTCAM';
$config['site_tagline'] = 'Rental Kamera & Drone Profesional';

$config['bank_accounts'] = [
    [
        'bank' => 'BCA',
        'number' => '1234 5678 9012',
        'holder' => 'RENTCAM OFFICIAL'
    ],
    [
        'bank' => 'Mandiri',
        'number' => '098 7654 3210',
        'holder' => 'RENTCAM OFFICIAL'
    ],
    [
        'bank' => 'BNI',
        'number' => '5566 7788 9900',
        'holder' => 'RENTCAM OFFICIAL'
    ]
];

$config['contact_email'] = 'support@rentcam.com';
$config['contact_phone'] = '0812-3456-7890';

// Business Address
$config['office_address'] = 'Jl. Mawar No. 7, Desa Banjar Jaya, Kecamatan Manohara, Kab. Kebumen, Jawa Tengah, Indonesia';

// Business Description
$config['site_description'] = 'Solusi penyewaan kamera dan drone profesional terlengkap. Temukan alat terbaik untuk setiap momen kreatif Anda.';

// Google Maps Embed URL
$config['google_maps_embed'] = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2818742296415!2d109.6548!3d-7.6747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDAnMjguOCJTIDEwOcKwMzknMTcuMyJF!5e0!3m2!1sen!2sid!4v1715347200000!5m2!1sen!2sid';
