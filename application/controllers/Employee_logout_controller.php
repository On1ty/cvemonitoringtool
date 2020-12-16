<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_logout_controller extends CI_Controller
{
    public function index()
    {
        $this->session->unset_userdata('employee_first');
        $this->session->unset_userdata('employee_pmiddle');
        $this->session->unset_userdata('employee_last');
        $this->session->unset_userdata('employee_logged');
        $this->session->unset_userdata('employee_realid');
        $this->session->unset_userdata('employee_role');
        $this->session->unset_userdata('employee_id');
        redirect('employee');
    }
}
