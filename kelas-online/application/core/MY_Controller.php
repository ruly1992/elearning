<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {}

class Admin extends CI_Controller
{
    protected $roles = array('ins');

    public function __construct()
    {
        parent::__construct();

		$this->template->set_layout('dashboard');

        $this->check();
    }

    public function check()
    {
        if (!sentinel()->check()) {
            redirect(login_url(), 'refresh');
        }

        if (!sentinel()->inRole($this->roles)) {
            redirect(site_url(), 'refresh');
        }
    }

    public function checkRole()
    {
        
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */