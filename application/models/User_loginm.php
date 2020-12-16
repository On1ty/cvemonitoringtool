<?php

class User_loginm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login_user()
    {
        $this->db->where('client_email', $this->input->post('user-email', true));
        $query = $this->db->get('clients');
        $row = $query->row_array();

        $hashed = $row ? $row['client_pass'] : '';
        if (password_verify($this->input->post('user-pass', true), $hashed)) {

            $this->db->from('clients');
            $this->db->join('clients_info', "clients.id_lead = clients_info.id_lead", 'left');
            $this->db->where('clients.id_lead', $row['id_lead']);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function checkActivation($id = null)
    {
        $this->db->select('isActive');
        $this->db->where('emp_id', $id);
        $query = $this->db->get('clients');
        return $query;
    }
}
