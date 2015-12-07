<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_faq extends CI_Model {

	public function getAll()
	{
		$query = $this->db->get('faqs');

		return $query->result();
	}

	public function create($data)
	{
		$query = $this->db->insert('faqs', $data);

		return $this->db->insert_id();
	}

}

/* End of file Mod_faq.php */
/* Location: ./application/modules/faq/models/Mod_faq.php */