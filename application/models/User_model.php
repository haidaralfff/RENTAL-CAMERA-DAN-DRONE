<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';

    public function get_by_email($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_all()
    {
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function create($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['role']     = 'user';
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function toggle_status($id)
    {
        $user = $this->get_by_id($id);
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => !$user->status]);
    }

    public function verify_password($plain, $hash)
    {
        return password_verify($plain, $hash);
    }

    public function email_exists($email, $exclude_id = null)
    {
        $this->db->where('email', $email);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) > 0;
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function count_by_role($role)
    {
        return $this->db->where('role', $role)->count_all_results($this->table);
    }
}
