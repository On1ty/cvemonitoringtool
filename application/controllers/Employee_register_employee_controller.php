<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_register_employee_controller extends CI_Controller
{
    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback">', '</span>');
        $this->form_validation->set_rules('user-select-role', '', 'trim|required', array('required' => 'Please select role'));
        $this->form_validation->set_rules('emp-first', '', 'trim|required', array('required' => 'Please enter first name'));
        $this->form_validation->set_rules('emp-middle', '', 'trim');
        $this->form_validation->set_rules('emp-last', '', 'trim|required', array('required' => 'Please enter last name'));
        $this->form_validation->set_rules('emp-username', '', 'trim|required|valid_email|is_unique[employee.emp_name]', array('required' => 'Please enter username', 'is_unique' => 'Email is already used!'));
        $this->form_validation->set_rules('emp-dob', '', 'trim|required', array('required' => 'Please enter birthdate'));

        if ($this->form_validation->run() == false) {
            $page = 'register_emp';
            $this->load->view('employee/templates/header_register');
            $this->load->view('employee/' . $page);
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/custom_script_register_emp');
            $this->load->view('employee/templates/end_footer');
        } else {

            $this->load->helper('string');
            $this->load->config('email');
            $this->load->library('email');

            //fixed
            $from = 'noreply@cvemonitoringtool.com';
            $to =  $this->input->post('emp-username', true);
            //Change it depends on topic
            $subject = 'Account Information';
            //header
            $emailContent = '<!DOCTYPE><html><head><style></style></head><body><table width="800px" style="border:none;margin: auto;border-spacing:0;"><tr><td style="background:#eceff4;padding-left:3%;padding-top:2%"><img src="cvemonitoringtool.com/images/cve_tagline.png" width="140" title="CommonWealth VISA Experts" alt="CommonWealth VISA Experts" ></td></tr>';
            $emailContent .= '<tr><td style="height:10px;border-top:8px solid #00a3e0;"></td></tr>';
            //body
            $emailContent .= '<div style="padding:40px;">';
            $emailContent .= 'Hello ' . ucwords($this->input->post('emp-last', true)) . ',';
            $emailContent .= '<br>';
            $emailContent .= 'Your CVE Monitoring Tool account has been successfully created. Please remember to keep your username and password confidential at all times.';
            $emailContent .= '<br>';
            $emailContent .= '<br>';
            $emailContent .= '<center>email: <b>' . $this->input->post('emp-username', true) . '</b></center>';
            $emailContent .= '<center>password: <b>' . preg_replace('/\//', '', $this->input->post('emp-dob', true)) . '</b></center>';
            $emailContent .= '<br>';
            $emailContent .= 'Best regards,';
            $emailContent .= '<br>';
            $emailContent .= '<span style="font-size:11pt">Commonwealth Visa Experts</span>';
            $emailContent .= '<div><span style="font-size:8pt"><i>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; "The experts you can trust"</i></span></div>';
            $emailContent .= '<br><br>';
            $emailContent .= '<div style="color:dark;"><i>*This email and all attachments are strictly confidential and may be legally protected. If you are not the intended recipient, kindly notify us at <a href="info@commonwealthvisa.com">info@commonwealthvisa.com</a>, delete permanently and do not forward, copy, or print any of the contents.</i></div>';
            $emailContent .= '</div>';
            //footer
            $emailContent .= '<tr><td style="height:10px;border-bottom:8px solid #00a3e0;"></td></tr>';
            $emailContent .= "<tr><td style='background:#eceff4;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><strong><a href='https://cvemonitoringtool.com/' target='_blank' style='text-decoration:none;'>www.cvemonitoringtool.com</a></strong></p></td></tr></table></body></html>";

            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($emailContent);

            $real_id = $this->_generateId();
            $password_hashed = password_hash(preg_replace('/\//', '', $this->input->post('emp-dob', true)), PASSWORD_DEFAULT);

            /**
             * <option value="1">Administrator</option> ADMIN PORTAL
             * <option value="2">Marketing</option> EMPLOYEE PORTAL
             * <option value="3">Documentation</option> EMPLOYEE PORTAL
             * <option value="4">Super User</option> ADMIN PORTAL and EMPLOYEE PORTAL
             * <option value="5">Approver</option> ADMIN PORTAL and EMPLOYEE PORTAL
             */
            $data = array(
                'real_id' => $real_id,
                'role' => $this->input->post('user-select-role', true),
                'emp_first' => preg_replace('/\s+/', ' ', ucwords($this->input->post('emp-first', true))),
                'emp_middle' => preg_replace('/\s+/', ' ', ucwords($this->input->post('emp-middle', true))),
                'emp_last' => preg_replace('/\s+/', ' ', ucwords($this->input->post('emp-last', true))),
                'emp_name' => preg_replace('/\s+/', ' ', $this->input->post('emp-username', true)),
                'emp_pass' => $password_hashed,
                'date_created' => date("c"),
            );

            if ($this->email->send()) {
                $success = $this->Admin_registerm->emp_register($data);
                if ($success) {
                    $this->session->set_flashdata('registered_emp', "New Employee Registered! The credentials is already sent to employee's email.");
                    redirect('employee/employee/register');
                }
            } else {
                echo 'not working';
            }
        }
    }

    public function _generateId()
    {
        $this->load->helper('string');
        $random_num = random_string('numeric', 6);
        return 'EMP-' . date('Y') . '-' . $random_num;
    }
}
