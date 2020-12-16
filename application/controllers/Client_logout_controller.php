<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_logout_controller extends CI_Controller
{

    public function index()
    {
        $this->session->unset_userdata('userfirst');
        $this->session->unset_userdata('usermiddle');
        $this->session->unset_userdata('userlast');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('userphone');
        $this->session->unset_userdata('useremail');
        $this->session->unset_userdata('userlogged');
        $this->session->unset_userdata('useridlead');

        redirect();
    }
}
