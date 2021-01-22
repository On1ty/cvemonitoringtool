<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_set_mmyy_controller extends CI_Controller
{
    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback" style="display:block;">', '</span>');
        $this->form_validation->set_rules('id-mm', 'Name', 'trim|required', array('required' => 'Please enter MM'));
        $this->form_validation->set_rules('id-yy', 'Password', 'trim|required', array('required' => 'Please enter YY'));
        $this->form_validation->set_rules('id-sequence', '', 'trim|required', array('required' => 'Please enter sequence number'));

        if ($this->form_validation->run() == false) {
            $data['id_settings'] = $this->EmployeeDatabase->id_settings();
            $this->load->view('employee/templates/header');
            $this->load->view('employee/mmyy', $data);
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/end_footer');
        } else {
            $data = array(
                'mm' => $this->input->post('id-mm', true),
                'yy' => $this->input->post('id-yy', true),
                'sequence' => $this->input->post('id-sequence', true),
            );
            $result = $this->EmployeeDatabase->update_id_settings($data);

            if($result){
                $this->session->set_flashdata('success', 'Success');
                redirect('employee/set');
            }else{
                $this->session->set_flashdata('error', 'There is an error while saving. Try again later.');
            }
        }
    }
}
