<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_konsultasi extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('konsultasi', TRUE);	
	}

	public function getKonsultasiKategori()
    {
        $query = $this->db->get('konsultasi_kategori'); 

        return $query->result();
    }
}

/* End of file Mod_konsultasi.php */
/* Location: ./application/modules/dashboard/models/Mod_konsultasi.php */