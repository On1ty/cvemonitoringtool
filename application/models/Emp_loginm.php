<?php

class Emp_loginm extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function emp_login($username, $password)
    {
        // 2); //Marketing
        // 3); //Documentation
        // 4); //Approver
        // 5); //Super User
        $query = $this->db->query('SELECT * FROM employee WHERE (emp_name="' . $username . '") AND (role = 2 OR role = 3 OR role = 4 OR role = 5)');
        $row = $query->row_array();

        $hashed = $row ? $row['emp_pass'] : '';
        if (password_verify($password, $hashed))
            return $row;
    }
}
