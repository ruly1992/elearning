<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function index()
    {
        sentinel()->logout();

        redirect(home_url(), 'refresh');
    }

}

/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */