<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_users_controller extends CI_Controller
{
    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $this->load->view('employee/templates/header');
        $this->load->view('employee/users');
        $this->load->view('employee/templates/footer');
        $this->load->view('employee/templates/custom_script_users');
        $this->load->view('employee/templates/end_footer');
    }

    public function users_list()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));


        $result = $this->EmployeeDatabase->getUsers();

        $data = array();

        foreach ($result->result() as $val) {
            $dataArrayHolder = array(
                $val->real_id,
                '<span class="text-danger">' . $val->emp_first . '&nbsp' . $val->emp_middle . '&nbsp' . $val->emp_last . '</span>',
                '<div class="text-center"><span class="badge badge-info">' . $this->getUsersRole($val->role) . '</span></div>',
                '<a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $val->emp_name . '" target="_blank">' . $val->emp_name . '</a>',
                '<div class="text-center">' . date('m-d-Y', strtotime($val->date_created)) . '</div>',
                '<div class="text-center">
                    <a href="reset/password/' . $val->emp_id . '" class="btn text-white btn-danger text-sm btn-xs send-pass" data-confirm="Are you sure you want to reset password?"><i class="fas fa-key"></i> Reset Password</a>
                </div>'
            );

            $data[] = $dataArrayHolder;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $result->num_rows(),
            "recordsFiltered" => $result->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
    }

    public function email_credentials($id = null)
    {
        $this->load->helper('string');
        $this->load->config('email');
        $this->load->library('email');

        $client = $this->Emp_clientsm->usersEmail($id);
        $password = random_string('alpha', 8);

        //fixed
        $from = 'noreply@cvemonitoringtool.com';
        $to =  $client->emp_name;
        //Change it depends on topic
        $subject = 'Account Information';
        //header
        $emailContent = '<!DOCTYPE><html><head><style></style></head><body><table width="800px" style="border:none;margin: auto;border-spacing:0;"><tr><td style="background:#eceff4;padding-left:3%;padding-top:2%"><img src="cvemonitoringtool.com/images/cve_tagline.png" width="140" title="CommonWealth VISA Experts" alt="CommonWealth VISA Experts" ></td></tr>';
        $emailContent .= '<tr><td style="height:10px;border-top:8px solid #00a3e0;"></td></tr>';
        //body
        $emailContent .= '<div style="padding:40px;">';
        $emailContent .= 'Hello ' . ucwords($client->emp_last) . ',';
        $emailContent .= '<br>';
        $emailContent .= 'This is your new account credentials. Please change your password on Settings menu. Thank you!';
        $emailContent .= '<br>';
        $emailContent .= '<br>';
        $emailContent .= '<center>email: <b>' . $client->emp_name . '</b></center>';
        $emailContent .= '<center>password: <b>' . $password . '</b></center>';
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


        $this->email->from($from, 'CVE Monitoring Tool');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($emailContent);

        if ($this->email->send()) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $this->Emp_clientsm->updateUsersPass($id, $password_hashed);
            $this->session->set_flashdata('updated', 'Client\'s password successfully sent.');
            redirect('employee/users');
        } else {
            // echo 'not working';
            // show_error($this->email->print_debugger());
            $this->session->set_flashdata('error', 'Sorry, Email was unable to send. Please try again or contact the developer for immediate action.');
            redirect('employee/users');
        }
    }

    private function getUsersRole($role)
    {
        switch ($role) {
            case 1:
                return 'Administrator';
            case 2:
                return 'Marketing';
            case 3:
                return 'Documentation';
            case 4:
                return 'Super User';
            case 5:
                return 'Approver';
            default:
                return 'Error Role';
        }
    }
}
