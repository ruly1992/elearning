<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {}

class Admin extends CI_Controller
{
    protected $roles = array('su', 'adm', 'edt', 'ctr', 'lnr');

    public function __construct()
    {
        parent::__construct();

        $this->check();
    }

    public function check()
    {
        if (!sentinel()->check()) {
            redirect('login', 'refresh');
        }

        if (!sentinel()->inRole($this->roles)) {
            set_message_error('Anda tidak mempunyai hak akses.');

            redirect('login', 'refresh');
        }
    }

    public function checkRole()
    {
        
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */