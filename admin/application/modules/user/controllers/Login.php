<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Library\Auth\Auth;

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->set_layout('login');
            $this->template->build('login');
        } else {
            $email          = set_value('email');
            $password       = set_value('password');
            $credentials    = compact('email', 'password');

            if (sentinel()->authenticate($credentials)) {
                redirect('/', 'refresh');
            } else {
                set_message_error('Username atau password salah.');

                redirect('login', 'refresh');
            }
        }
    }

}

/* End of file Login.php */
/* Location: ./application/modules/user/controllers/Login.php */