<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends Admin
{
    public function index()
    {
    	redirect('forum/category', 'refresh');
    }
}

/* End of file Konsultasi.php */
/* Location: ./application/modules/konsultasi/controllers/Konsultasi.php */
