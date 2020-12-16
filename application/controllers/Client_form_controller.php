<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_form_controller extends CI_Controller
{
    public function form($stage = null)
    {
        $count = $this->User_loginm->checkActivation($this->session->userid)->num_rows();

        if ($count != 0) {
            $isActive = $this->User_loginm->checkActivation($this->session->userid)->row()->isActive;

            if ($isActive == 0) {
                $this->session->set_flashdata('invalid_user', 'Your account is deactivated. You cannot login.');
                redirect();
            }
        }

        if (!$this->session->userlogged) {
            redirect();
        }

        $id = $this->session->useridlead;

        $data['client'] = $this->Admin_registerm->clientsProfile($id);
        $data['stage_name'] = $this->getStage($stage);
        $data['files'] = $this->Emp_clientsm->clientsFile($id, $data['stage_name'])->result();
        $data['stage_img_path'] = $this->getImagePath($stage);
        $data['method'] = $this;

        $data['identity_documents'] = $this->generateIdentityDocuments();
        $data['financial_documents_for_regular_process'] = $this->generateFinancialDocumentsForRegularProcess();
        $data['verifiable_source_funds_regular'] = $this->generateVerifiableSourceOfFundsForRegularProcess();
        $data['evidence_ties_ph'] = $this->generateEvidenceOfTiesToPhilippines();
        $data['other_documents'] = $this->generateOtherDocuments();
        // $data['total_admin_fee'] = $this->Emp_clientsm->totalAdminPayment($id);

        if (!isset($data['client'])) {
            echo 'Wrong URL Parameter.';
        } else {
            $this->load->view('client/templates/header');
            $this->load->view('client/form', $data);
            $this->load->view('client/templates/footer');
            $this->load->view('client/templates/custom_script_form');
            $this->load->view('client/templates/end_footer');
        }
    }

    public function manualUpload()
    {
        $form = $this->input->post('form', true);
        $doc =  $this->input->post('doc', true);
        $stage =  $this->input->post('stage', true);
        $id_lead = $this->input->post('id_lead', true);
        $check_box = $this->input->post('manual_check', true);
        $isCheckboxChecked = isset($check_box) ? true : false;

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
            $this->session->set_flashdata('success', 'Submitted Successfully');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function rejectSelectedClientsFile($id, $id_lead)
    {
        $result = $this->User_pendingm->getFileName($id, $id_lead);

        if ($result->type != 'N/A') {
            $file_name = $result->encrypt . $result->type;

            if ($result->form == 'Releasing of LOA/OOP') {
                if (!file_exists(FCPATH . 'uploads/' . 'LOA or OOP' . '/' . $file_name)) {
                    $this->session->set_flashdata('error', 'It seems that the file is already deleted.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                if (!file_exists(FCPATH . 'uploads/' . $result->form . '/' . $file_name)) {
                    $this->session->set_flashdata('error', 'It seems that the file is already deleted.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }

        if ($this->User_pendingm->deleteFile($id, $id_lead)) {

            if ($result->form == 'Releasing of LOA/OOP') {
                unlink(FCPATH . 'uploads/LOA or OOP/' . $file_name);
            } else {
                unlink(FCPATH . 'uploads/' . $result->form . '/' . $file_name);
            }

            $this->session->set_flashdata('success', 'Attachment file has been deleted');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function searchArray($files, $filter)
    {
        $filtered = array();
        $rows = $files;
        foreach ($rows as $index => $columns) {
            foreach ($columns as $key => $value) {
                if ($key == 'doc' && strtoupper($value) == strtoupper($filter)) {
                    $filtered[] = $columns;
                }
            }
        }
        return  $filtered;
    }

    private function generateIdentityDocuments()
    {
        return array(
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
            (object) array('doc'  => 'Valid Govt ID', 'code'  => 'Valid Govt Sponsor', 'form' => 'Identity Document of Sponsor'),
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
