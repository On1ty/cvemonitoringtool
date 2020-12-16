<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_settings_controller extends CI_Controller
{

    public function index()
    {
        $count = $this->User_loginm->checkActivation($this->session->userid)->num_rows();

        if ($count != 0) {
            $isActive = $this->User_loginm->checkActivation($this->session->userid)->row()->isActive;

            if ($isActive == 0) {
                $this->session->set_flashdata('invalid_user', 'Your account is deactivated. You cannot login.');
                redirect('0');
            }
        }

        if (!$this->session->userlogged) {
            redirect('0');
        }

        $data['client'] = $this->Emp_clientsm->clientsProfile($this->session->useridlead);

        $this->load->view('client/templates/header');
        $this->load->view('client/settings', $data);
        $this->load->view('client/templates/footer');
        $this->load->view('client/templates/custom_script_settings');
        $this->load->view('client/templates/end_footer');
    }

    public function changeInfo()
    {
        $dataMain = array(
            'client_first' => $this->input->post('first_name', true),
            'client_middle' => $this->input->post('middle_name', true),
            'client_last' => $this->input->post('last_name', true),
            'client_email' => $this->input->post('email', true),
        );

        $dataInfo = array(
            'phone' => $this->input->post('phone', true),
            'other_phone' => $this->input->post('other_phone', true),
        );

        try {
            $this->User_actionm->updateClientsInfo($dataMain, $this->session->useridlead, 'clients');
            $this->User_actionm->updateClientsInfo($dataInfo, $this->session->useridlead, 'clients_info');
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
        $id = $this->session->useridlead;
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
        if (!$this->User_actionm->checkCurrentPassword($id, $current)) {
            echo json_encode(
                array(
                    'error' => '1',
                    'err' => 'Incorrect current password!',
                )
            );
            exit;
        }

        $new_hashed_password = password_hash($new, PASSWORD_DEFAULT);
        if ($this->User_actionm->changeEmployeePassword($id, $new_hashed_password)) {
            echo json_encode(
                array(
                    'error' => '0',
                )
            );
        }
    }
}
