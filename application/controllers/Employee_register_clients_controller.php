<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_register_clients_controller extends CI_Controller
{
    public function index()
    {
        if (!$this->session->employee_logged) {
            redirect('employee');
        }

        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback">', '</span>');
        // $this->form_validation->set_rules('user-select-lead', '', 'trim|required', array('required' => 'Please select lead data'));
        $this->form_validation->set_rules('user-first', '', 'trim|required', array('required' => 'Please enter first name'));
        $this->form_validation->set_rules('user-middle', '', 'trim');
        $this->form_validation->set_rules('user-last', '', 'trim|required', array('required' => 'Please enter last name'));
        $this->form_validation->set_rules('user-dob', '', 'trim|required', array('required' => 'Please enter date of birth'));
        $this->form_validation->set_rules('user-phone', '', 'trim|required|min_length[11]', array('required' => 'Please enter phone number'));
        $this->form_validation->set_rules('user-other-phone', '', 'trim');
        $this->form_validation->set_rules('user-email', '', 'trim|required|valid_email|is_unique[clients.client_email]', array('is_unique' => 'Email is already used!', 'required' => 'Please enter email'));
        $this->form_validation->set_rules('user-select-employer', '', 'trim|required', array('required' => 'Please select counselor'));

        if ($this->form_validation->run() == false) {
            $page = 'register';
            $this->load->view('employee/templates/header_register');
            $this->load->view('employee/' . $page);
            $this->load->view('employee/templates/footer');
            $this->load->view('employee/templates/custom_script_register');
            $this->load->view('employee/templates/end_footer');
        } else {

            $latest_id = $this->Admin_registerm->latest_id();
            $latest_exploded_id = explode('-', $latest_id)[1];
            $real_id = $this->_generateId($latest_exploded_id);
            $lead_id = $this->input->post('user-select-lead', true);

            if (empty($lead_id)) {
                $lead_id = random_string('numeric', 15);
            }

            $data = array(
                'real_id' => $real_id,
                'id_lead' => $lead_id,
                'created_time' => date("c"),
                'client_first' => preg_replace('/\s+/', ' ', ucwords($this->input->post('user-first', true))),
                'client_middle' => preg_replace('/\s+/', ' ', ucwords($this->input->post('user-middle', true))),
                'client_last' => preg_replace('/\s+/', ' ', ucwords($this->input->post('user-last', true))),
                'client_email' => preg_replace('/\s+/', ' ', $this->input->post('user-email', true)),
                'created_by' => $this->input->post('user-select-employer', true),

            );

            $data_info = array(
                'id_lead' => $lead_id,
                'birthdate' => $this->input->post('user-dob', true),
                'phone' => preg_replace('/\s+/', ' ', $this->input->post('user-phone', true)),
                'other_phone' => preg_replace('/\s+/', ' ', $this->input->post('user-other-phone', true)),
            );

            if (
                $this->Admin_registerm->admin_register($data) &&
                $this->Admin_registerm->admin_register_clients_info($data_info)
            ) {

                $data = $this->generateStage($lead_id);
                $this->Admin_registerm->insert_stages($data);

                $folder_name = $lead_id;
                if (!file_exists('uploads/' . $folder_name)) {
                    mkdir('uploads/' . $folder_name, 0777, true);
                }

                $this->session->set_flashdata('registered', 'New Client Registered!');
                redirect('employee/clients/register');
            }
        }
    }

    private function generateStage($lead_id)
    {
        return array(
            array(
                'id_lead' => $lead_id,
                'status' => 'current',
                'stage' => 'Client Onboarding',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Enrollment',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Release of LOA/OOP',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Endorsement to Documentation Team',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Orientation',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Completion',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Compilation',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Assessment & Finalization',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'RCIC Quality Check',
            ),
            array(
                'id_lead' => $lead_id,
                'status' => 0,
                'stage' => 'Lodging of VISA Application',
            ),
        );
    }

    public function employee()
    {
        $q = $this->input->get('q', TRUE);

        if (isset($q)) {
            $result = $this->Admin_registerm->searchEmployee($q);
            $data = array();

            foreach ($result->result() as $val) {
                $data[] = array(
                    'id' => $val->emp_id,
                    'text' => $val->emp_first . ' ' . $val->emp_last . ' [' . $this->role($val->role) . ']',
                );
            }
            echo json_encode($data);
        }
    }

    public function lead_sign_up()
    {
        $q = $this->input->get('q', TRUE);

        if (isset($q)) {
            $result = $this->Admin_registerm->searchLeadData($q);
            $data = array();

            foreach ($result->result_array() as $val) {

                /**
                 * Check muna na'tin kung yong ID mula sa lead_payment ay EQAUL sa ID_LEAD mula sa clients
                 * Kapag EQUAL ito ang ibig sabihin ay meron na ang sinearch na pangalan sa CLIENTS table sa database
                 * Ang rules kasi hindi na pwede makita sa search ang mga naka lista na sa Clients Table.
                 */
                if ($val['id'] != $val['id_lead']) {
                    $splitted_name = $this->_split_name($val['full_name']);
                    $data[] = array(
                        'id' => $val['id'],
                        'text' => $val['full_name'],
                        'first_name' => $splitted_name['first_name'],
                        'middle_name' => $splitted_name['middle_name'],
                        'last_name' => $splitted_name['last_name'],
                        'phone' => $val['phone_number'],
                        'email' => $val['email'],
                    );
                }
            }
            echo json_encode($data);
        }
    }

    public function _generateId($latest_id)
    {
        $this->load->helper('string');
        $new_id = (int)$latest_id;
        return date('my') . '-' . ($new_id + 1);
    }

    private function role($role)
    {
        if ($role == 1)
            return 'Administrator';
        if ($role == 2)
            return 'Marketing';
        if ($role == 3)
            return 'Documentation';
        if ($role == 4)
            return 'Super User';
    }

    /**
     * https://stackoverflow.com/questions/13637145/split-text-string-into-first-and-last-name-in-php
     */
    private function _split_name($name)
    {
        $parts = array();

        while (strlen(trim($name)) > 0) {
            $name = trim($name);
            $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
            $parts[] = $string;
            $name = trim(preg_replace('#' . $string . '#', '', $name));
        }

        if (empty($parts)) {
            return false;
        }

        $parts = array_reverse($parts);
        $name = array();
        $name['first_name'] = $parts[0];
        $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
        $name['last_name'] = (isset($parts[2])) ? $parts[2] : (isset($parts[1]) ? $parts[1] : '');

        return $name;
    }
}
