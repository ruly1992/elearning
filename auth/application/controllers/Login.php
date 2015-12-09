<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (sentinel()->check()) {
            $redirect_url = dashboard_url();

            if (sentinel()->inRole(['su', 'adm', 'edt', 'pus', 'ins', 'pcp']))
                $redirect_url = admin_url();
            
            redirect($redirect_url, 'refresh');
        }
    }

    public function index()
    {
    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    	$this->form_validation->set_rules('password', 'Password', 'required');

    	if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();

	    	$this->template->set_layout('login');
	        $this->template->build('login');
    	} else {
    		$credentials = [
    			'email'		=> set_value('email'),
    			'password'	=> set_value('password'),
    		];

    		if (sentinel()->authenticate($credentials)) {
                $redirect_url = dashboard_url();

                if (sentinel()->inRole(['su', 'adm', 'edt', 'pus', 'ins', 'pcp']))
                    $redirect_url = admin_url();

    			redirect($redirect_url, 'refresh');
    		} else {
    			set_message_error('Email atau password Anda salah.');

    			redirect(login_url(), 'refresh');
    		}
    	}
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */