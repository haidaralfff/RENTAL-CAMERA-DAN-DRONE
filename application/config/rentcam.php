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
