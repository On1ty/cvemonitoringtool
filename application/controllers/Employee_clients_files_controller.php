<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_clients_files_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('zip');
    }

    public function files($id = null, $stage = null)
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $data['client'] = $this->Admin_registerm->clientsProfile($id);
        $data['stage_name'] = $this->getStage($stage);
        $data['files'] = $this->Emp_clientsm->clientsFile($id, $data['stage_name'])->result();
        $data['stage_img_path'] = $this->getImagePath($stage);
        $data['method'] = $this;
        $data['current_and_done_stage'] = $this->EmployeeDatabase->getClientsCurrentAndDoneStage($id, true)->result();
        $data['total_admin_fee'] = $this->Emp_clientsm->totalAdminPayment($id);

        $data['identity_documents'] = $this->generateIdentityDocuments();
        $data['financial_documents_for_regular_process'] = $this->generateFinancialDocumentsForRegularProcess();
        $data['verifiable_source_funds_regular'] = $this->generateVerifiableSourceOfFundsForRegularProcess();
        $data['evidence_ties_ph'] = $this->generateEvidenceOfTiesToPhilippines();
        $data['other_documents'] = $this->generateOtherDocuments();

        if (!isset($data['client'])) {
            echo 'Wrong URL Parameter.';
        } else {
            $this->load->view('employee/templates/header');
            $this->load->view('employee/files', $data);
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/custom_script_files');
            $this->load->view('employee/templates/end_footer');
        }
    }

    public function downloadArchieve($id_lead, $stage)
    {
        $data = array();
        $result = $this->Admin_actionm->clientsFile($id_lead, urldecode($stage));

        foreach ($result->result() as $val) {
            $data[] = array(
                FCPATH . '/uploads/' . $id_lead . '/' . $val->encrypt . $val->type,
                $val->file,
            );
        }

        foreach ($data as $val) {
            $this->zip->read_file($val[0], $val[1]);
        }

        $filename = urldecode($stage) . '-' . $id_lead;
        $this->zip->download($filename);
    }

    public function approveStage($stage, $id_lead)
    {
        $clients_info = $this->Admin_registerm->clientsProfile($id_lead);
        $id_lead = urldecode($id_lead);
        $stage = urldecode($stage);
        if ($stage == 'Client Onboarding') {
            $nextStage = 'Enrollment';
            $this->email_employee($nextStage, $clients_info, 5);
            $this->email_employee($nextStage, $clients_info, 4);
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'Enrollment') {
            $nextStage = 'Release of LOA/OOP';
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'Release of LOA or OOP') {
            $stage = 'Release of LOA/OOP';
            $nextStage = 'Endorsement to Documentation Team';
            $this->email_employee($nextStage, $clients_info, 1);
            $this->email_employee($nextStage, $clients_info, 4);
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'Endorsement to Documentation Team') {
            $nextStage = 'Orientation';
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'Orientation') {
            $nextStage = 'Completion';
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Document submitted. Stage proceeded to Completion.');
            redirect($_SERVER['HTTP_REFERER']);
        } else if ($stage == 'Completion') {
            $stage = 'Completion';
            $nextStage = 'Compilation';
            $this->email_employee($nextStage, $clients_info, 5);
            $this->email_employee($nextStage, $clients_info, 4);
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'Compilation') {
            $stage = 'Compilation';
            $nextStage = 'Assessment & Finalization';
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'Assessment and Finalization') {
            $stage = 'Assessment & Finalization';
            $nextStage = 'RCIC Quality Check';
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        } else if ($stage == 'RCIC Quality Check') {
            $stage = 'RCIC Quality Check';
            $nextStage = 'Lodging of VISA Application';
            $this->EmployeeDatabase->approveStage($stage, $id_lead);
            $this->EmployeeDatabase->autoNextStage($nextStage, $id_lead);
            $this->session->set_flashdata('success', 'Stage successfully approved. ' . $nextStage . ' stage is now open');
        }
        redirect('employee/clients/profile/id/' . $id_lead);
    }

    public function manualUpload()
    {
        $form = $this->input->post('form', true);
        $doc =  $this->input->post('doc', true);
        $stage =  $this->input->post('stage', true);
        $id_lead = $this->input->post('id_lead', true);
        $check_box = $this->input->post('manual_check', true);
        $isCheckboxChecked = isset($check_box) ? true : false;

        $client_current_stage = $this->EmployeeDatabase->getClientsCurrentAndDoneStage($id_lead, false)->row_array();

        $encrypt = null;
        $file = null;
        $type = null;

        if ($isCheckboxChecked) {
            $encrypt = 'N/A';
            $file = $this->input->post('manual_file_remarks', true);
            $type = 'N/A';
        } else {
            $folder_name = $id_lead;
            $config['upload_path'] = 'uploads/' . $folder_name;
            $config['allowed_types'] = 'jpg|jpeg|png|docx|pdf|csv|doc|xlsx|xlsm|xlt|txt|ods|xltx';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('manual_file_input')) {
                $file_data = $this->upload->data();

                $encrypt = $file_data['raw_name'];
                $file = $file_data['orig_name'];
                $type = $file_data['file_ext'];
            } else {
                $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        $data = array(
            'uploaded_by' => $id_lead,
            'stage' => $stage,
            'form' => $form,
            'doc' => $doc,
            'encrypt' => $encrypt,
            'file' => $file,
            'type' => $type,
            'upload_date' => date("c"),
        );

        if ($this->User_actionm->upload($data)) {

            /**
             *
             * Once na nasa Orientation Stage na ang Client
             * Kapag nag upload sya ng files sa Completion Stage
             * Automatic na'tin i-change ang stage from Orientation
             * to Completion
             * */
            $current_stage = $client_current_stage['stage'];
            $form_stage = $stage;

            if (
                $current_stage == 'Orientation' &&
                $form_stage == 'Completion'
            ) {
                /**
                 * CHANGE STAGE FROM ORIENTATION TO COMPLETION
                 */
                $this->approveStage($current_stage, $id_lead);
            }

            /**
             * Itong error message sa baba ay kailangan
             */
            $this->session->set_flashdata('success', 'Document uploaded successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function rejectSelectedClientsFile($id, $id_lead)
    {
        $result = $this->User_pendingm->getFileName($id, $id_lead);

        if ($result->type != 'N/A') {

            $file_name = $result->encrypt . $result->type;

            if (!file_exists(FCPATH . 'uploads/' . $id_lead . '/' . $file_name)) {
                $this->session->set_flashdata('error', 'It seems that the file is already deleted.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        if ($this->User_pendingm->deleteFile($id, $id_lead)) {

            unlink(FCPATH . 'uploads/' . $id_lead . '/' . $file_name);

            $this->session->set_flashdata('success', 'Attachment file has been deleted');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function searchArray($files, $filter, $search)
    {
        $filtered = array();
        $rows = $files;
        foreach ($rows as $index => $columns) {
            foreach ($columns as $key => $value) {
                if ($key == $search && strtoupper($value) == strtoupper($filter)) {
                    $filtered[] = $columns;
                }
            }
        }
        return  $filtered;
    }

    private function email_employee($stage, $clients_info, $role)
    {
        $this->load->helper('string');
        $this->load->config('email');
        $this->load->library('email');

        $clients_name = $clients_info->client_first . ' ' . $clients_info->client_last;

        if ($role === 5) {
            $role_in_text = 'Approver';
            $email_in_array = $this->EmployeeDatabase->getAllRolesEmail($role);
        } elseif ($role === 1) {
            $role_in_text = 'Administrator';
            $email_in_array = $this->EmployeeDatabase->getAllRolesEmail($role);
        } elseif ($role === 4) {
            $role_in_text = 'Super User';
            $email_in_array = $this->EmployeeDatabase->getAllRolesEmail($role);
        }

        $to = $email_in_array;

        if (empty($to)) {
            return;
        }

        //fixed
        $from = 'noreply@cvemonitoringtool.com';
        //Change it depends on topic
        $subject = 'Clients Status';
        //header
        $emailContent = '<!DOCTYPE><html><head><style></style></head><body><table width="800px" style="border:none;margin: auto;border-spacing:0;"><tr><td style="background:#eceff4;padding-left:3%;padding-top:2%"><img src="cvemonitoringtool.com/images/cve_tagline.png" width="140" title="CommonWealth VISA Experts" alt="CommonWealth VISA Experts" ></td></tr>';
        $emailContent .= '<tr><td style="height:10px;border-top:8px solid #00a3e0;"></td></tr>';
        //body
        $emailContent .= '<div style="padding:40px;">';
        $emailContent .= "<p>Dear $role_in_text</p>";
        $emailContent .= '<br>';
        $emailContent .= '<br>';

        if ($stage == 'Enrollment') {
            $emailContent .= "<p>The enrollment docs of <bold>$clients_name</bold> has been forwarded to you.</p>";
        } elseif ($stage == 'Compilation') {
            $emailContent .= "<p>The application documents for Visa Processing of <bold>$clients_name</bold> has been forwarded to you.</p>";
        } else if ($stage == 'Endorsement to Documentation Team') {
            $emailContent .= "<p>The application documents for Endorsement of <bold>$clients_name</bold> has been forwarded to you.</p>";
        }

        $emailContent .= '<br>';
        $emailContent .= '<br>';
        $emailContent .= '<strong>Regards,</strong>';
        $emailContent .= '<br>';
        $emailContent .= '<span style="font-size:11pt">Commonwealth Visa Experts</span>';
        $emailContent .= '<div style="font-size:8pt"><span class="margin-left: 30px;">"The experts you can trust"</span></div>';
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

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }
    }

    private function generateIdentityDocuments()
    {
        return array(
            (object) array('doc'  => 'Assessment Report', 'code'  => 'Assessment', 'form' => 'Assessment'),
            (object) array('doc'  => 'Service Agreement', 'code'  => 'Service Agreement', 'form' => 'Service Agreement'),
            (object) array('doc' =>  'Valid ID', 'code' => 'Valid ID', 'form' => 'Identity Documents'),
            (object) array('doc'  => 'Travel History', 'code'  => 'Travel History', 'form' => 'Identity Documents'),
            (object) array('doc'  => 'Birth Certificate', 'code'  => 'Birth Certificate', 'form' => 'Identity Documents'),
            (object) array('doc'  => 'Marriage Certificate', 'code'  => 'Marriage Certificate', 'form' => 'Identity Documents'),
            (object) array('doc'  => 'NBI/Police Clearance', 'code'  => 'NBI/Police Clearance', 'form' => 'Identity Documents'),
            (object) array('doc'  => 'Passport Size Picture', 'code'  => 'Passport Size Picture', 'form' => 'Identity Documents'),
            (object) array('doc'  => 'Passport', 'code'  => 'Passport Page', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'High School Diploma/Certificate of Graduation', 'code'  => 'HS Diploma', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'College Diploma/Certificate of Graduation', 'code'  => 'College Diploma', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'High School TOR (Form137)', 'code'  => 'HS TOR', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'College TOR', 'code'  => 'College TOR', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'English Test Results', 'code'  => 'English Test', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'PRC Board Certificate', 'code'  => 'PRC', 'form' => 'Enrollment/Qualification Documents'),
            (object) array('doc'  => 'Certificate of Employment', 'code'  => 'Cert Employment', 'form' => 'Employment & Training Documents'),
            (object) array('doc'  => 'Certificate of Training/Award', 'code'  => 'Cert Training', 'form' => 'Employment & Training Documents'),
        );
    }

    private function generateFinancialDocumentsForRegularProcess()
    {
        return array(
            (object) array('doc' =>  'Affidavit of Financial Support', 'code' => 'Affidavit', 'form' => 'Financial Documents'),
            (object) array('doc'  => 'Bank Certificate', 'code'  => 'Bank Cert', 'form' => 'Financial Documents'),
            (object) array('doc'  => 'Bank Statement / CC of Passbook', 'code'  => 'Bank Statement', 'form' => 'Financial Documents'),
            (object) array('doc'  => 'Birth Certificate', 'code'  => 'Birth Cert', 'form' => 'Evidence of Relationship to Sponsors'),
            (object) array('doc'  => 'Marriage Certificate', 'code'  => 'Marriage Cert', 'form' => 'Evidence of Relationship to Sponsors'),
            (object) array('doc'  => 'ETC', 'code'  => 'ETC', 'form' => 'Evidence of Relationship to Sponsors'),
            (object) array('doc'  => 'Passport', 'code'  => 'Passport Sponsor', 'form' => 'Identity Document of Sponsor'),
            (object) array('doc'  => 'Valid Govt ID', 'code'  => 'Valid Govt ID', 'form' => 'Identity Document of Sponsor'),
        );
    }

    private function generateVerifiableSourceOfFundsForRegularProcess()
    {
        return array(
            (object) array('doc' =>  'Certificate of Employment and Compensation/ Payslips / Contracts', 'code' => 'Employment Cert', 'form' => ''),
            (object) array('doc'  => 'Business Permit', 'code'  => 'Business Permit', 'form' => 'Financial Documents'),
            (object) array('doc'  => 'DTI', 'code'  => 'DTI', 'form' => ''),
            (object) array('doc'  => 'BIR Reg Cert', 'code'  => 'BIR Reg Cert', 'form' => ''),
            (object) array('doc'  => 'SEC Corp. Cert', 'code'  => 'SEC Cert', 'form' => ''),
            (object) array('doc'  => 'Deed of Absolute Sale', 'code'  => 'Deed', 'form' => ''),
            (object) array('doc'  => 'Title', 'code'  => 'Title', 'form' => ''),
            (object) array('doc'  => 'Capital Gain Tax', 'code'  => 'Capital Gain Tax', 'form' => ''),
            (object) array('doc'  => 'Notarized ID of Buyer', 'code'  => 'Notarized', 'form' => ''),
            (object) array('doc'  => 'Inheritance', 'code'  => 'Inheritance', 'form' => ''),
            (object) array('doc'  => 'Retirement Fund', 'code'  => 'Retirement Fund', 'form' => ''),
        );
    }

    private function generateEvidenceOfTiesToPhilippines()
    {
        return array(
            (object) array('doc' =>  'Land Titles', 'code' => 'Land Titles', 'form' => ''),
            (object) array('doc'  => 'House', 'code'  => 'House', 'form' => ''),
            (object) array('doc'  => 'Vehicle Ownership', 'code'  => 'Vehicle Ownership', 'form' => ''),
            (object) array('doc'  => 'Bank Accounts', 'code'  => 'Bank Accounts', 'form' => ''),
            (object) array('doc'  => 'Family Business', 'code'  => 'Family Business', 'form' => ''),
        );
    }

    private function generateOtherDocuments()
    {
        return array(
            (object) array('doc' =>  'eMedical Information Sheet', 'code' => 'eMedical', 'form' => ''),
            (object) array('doc'  => 'LOE', 'code'  => 'LOE', 'form' => ''),
            (object) array('doc'  => 'Visa Fee', 'code'  => 'Visa Fee', 'form' => ''),
            (object) array('doc'  => 'VFS Fee', 'code'  => 'VFS Fee', 'form' => ''),
            (object) array('doc'  => 'Biometrics Fee', 'code'  => 'Biometrics Fee', 'form' => ''),
        );
    }

    private function getImagePath($stage = null)
    {
        switch ($stage) {
            case 'stage1':
                return 'on-boarding_om6luu/on-boarding_om6luu_c_scale,w_1400.jpg';
            case 'stage2':
                return 'enrollment_heg7fc/enrollment_heg7fc_c_scale,w_1098.jpg';
            case 'stage3':
                return 'release-loa-oop_iaqrvm/release-loa-oop_iaqrvm_c_scale,w_1400.jpg';
            case 'stage6':
                return 'completion_xcrfmj/completion_xcrfmj_c_scale,w_1400.jpg';
            case 'stage10':
                return 'visa_jrqzza/visa_jrqzza_c_scale,w_1400.jpg';
        }
    }

    private function getStage($stage = null)
    {
        switch ($stage) {
            case 'stage1':
                return 'Client Onboarding';
            case 'stage2':
                return 'Enrollment';
            case 'stage3':
                return 'Release of LOA/OOP';
            case 'stage4':
                return 'Endorsement to Documentation Team';
            case 'stage5':
                return 'Orientation';
            case 'stage6':
                return 'Completion';
            case 'stage7':
                return 'Compilation';
            case 'stage8':
                return 'Assessment & Finalization';
            case 'stage9':
                return 'RCIC Quality Check';
            case 'stage10':
                return 'Lodging of VISA Application';
        }
    }
}
