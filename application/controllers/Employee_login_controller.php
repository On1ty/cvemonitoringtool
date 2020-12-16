<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_login_controller extends CI_Controller
{
    public function index()
    {
        if ($this->session->employee_logged) {
            redirect('employee/clients');
        }

        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback" style="display:block;">', '</span>');
        $this->form_validation->set_rules('emp-name', 'Name', 'trim|required', array('required' => 'Please enter Employee Name'));
        $this->form_validation->set_rules('emp-pass', 'Password', 'required', array('required' => 'Please enter Employee Password'));
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha', array('required' => 'Please check the captcha form'));

        if ($this->form_validation->run() == false) {
            $page = 'login';
            $this->load->view('employee/' . $page);
        } else {
            $username = $this->input->post('emp-name', true);
            $password = $this->input->post('emp-pass', true);

            $result = $this->EmployeeDatabase->employee_login($username, $password);

            if (!isset($result)) {
                $this->session->set_flashdata('invalid_emp', 'The username or password is incorrect');
                redirect('employee');
            }

            $session_data = array(
                'employee_first' => $result['emp_first'],
                'employee_middle' => $result['emp_middle'],
                'employee_last' => $result['emp_last'],
                'employee_id' => $result['emp_id'],
                'employee_realid' => $result['real_id'],
                'employee_role' => $result['role'],
                'employee_logged' => true,
            );

            $this->session->set_userdata($session_data);
            redirect('employee/clients');
        }
    }

    public function validate_captcha()
    {
        $captcha = $this->input->post('g-recaptcha-response', true);
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcB27wZAAAAAJKouSYP4bc6S4wlnVWqRr9KY9fG&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

        return ($response . 'success' == false) ? false : true;
    }
}
