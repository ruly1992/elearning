<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function status($id, $open)
    {
        if ($open == 'open') {
            $this->db->update('konsultasi', array('status'=>'close'), array('id'=> $id));
        } else {
            $this->db->update('konsultasi', array('status'=>'open'), array('id'=> $id));
        }
    }
}

/* End of file M_konsultasi.php */
/* Location: ./application/modules/konsultasi/models/M_konsultasi.php */