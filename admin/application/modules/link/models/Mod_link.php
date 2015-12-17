<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_link extends CI_Model {

	public function read()
	{
		$query = $this->db->get('links');
        return $query->result();
	}

	public function create($data)
	{
		$query = $this->db->insert('links', $data);

		return $this->db->insert_id();
	}

	public function update($link_id, $data)
	{
		$this->db->set($data);
        $this->db->where('id', $link_id);

        $query = $this->db->update('links');

        return $query;
	}

	public function delete($link_id)
    {
       	$this->db->where('id', $link_id);
        $this->db->delete('links');

        if ($this->db->affected_rows() == 1)
            return TRUE;
            return FALSE;
    }

	public function getById($link_id)
	{
		$this->db->where('id', $link_id);

        $query = $this->db->get('links');

        return $query->num_rows() ? $query->row() : FALSE;
	}	

}

/* End of file Mod_link.php */
/* Location: ./application/modules/link/models/Mod_link.php */