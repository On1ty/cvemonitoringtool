<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_prospect_list_controller extends CI_Controller
{
    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee/settings');
        }

        $this->load->view('employee/templates/header');
        $this->load->view('employee/prospect_list');
        $this->load->view('employee/templates/footer');
        $this->load->view('employee/templates/custom_script_lead');
        $this->load->view('employee/templates/end_footer');
    }

    public function leadTable()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));

        $result = $this->Emp_registerm->getLeadTable();

        $data = array();

        foreach ($result->result() as $val) {

            $rows = $this->Emp_registerm->checkLatestStatus($val->id);

            /**
             * Do not change the sequence.
             */
            $status = $val->status;

            foreach ($rows->result() as $row) {
                if (isset($row)) {
                    if ($row->type == 4) {
                        $status = 4; //Signup or Admin
                        break;
                    } else if ($row->type == 3) {
                        $status = 3; //Assessment
                    }
                }
            }

            switch ($status) {
                case 1:
                case 2:
                    /**
                     * TOGGLE TYPE yong logic nya dito kaya kung mapapansin, baliktad yong link
                     * 1 = Attended
                     * 2 = Registered
                     *
                     * pero dahil toggle type sya, baliktaran dapat. kumbaga, salit-salit.
                     */
                    if ($this->session->employee_role != 1) {
                        if ($val->status == 1) {
                            $status = '<div class="text-center"><a class="btn btn-info btn-sm reg2" href="employee/update/status/' . $val->hash . '/2" data-confirm="This will change the status to Attended">Registered</a></div>';
                        } else if ($val->status == 2) {
                            $status = '<div class="text-center"><a class="btn btn-warning btn-sm att1" href="employee/update/status/' . $val->hash . '/1" data-confirm="This will change the status to Registered">Attended</a></div>';
                        }
                    } else {
                        if ($val->status == 1) {
                            $status = '<div class="text-center"><span class="badge badge-info">Registered</span></div>';
                        } else if ($val->status == 2) {
                            $status = '<div class="text-center"><span class="badge badge-warning">Attended</span></div>';
                        }
                    }
                    break;
                case 3:
                    $status = '<div class="text-center"><span class="badge badge-danger">Assessment</span></div>';
                    break;
                case 4:
                    $status = '<div class="text-center"><span class="badge badge-success">Sign-Up</span></div>';
                    break;
            }

            if ($this->session->employee_role == 1) {
                $data[] = array(
                    '<span class="text-primary campaign">' . $val->campaign_name . '</span>',
                    $val->full_name,
                    $val->email,
                    $val->phone_number,
                    $status,
                    '<div class="text-center"><a href="employee/pay/fees/' . $val->id . '" class="btn btn-default btn-sm pay" data-toggle="modal" data-target="#pay-modal">Fees</a></div>',
                );
            } else {
                $data[] = array(
                    '<span class="text-primary campaign">' . $val->campaign_name . '</span>',
                    $val->full_name,
                    $val->email,
                    $val->phone_number,
                    $status,
                );
            }
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $result->num_rows(),
            "recordsFiltered" => $result->num_rows(),
            "data" => $data
        );

        echo json_encode($output);
    }

    public function updateStatus($hash, $status)
    {
        if (isset($_POST['edit-registered-attended'])) {

            if ($this->Emp_registerm->checkHash($hash) != 1) {
                $this->session->set_flashdata('pay', 'Invalid Parameter!');
                redirect('employee/list/prospect');
            }

            switch ($status) {
                case '1': //registered
                    $new_status = 1;
                    break;
                case '2': //attended
                    $new_status = 2;
                    break;
                default:
                    $this->session->set_flashdata('pay', 'Invalid Status!');
                    redirect('employee/list/prospect');
                    break;
            }

            if ($this->Emp_registerm->updateStatusToAttended($hash, $new_status)) {
                $this->session->set_flashdata('pay_success', 'Status successfully updated');
                redirect('employee/list/prospect');
            }
        } else {
            redirect('employee/list/prospect');
        }
    }

    public function deleteByStatus()
    {
        if (isset($_POST['delete-registered-attended'])) {
            $result = $this->Emp_registerm->deleteRegisteredAndAttended();
            if ($result) {
                $this->session->set_flashdata('delete_register_attended', 'Deleted');
                redirect('employee/list/prospect');
            } else {
                $this->session->set_flashdata('delete_register_attended_row_0', 'There is no data need to be deleted');
                redirect('employee/list/prospect');
            }
        }
    }

    public function walkinTable()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));

        $result = $this->Admin_registerm->getWalkinTable();

        $data = array();

        foreach ($result->result() as $val) {

            $rows = $this->Emp_registerm->checkLatestStatus($val->id_lead);

            $status = '';
            foreach ($rows->result() as $row) {
                if (isset($row)) {
                    if ($row->type == 4) {
                        $status = 4; //Signup or Admin
                        break;
                    } else if ($row->type == 3) {
                        $status = 3; //Assessment
                    }
                }
            }

            switch ($status) {
                case 3:
                    $status_html = '<div class="text-center"><span class="badge badge-danger">Assessment</span></div>';
                    break;
                case 4:
                    $status_html = '<div class="text-center"><span class="badge badge-success">Sign-Up</span></div>';
                    break;
                default:
                    $status_html = '<div class="text-center"><span class="badge badge-secondary">No Status</span></div>';
                    break;
            }

            $raw_data = array(
                $val->client_first . ' ' . $val->client_middle . ' ' . $val->client_last,
                $val->client_email,
                $val->phone,
                $status_html,
            );

            if ($this->session->employee_role == 1) {
                array_push($raw_data, "<div class=\"text-center\"><a href=\"employee/pay/fees/{$val->id_lead}\" class=\"btn btn-default btn-sm pay\" data-toggle=\"modal\" data-target=\"#pay-modal\">Fees</a></div>");
            }

            if($this->session->employee_role == 4){
                if($status == 3 || $status == 4){
                    array_push($raw_data, "<div class=\"text-center\"><span class=\"text-white text-sm bg-dark rounded p-1\">Cannot Remove</span></div>");
                }else{
                    array_push($raw_data, "<div class=\"text-center\"><a href=\"../client/remove/$val->id_lead\" class=\"btn text-white btn-danger text-sm btn-xs delete-client\"><i class=\"fas fa-user-times\"></i> Remove</a></div>");
                }
            }

            $data[] = $raw_data;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $result->num_rows(),
            "recordsFiltered" => $result->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function paymentHistory()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));

        $result = $this->Emp_registerm->getPaymentTable();

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

            $delete_html = '';
            if ($this->session->employee_role == 4) {
                $delete_html = '<a href="../../employee/update/remove/' . $val->hash_payment . '" class="btn text-white btn-danger text-sm btn-xs delete-pay" data-confirm="Are you sure you want to delete? This action cannot be undone."><i class="fas fa-trash-alt"></i></a>';
            }

            $edit_html = '';
            if ($this->session->employee_role == 1) {
                $edit_html = '<div class="text-center"><a href="employee/update/payment/' . $val->hash_payment . '" data-toggle="modal" data-target="#pay-modal" class="btn text-white btn-success text-sm btn-xs edit-payment-history"><i class="fas fa-edit"></i></a>';
            }

            $data[] = array(
                $val->id_lead,
                $val->full_name,
                $type,
                '<div class="text-center">' . $val->amount . '</div>',
                $val->remarks == null ? '<div class="text-center"><span class="badge badge-secondary">No Remarks</span></div>' : $val->remarks,
                '<div class="text-center">' . date('m-d-Y', strtotime($val->date_paid)) . '</div>',
                $edit_html  . $delete_html . '</div>',
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

    public function paymentHistoryWalkin()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('404');
        }

        $draw = intval($this->input->get("draw"));

        $result = $this->Admin_registerm->getPaymentTableWalkin();

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

            $delete_html = '';
            if ($this->session->employee_role == 4) {
                $delete_html = '<a href="../../employee/update/remove/' . $val->hash_payment . '" class="btn text-white btn-danger text-sm btn-xs delete-pay" data-confirm="Are you sure you want to delete? This action cannot be undone."><i class="fas fa-trash-alt"></i></a>';
            }

            $data[] = array(
                $val->id_lead,
                $val->client_first . ' ' . $val->client_middle . ' ' . $val->client_last,
                $type,
                '<div class="text-center">' . $val->amount . '</div>',
                $val->remarks == null ? '<div class="text-center"><span class="badge badge-secondary">No Remarks</span></div>' : $val->remarks,
                '<div class="text-center">' . date('m-d-Y', strtotime($val->date_paid)) . '</div>',
                '<div class="text-center"><a href="employee/update/payment/' . $val->hash_payment . '" data-toggle="modal" data-target="#pay-modal" class="btn text-white btn-success text-sm btn-xs edit-payment-history"><i class="fas fa-edit"></i></a>
                ' . $delete_html . '</div>',
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

    public function remove_client($id_lead)
    {
        if($this->Admin_actionm->remove_client($id_lead)){
            $this->session->set_flashdata('pay_success', 'Client has been safely removed');
            redirect('employee/list/prospect');
        }else{
            $this->session->set_flashdata('message_error', 'Cannot remove the client. Please try later.');
            redirect('employee/list/prospect');
        }
    }

    public function editPayment($hash)
    {
        $type = $this->input->post('type', true);

        switch ($type) {
            case '1':
                $type = 3; //assessment
                break;
            case '2':
                $type = 4; //admin or signup
                break;
            case '3':
                $type = 5;
            default:
                $this->session->set_flashdata('pay', 'Invalid Type!');
                redirect('employee/list/prospect');
                break;
        }

        $data = array(
            'type' => $type,
            'amount' => $this->input->post('amount', true),
            'date_paid' => $this->input->post('user-dob', true),
            'remarks' => $this->input->post('remarks', true),
            'paid_by' => $this->session->employee_realid,
        );

        if ($this->Admin_actionm->editPayment($hash, $data)) {
            $this->session->set_flashdata('pay_success', 'Successfully Editted');
            redirect('employee/list/prospect');
        } else {
            redirect('employee/list/prospect');
        }
    }

    public function removePayment($hash)
    {

        if ($this->Admin_actionm->deletePayment($hash)) {
            $this->session->set_flashdata('pay_success', 'Successfully Deleted');
            redirect('employee/list/prospect');
        } else {
            redirect('employee/list/prospect');
        }
    }

    public function pay($id = null)
    {
        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback">', '</span>');
        $this->form_validation->set_rules('amount', '', 'trim|required|numeric', array('required' => 'Please enter amount', 'numeric' => 'Please enter correct amount'));
        $this->form_validation->set_rules('user-dob', '', 'required', array('required' => 'Please enter date of payment'));

        if ($this->form_validation->run() == false) {
            $data['last_url_pay_error'] = "employee/pay/fees/$id";
            $this->load->view('employee/templates/header');
            $this->load->view('employee/prospect_list', $data);
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/custom_script_lead');
            $this->load->view('employee/templates/end_footer');
        } else {
            $result = $this->Admin_registerm->checkIfIdExists($id);

            if (empty($result)) {

                $result = $this->Admin_registerm->checkIfIdExistsInClients($id);

                if (empty($result)) {
                    $this->session->set_flashdata('pay', 'Invalid Parameter!');
                    redirect('employee/list/prospect');
                }
            }

            $type = $this->input->post('type', true);

            switch ($type) {
                case '1':
                    $type = 3; //assessment
                    break;
                case '2':
                    $type = 4; //admin or signup
                    break;
                case '3':
                    $type = 5; //others
                    break;
                default:
                    $this->session->set_flashdata('pay', 'Invalid Type!');
                    redirect('employee/list/prospect');
                    break;
            }

            $data = array(
                'id' => isset($result->id) ? $result->id : $result->id_lead,
                'hash_payment' => bin2hex(random_bytes(10)),
                'type' => $type,
                'amount' => $this->input->post('amount', true),
                'date_paid' => $this->input->post('user-dob', true),
                'remarks' => $this->input->post('remarks', true),
                'paid_by' => $this->session->employee_realid,
            );

            if ($this->Admin_registerm->pay($data)) {
                /**
                 * 'Client Onboarding' default
                 */
                $type == 4 ? $this->Admin_registerm->autoUpdateStageSwitch($result->id_lead, 1, 'Client Onboarding') : '';
                $this->session->set_flashdata('pay_success', 'Successfully paid');
                redirect('employee/list/prospect');
            }
        }
    }
}
