<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konsultasi extends CI_Model {

	public function readKonsultasi()
    {
        $data = array('konsultasi.*','konsultasi_kategori.name');
        $get   = $this->db->select($data)->from('konsultasi')->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')->order_by('konsultasi.created_at', 'DESC')->get();
        return $get->result();
    }

}

/* End of file M_konsultasi.php */
/* Location: ./application/modules/konsultasi/models/M_konsultasi.php */