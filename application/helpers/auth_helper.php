<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * auth_helper.php
 * Helper functions for authentication and role-based redirection.
 */

if (!function_exists('normalize_role')) {
    function normalize_role($role)
    {
        $role = strtolower(trim((string) $role));
        $role = preg_replace('/[^a-z0-9]/', '', $role);

        $map = [
            'superadmin' => 'superadmin',
            'admin'      => 'admin',
            'administrator' => 'admin',
            'user'       => 'user',
            'member'     => 'user',
        ];

        if (isset($map[$role])) {
            return $map[$role];
        }

        // Tolerate extra labels like "adminrentcam" or "superadminrentcam"
        if (strpos($role, 'super') !== false && strpos($role, 'admin') !== false) {
            return 'superadmin';
        }
        if (strpos($role, 'admin') !== false) {
            return 'admin';
        }
        if (strpos($role, 'user') !== false || strpos($role, 'member') !== false) {
            return 'user';
        }

        return $role;
    }
}

if (!function_exists('redirect_by_role')) {
    function redirect_by_role($role)
    {
        $role = normalize_role($role);
        if ($role === 'superadmin') {
            redirect('superadmin');
        } elseif ($role === 'admin') {
            redirect('admin');
        } else {
            // Untuk user biasa, tetap di halaman home jika sudah di home
            if (uri_string() !== '') {
                redirect('/');
            }
        }
    }
}

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI =& get_instance();
        return (bool) $CI->session->userdata('user_id');
    }
}

if (!function_exists('current_user')) {
    function current_user()
    {
        $CI =& get_instance();
        return [
            'id'    => $CI->session->userdata('user_id'),
            'nama'  => $CI->session->userdata('nama'),
            'email' => $CI->session->userdata('email'),
            'role'  => normalize_role($CI->session->userdata('role')),
        ];
    }
}

if (!function_exists('has_role')) {
    function has_role($role)
    {
        $CI =& get_instance();
        return normalize_role($CI->session->userdata('role')) === normalize_role($role);
    }
}
