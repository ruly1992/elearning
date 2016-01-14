<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_link extends CI_Model {

	public function read()
	{
		$query = $this->db->order_by('id', 'desc')->get('links', 6);
        return $query->result();
	}

	public function getAll()
	{
		$query = $this->db->order_by('id', 'desc')->get('links');
		
        return $query->result();
	}

}

/* End of file Mod_link.php */
/* Location: ./application/modules/link/models/Mod_link.php */