<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_clients_profile_controller extends CI_Controller
{
    public function profile($id = null)
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $data['notes'] = $this->EmployeeDatabase->getNotesByClientsId($id);
        $data['client'] = $this->Admin_registerm->clientsProfile($id);
        $data['stages'] = $this->Admin_registerm->getClientStages($id)->result();
        $data['current_stage'] = $this->EmployeeDatabase->getClientsCurrentAndDoneStage($id, false)->result();
        $data['current_and_done_stage'] = $this->EmployeeDatabase->getClientsCurrentAndDoneStage($id, true)->result();
        $data['number_of_files_submitted'] = $this->EmployeeDatabase->countFilesSubmittedOnSpecificStage($data['current_stage'][0]->stage, $id);
        $data['method'] = $this;
        if (!isset($data['client'])) {
            echo 'Wrong URL Parameter.';
        } else {
            $this->load->view('employee/templates/header');
            $this->load->view('employee/profile', $data);
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/custom_script_profile');
            $this->load->view('employee/templates/end_footer');
        }
    }

    public function updateStageOnOff($id = null, $status = null)
    {
        if (isset($_POST['open-close'])) {
            if ($this->Admin_registerm->checkStageId($id) != 1) {
                $this->session->set_flashdata('error', 'Invalid Parameter!');
                redirect($_SERVER['HTTP_REFERER']);
            }

            switch ($status) {
                case '0': //off
                    $new_status = 0; //off
                    break;
                case '1': //on
                    $new_status = 1; //on
                    break;
                default:
                    $this->session->set_flashdata('error', 'Invalid Status!');
                    redirect($_SERVER['HTTP_REFERER']);
                    break;
            }

            if ($this->Admin_registerm->updateStageSwitch($id, $new_status)) {
                $this->session->set_flashdata('activate', 'Status successfully updated');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function paymentHistory($id = null)
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));

        $result = $this->Emp_registerm->getPaymentTableProfile($id);

        $data = array();

        foreach ($result->result() as $val) {

            $type = '';
            if ($val->type == 3) {
                $type = '<div class="text-center"><span class="badge badge-danger">Assessment</span></div>';
            } else if ($val->type == 4) {
                $type = '<div class="text-center"><span class="badge badge-success">Admin</span></div>';
            } else if ($val->type == 5) {
                $type = '<div class="text-center"><span class="badge badge-info">Others</span></div>';
            }

            $data[] = array(
                $type,
                '<div class="text-center">' . $val->amount . '</div>',
                $val->remarks == null ? '<div class="text-center"><span class="badge badge-secondary">No Remarks</span></div>' : $val->remarks,
                '<div class="text-center">' . date('m-d-Y', strtotime($val->date_paid)) . '</div>',
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $result->num_rows(),
            "recordsFiltered" => $result->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function activate($id = null)
    {
        if ($this->EmployeeDatabase->activate($id)) {
            $this->session->set_flashdata('activate', 'Activated successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('info', 'It seems like someone changed it before you.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function deactivate($id = null)
    {
        if ($this->EmployeeDatabase->deactivate($id)) {
            $this->session->set_flashdata('deactivate', 'Deactivated successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('info', 'It seems like someone changed it before you.');
            redirect($_SERVER['HTTP_REFERER']);
        }
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

    public function updateMainInfo($id_lead)
    {
        $data = array(
            'school' => $this->input->post('school', true),
            'intake_date' => $this->input->post('intake_date', true),
            'student_id' => $this->input->post('student_id', true),
            'program' => $this->input->post('program', true),
        );

        if ($this->EmployeeDatabase->updateClientsInfo($data, $id_lead)) {

            echo json_encode(array(
                'status' => 'success',
            ));
        }
    }

    public function addNote($id_lead, $noted_by)
    {
        $note = $this->input->post('note', true);

        if (!empty($note)) {

            $date = date('c');
            $date_formatted = date('m/d/Y h:i A', strtotime($date));
            $data = array(
                'id_lead' => $id_lead,
                'note' => $note,
                'noted_date' => $date,
                'noted_by' => $noted_by,
            );

            if ($this->EmployeeDatabase->addNotes($data)) {
                echo json_encode(array(
                    'status' => 'success',
                    'data' => array(
                        'role' => $this->role($this->session->employee_role),
                        'emp_name' => $this->session->employee_last,
                        'date' => $date_formatted,
                        'note' => $note,
                    )
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 'empty',
            ));
        }

        // $this->form_validation->set_rules('note', '', 'trim|required');
        // if ($this->form_validation->run()) {
        //     $note = $this->input->post('note', true);

        //     if (empty($note)) {
        //         redirect($_SERVER['HTTP_REFERER']);
        //     }

        //     $data = array(
        //         'id_lead' => $id_lead,
        //         'note' => $note,
        //         'noted_date' => date('c'),
        //         'noted_by' => $noted_by,
        //     );

        //     if ($this->EmployeeDatabase->addNotes($data)) {
        //         $this->session->set_flashdata('success', 'New note added.');
        //     }
        // }
        // redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateFeesInfo($id_lead)
    {
        $data = array(
            'reservation_fee' => $this->input->post('reservation_fee', true),
            'tuition_fee_depo' => $this->input->post('tuition_fee', true),
            'contract_fee' => $this->input->post('contract_fee', true),
        );

        if ($this->EmployeeDatabase->updateClientsInfo($data, $id_lead)) {
            echo json_encode(array(
                'status' => 'success',
            ));
        }
    }

    public function updateDatesInfo($id_lead)
    {
        $data = array(
            'deadline' => $this->input->post('refund_deadline', true),
            'deferral_intake' => $this->input->post('deferral_intake', true),
            'birthdate' => $this->input->post('birthdate', true),
        );

        if ($this->EmployeeDatabase->updateClientsInfo($data, $id_lead)) {
            echo json_encode(array(
                'status' => 'success',
            ));
        }
    }

    public function updateContactInfo($id_lead)
    {
        $data = array(
            'client_email' => $this->input->post('email', true),
        );

        $data_info = array(
            'phone' => $this->input->post('phone', true),
            'other_phone' => $this->input->post('other_phone', true),
            'address' => $this->input->post('address', true),
        );

        if ($this->EmployeeDatabase->updateClientsInfo($data_info, $id_lead) || $this->EmployeeDatabase->updateClientsEmail($data, $id_lead)) {
            echo json_encode(array(
                'status' => 'success',
            ));
        }
    }

    public function updateEducationalInfo($id_lead)
    {
        $data = array(
            'college' => $this->input->post('college', true),
            'high_school' => $this->input->post('high_school', true),
            'graduate_school' => $this->input->post('graduate_school', true),
        );

        if ($this->EmployeeDatabase->updateClientsInfo($data, $id_lead)) {
            echo json_encode(array(
                'status' => 'success',
            ));
        }
    }

    private function role($role)
    {
        if ($role == 1)
            return 'Administrator';
        else if ($role == 2)
            return 'Marketing';
        else if ($role == 3)
            return 'Documentation';
        else if ($role == 4)
            return 'Super';
        else if ($role == 5)
            return 'Approver';
    }
}
