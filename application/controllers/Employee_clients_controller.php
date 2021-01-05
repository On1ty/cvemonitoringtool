<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_clients_controller extends CI_Controller
{
    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $this->load->view('employee/templates/header');
        $this->load->view('employee/clients');
        $this->load->view('employee/templates/footer');
        $this->load->view('employee/templates/custom_script_clients');
        $this->load->view('employee/templates/end_footer');
    }

    public function clients_list()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));

        /**
         * 1 Admin
         * 2 Marketing
         * 3 Documentation
         * 4 Super User
         * 5 Approver54
         */

        if (
            $this->session->employee_role == 1 ||
            $this->session->employee_role == 3 ||
            $this->session->employee_role == 4 ||
            $this->session->employee_role == 5
        ) {
            $result = $this->Admin_registerm->getClients();
        } else {
            $result = $this->Emp_clientsm->getClients($this->session->employee_id);
        }

        $employeeRole = $this->session->employee_role;
        $data = array();
        foreach ($result->result() as $val) {
            $dataArrayHolder = array(
                $val->id_lead,
                $val->client_real_id,
                '<div class="text-center">' . $this->getClientStatus($val->id_lead) . '</div>',
                '<span class="text-danger">' . $val->client_first . '&nbsp' . $val->client_middle . '&nbsp' . $val->client_last . '</span>',
                '<a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $val->client_email . '" target="_blank">' . $val->client_email . '</a>',
                "<div class=\"text-center\">$val->phone</div>",
                "<div class=\"text-center\">$val->other_phone</div>",
                "<div class=\"text-center\">$val->birthdate</div>",
                "<div class=\"text-center\">$val->address</div>",
                "<div class=\"text-center\">$val->school</div>",
                "<div class=\"text-center\">$val->student_id</div>",
                "<div class=\"text-center\">$val->intake_date</div>",
                "<div class=\"text-center\">$val->program</div>",
                "<div class=\"text-center\">$val->reservation_fee</div>",
                "<div class=\"text-center\">$val->tuition_fee_depo</div>",
                "<div class=\"text-center\">$val->contract_fee</div>",
                "<div class=\"text-center\">$val->deadline</div>",
                "<div class=\"text-center\">$val->deferral_intake</div>",
                "<div class=\"text-center\">$val->college</div>",
                "<div class=\"text-center\">$val->high_school</div>",
                "<div class=\"text-center\">$val->graduate_school</div>",
                '<div class="text-center">' . date('m-d-Y', strtotime($val->created_time)) . '</div>',
            );

            if ($employeeRole == 4) {
                $html = '<span id="' . $val->client_real_id . '" class="text-info counselor" data-toggle="modal" data-target="#update-counselor">' . $val->emp_first . ' ' . $val->emp_last . '</span>';
                array_push($dataArrayHolder, $html);
            }

            array_push($dataArrayHolder, $this->checkRole($this->session->employee_role, $val, strip_tags($this->getClientStatus($val->id_lead))));

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

    private function checkRole($role, $val, $stage)
    {
        $base_url = base_url();
        $action = "<div class=\"text-center\">";

        //3 = Documentation
        if ($role == 3 && $stage === 'Endorsement to Documentation Team'){
            $action .= "<a href=\"{$base_url}employee/clients/stage/approve/Endorsement to Documentation Team/{$val->id_lead}\" class=\"btn text-white btn-info text-sm btn-xs\"><i class=\"far fa-folder-open\"></i> View</a>";
        }else{
            $action .= "<a href=\"clients/profile/id/{$val->id_lead}\" class=\"btn text-white btn-success text-sm btn-xs\"><i class=\"far fa-folder-open\"></i> View</a>";
        }

        $action .= "<a href=\"send/clients/credentials/{$val->id_lead}\" class=\"btn text-white btn-info text-sm btn-xs send-pass ml-1\" data-confirm=\"Are you sure you want to email client\'s credentials?\"><i class=\"fas fa-key\"></i></a>";
        $action .= "</div>";

        return $action;
    }

    private function getClientStatus($id_lead)
    {
        $result = $this->User_actionm->getCurrentStages($id_lead);

        $status = '';

        foreach ($result->result() as $val) {
            $count = $this->User_actionm->countStage($val->stage, $id_lead);

            if ($count <= 0) {
                if (
                    $val->stage == 'Endorsement to Documentation Team' ||
                    $val->stage == 'Release of LOA/OOP' ||
                    $val->stage == 'Orientation' ||
                    $val->stage == 'Compilation' ||
                    $val->stage == 'Assessment & Finalization' ||
                    $val->stage == 'RCIC Quality Check' ||
                    $val->stage == 'Lodging of VISA Application'
                ) {
                    $status = '<span class="badge bg-info">' . $val->stage . '</span>';
                } else {
                    $status = '<span class="badge bg-secondary">' . $val->stage . '</span>';
                }
            } else if ($count >= 1) {
                $status = '<span class="badge bg-info">' . $val->stage . '</span>';
            }
        }
        return empty($status) ? '<span class="badge bg-secondary">No Stages Open</span>' : $status;
    }

    public function updateCounselor()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
        $this->form_validation->set_rules('user-select-employer', '', 'trim|required', array('required' => 'Please select counselor'));
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/templates/header');
            $this->load->view('admin/clients');
            $this->load->view('admin/templates/footer');
            $this->load->view('admin/templates/cemployee/clients/profile/id/ustom_script_clients');
            $this->load->view('admin/templates/end_footer');
        } else {

            $data = array(
                'new_emp' => $this->input->post('user-select-employer', true),
                'client_to_be_update' => $this->input->post('update-counselor', true),
            );

            print_r($data);

            $success = $this->Admin_registerm->updateCounselor($data);
            if ($success) {
                $this->session->set_flashdata('updated', 'Assigned Counselor updated successfully');
                redirect('employee/clients');
            }
            redirect('employee/clients');
        }
    }

    public function email_credentials($id = null)
    {
        $this->load->helper('string');
        $this->load->config('email');
        $this->load->library('email');

        $client = $this->Emp_clientsm->clientsProfile($id);
        $password = random_string('alpha', 8);

        //fixed
        $from = 'noreply@cvemonitoringtool.com';
        $to =  $client->client_email;
        //Change it depends on topic
        $subject = 'Account Information';
        //header
        $emailContent = '<!DOCTYPE><html><head><style></style></head><body><table width="800px" style="border:none;margin: auto;border-spacing:0;"><tr><td style="background:#eceff4;padding-left:3%;padding-top:2%"><img src="cvemonitoringtool.com/images/cve_tagline.png" width="140" title="CommonWealth VISA Experts" alt="CommonWealth VISA Experts" ></td></tr>';
        $emailContent .= '<tr><td style="height:10px;border-top:8px solid #00a3e0;"></td></tr>';
        //body
        $emailContent .= '<div style="padding:40px;">';
        $emailContent .= 'Hello ' . ucwords($client->client_last) . ',';
        $emailContent .= '<br>';
        $emailContent .= 'This is your account credentials. Please change your password on Settings menu. Thank you!';
        $emailContent .= '<br>';
        $emailContent .= '<br>';
        $emailContent .= '<center>email: <b>' . $client->client_email . '</b></center>';
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
            $this->Emp_clientsm->updatePass($id, $password_hashed);
            $this->session->set_flashdata('updated', 'Client\'s credentials successfully sent.');
            redirect('employee/clients');
        } else {
            echo 'not working';
            show_error($this->email->print_debugger());
            $this->session->set_flashdata('updated', 'Sorry, Email was unable to send. Please try again or contact the developer for immediate action.');
            // redirect('employee/clients');
        }
    }
}
