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

	public function getById($faq_id)
	{
		$this->db->where('id', $faq_id);

		$query = $this->db->get('faqs');

		return $query->num_rows() ? $query->row() : FALSE;
	}

	public function update($faq_id, $data)
	{
		$this->db->set($data);
        $this->db->where('id', $faq_id);

        $query = $this->db->update('faqs');

        return $query;
	}

	public function delete($faq_id)
	{
		$this->db->where('id', $faq_id);
		$this->db->delete('faqs');

		
	}

}

/* End of file Mod_faq.php */
/* Location: ./application/modules/faq/models/Mod_faq.php */