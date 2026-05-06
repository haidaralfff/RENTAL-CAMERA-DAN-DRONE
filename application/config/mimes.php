<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Minimal MIME type mappings for image uploads.
return [
    'jpg'  => ['image/jpeg', 'image/pjpeg'],
    'jpeg' => ['image/jpeg', 'image/pjpeg'],
    'jpe'  => ['image/jpeg', 'image/pjpeg'],
    'png'  => ['image/png',  'image/x-png'],
    'gif'  => 'image/gif',
    'webp' => 'image/webp',
    'jfif' => 'image/jpeg',
];
