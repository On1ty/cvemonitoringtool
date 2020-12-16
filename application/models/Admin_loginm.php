<?php

class Admin_loginm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function admin_login($username, $password)
    {
        // 1); //Administrator
        // 4); //Super User
        $query = $this->db->query('SELECT * FROM employee WHERE (emp_name="' . $username . '") AND (role = 1 OR role = 4)');
        $row = $query->row_array();

        $hashed = $row ? $row['emp_pass'] : '';
        if (password_verify($password, $hashed))
            return $row;
    }
}
