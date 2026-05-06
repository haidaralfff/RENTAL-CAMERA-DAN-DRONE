<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller — Base controller for all RENTCAM controllers.
 * Handles role-based access control and shared data.
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (function_exists('normalize_role')) {
            $role = $this->session->userdata('role');
            if (!empty($role)) {
                $normalized = normalize_role($role);
                if ($normalized !== $role) {
                    $this->session->set_userdata('role', $normalized);
                }
            }
        }
    }

    /**
     * Load a view with a layout wrapper.
     */
    protected function render($view, $data = [], $layout = 'templates/main_layout')
    {
        $data['content_view'] = $view;
        $this->load->view($layout, $data);
    }
}

/**
 * Guest_Controller — For public pages (no login required).
 */
class Guest_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // If already logged in, redirect to appropriate dashboard
        if ($this->session->userdata('user_id')) {
            $role = normalize_role($this->session->userdata('role'));

            // Fallback: refresh role from DB if missing or unexpected
            if (empty($role) || !in_array($role, ['user', 'admin', 'superadmin'], true)) {
                $this->load->model('User_model');
                $user = $this->User_model->get_by_id($this->session->userdata('user_id'));
                if ($user) {
                    $role = normalize_role($user->role);
                    $this->session->set_userdata('role', $role);
                }
            }

            redirect_by_role($role);
        }
    }
}

/**
 * User_Controller — For authenticated users (member only).
 */
class User_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if (normalize_role($this->session->userdata('role')) !== 'user') {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403);
        }
    }
}

/**
 * Admin_Controller — For authenticated admins.
 */
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        $role = normalize_role($this->session->userdata('role'));
        if (!in_array($role, ['admin', 'superadmin'], true)) {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403);
        }
    }
}

/**
 * Superadmin_Controller — For superadmin only.
 */
class Superadmin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        if (normalize_role($this->session->userdata('role')) !== 'superadmin') {
            show_error('Anda tidak memiliki akses ke halaman ini.', 403);
        }
    }
}
