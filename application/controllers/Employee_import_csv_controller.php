<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_import_csv_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('csvimport');
        // $this->load->library('csvreader');
        $this->load->helper('file');
    }

    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback" style="display: block;">', '</span>');
        $this->form_validation->set_rules('csv-input-file', '', 'callback__file_validation');

        if ($this->form_validation->run() == false) {
            $this->load->view('employee/templates/header');
            $this->load->view('employee/import');
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/custom_script_import');
            $this->load->view('employee/templates/end_footer');
        } else {

            $file_data = $this->csvimport->get_array($_FILES["csv-input-file"]["tmp_name"]);

            if (empty($file_data)) {
                $this->session->set_flashdata('imported_empty', 'Invalid File Format - please check your file.');
                redirect('employee/import/csv');
            }

            foreach ($file_data as $row) {

                if (!array_key_exists('id', $row)) {
                    $this->session->set_flashdata('imported_empty', 'Invalid File Format - please check your file.');
                    redirect('employee/import/csv');
                }

                $data = array(
                    'hash' => bin2hex(random_bytes(10)),
                    'id' => str_replace('l:', '', $row["id"]),
                    'campaign_id' => str_replace('c:', '', $row["campaign_id"]),
                    'campaign_name' => $row["campaign_name"],
                    'full_name' => $this->checkNameColumn($row),
                    'email'  => $row["email"],
                    'phone_number'   => str_replace('p:', '', $row["phone_number"]),
                    'imported_date'   => date('c'),
                );

                $noDuplicate = $this->Emp_registerm->deDup($data);

                if ($noDuplicate == 0) {
                    $data_append[] = $data;
                } else {
                    $data_dedup[] = $data;
                }
            }

            if (empty($data_append)) {
                $this->session->set_flashdata('imported_empty', 'Invalid Upload File: The CSV file contains records that were previously uploaded.');
                redirect('employee/import/csv');
            }

            if ($this->Emp_registerm->lead_register($data_append)) {

                if (empty($data_dedup)) {
                    $data_dedup_count = 0;
                } else {
                    $data_dedup_count = count($data_dedup);
                }

                $this->session->set_flashdata('imported', 'Imported [<b>' . count($data_append) . '</b>] record/s successfully and [<b>' . $data_dedup_count . '</b>] duplicate record/s skip.');
                redirect('employee/import/csv');
            }
        }
    }

    private function checkNameColumn($row){
        $full_name = null;
        if($row["full_name"]){
            $full_name = $row["full_name"];
        }elseif($row["first_name"] || $row["last_name"]){
            $full_name = $row["first_name"] . ' ' .  $row["last_name"];
        }

        return utf8_encode($full_name);
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

            $data[] = array(
                $val->id,
                '<span class="text-primary campaign">' . $val->campaign_name . '</span>',
                $val->full_name,
                $val->email,
                $val->phone_number,
                $this->_status($status),
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

    public function _file_validation()
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        if (!isset($_FILES['csv-input-file']['name']) && $_FILES['csv-input-file']['name'] == "") {
            $this->form_validation->set_message('_file_validation', 'Please select a CSV file to upload.');
            return false;
        }

        $mime = get_mime_by_extension($_FILES['csv-input-file']['name']);
        $fileAr = explode('.', $_FILES['csv-input-file']['name']);
        $ext = end($fileAr);

        if (($ext != 'csv') && !in_array($mime, $allowed_mime_types)) {
            $this->form_validation->set_message('_file_validation', 'Please select only CSV file to upload.');
            return false;
        }

        return true;
    }

    private function _status($status)
    {
        switch ($status) {
            case 1: //'registered'
                return '<div class="text-center"><span class="badge badge-info">Registered</span></div>';
            case 2: //'attended'
                return '<div class="text-center"><span class="badge badge-warning">Attended</span></div>';
            case 3: //'assessment'
                return '<div class="text-center"><span class="badge badge-danger">Assessment</span></div>';
            case 4: //'admin or signup'
                return '<div class="text-center"><span class="badge badge-success">Sign-Up</span></div>';
        }
    }
}
