<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_stages_controller extends CI_Controller
{
    public function index()
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

        $page = 'stages';

        if (!file_exists(APPPATH . 'views/client/' . $page . '.php')) {
            show_404();
        }

        $clientIdLead = $this->session->useridlead;
        $data['stages'] = $this->Admin_registerm->getClientStages($clientIdLead)->result();
        $data['current_stage'] = $this->EmployeeDatabase->getClientsCurrentAndDoneStage($clientIdLead, false)->result();
        $data['current_and_done_stage'] = $this->EmployeeDatabase->getClientsCurrentAndDoneStage($clientIdLead, true)->result();
        $data['number_of_files_submitted'] = $this->EmployeeDatabase->countFilesSubmittedOnSpecificStage($data['current_stage'][0]->stage, $clientIdLead);
        $data['method'] = $this;

        $this->load->view('client/templates/header');
        $this->load->view('client/' . $page, $data);
        $this->load->view('client/templates/footer');
        $this->load->view('client/templates/end_footer');
    }

    public function searchArray($files, $filter)
    {
        $filtered = array();
        $rows = $files;
        foreach ($rows as $index => $columns) {
            foreach ($columns as $key => $value) {
                if ($key == 'stage' && strtoupper($value) == strtoupper($filter)) {
                    $filtered[] = $columns;
                }
            }
        }
        return  $filtered;
    }
}
