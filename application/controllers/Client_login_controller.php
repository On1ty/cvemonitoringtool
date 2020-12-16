<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_login_controller extends CI_Controller
{
    public function index()
    {
        $count = $this->User_loginm->checkActivation($this->session->userid)->num_rows();

        if ($count != 0) {
            $isActive = $this->User_loginm->checkActivation($this->session->userid)->row()->isActive;
        }

        if ($this->session->userlogged && $isActive != 0) {
            redirect('stages');
        }

        $this->form_validation->set_error_delimiters('<span class="error invalid-feedback" style="display:block;">', '</span>');
        $this->form_validation->set_rules('user-email', 'Email', 'trim|required|valid_email', array('required' => 'Please enter your Email'));
        $this->form_validation->set_rules('user-pass', 'Password', 'required', array('required' => 'Please enter your password'));
        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha', array('required' => 'Please check the captcha form'));

        if ($this->form_validation->run() == false) {
            $page = 'login';

            if (!file_exists(APPPATH . 'views/client/' . $page . '.php')) {
                show_404();
            }

            $this->load->view('client/' . $page);
        } else {
            $result = $this->User_loginm->login_user();

            if (!isset($result)) {
                $this->session->set_flashdata('invalid_user', 'The user email or password is incorrect');
                redirect();
            }

            if ($result['isActive'] == 0) {
                $this->session->set_flashdata('invalid_user', 'Your account is deactivated. You cannot login.');
                redirect();
            }


            $user_session_data = array(
                'userfirst' => $result['client_first'],
                'usermiddle' => $result['client_middle'],
                'userlast' => $result['client_last'],
                'userid' => $result['emp_id'],
                'useridlead' => $result['id_lead'],
                'useremail' => $result['client_email'],
                'userlogged' => true,
            );

            // print_r($user_session_data);

            $this->session->set_userdata($user_session_data);
            redirect('stages');
        }
    }

    public function validate_captcha()
    {
        $captcha = $this->input->post('g-recaptcha-response', true);
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcB27wZAAAAAJKouSYP4bc6S4wlnVWqRr9KY9fG&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

        if ($response . 'success' == false) {
            return false;
        }
        return true;
    }
}
