<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_settings_controller extends CI_Controller
{

    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $data['emp'] = $this->EmployeeDatabase->employeeDetails($this->session->employee_id);
        $this->load->view('employee/templates/header');
        $this->load->view('employee/settings', $data);
        $this->load->view('employee/templates/footer');
        $this->load->view('employee/templates/custom_script_settings');
        $this->load->view('employee/templates/end_footer');
    }

    public function changeInfo()
    {
        $data = array(
            'emp_first' => $this->input->post('first_name', true),
            'emp_middle' => $this->input->post('middle_name', true),
            'emp_last' => $this->input->post('last_name', true),
        );

        try {
            $this->EmployeeDatabase->updateEmployeeInfo($this->session->employee_id, $data);
            $json = array(
                'error' => 0,
            );
        } catch (\Throwable $th) {
            throw $th;
        }

        echo json_encode($json);
    }

    public function changePassword()
    {
        $id = $this->session->employee_id;
        $current = $this->input->post('current_pass', true);
        $new = $this->input->post('new_pass', true);
        $retype = $this->input->post('retype_pass', true);

        if (empty($new) || empty($current) || empty($retype)) {
            echo json_encode(
                array(
                    'error' => '1',
                    'err' => 'Do not leave any field blank!',
                )
            );
            exit;
        }

        //retype pass is not identical to new pass
        if ($new !== $retype) {
            echo json_encode(
                array(
                    'error' => '1',
                    'err' => 'Password mismatch!',
                )
            );
            exit;
        }

        //if false current != to current password on DB
        if (!$this->EmployeeDatabase->checkCurrentPassword($id, $current)) {
            echo json_encode(
                array(
                    'error' => '1',
                    'err' => 'Incorrect current password!',
                )
            );
            exit;
        }

        $new_hashed_password = password_hash($new, PASSWORD_DEFAULT);
        if ($this->EmployeeDatabase->changeEmployeePassword($id, $new_hashed_password)) {
            echo json_encode(
                array(
                    'error' => '0',
                )
            );
        }
    }
}
