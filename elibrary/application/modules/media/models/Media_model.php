<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends CI_Model
{
	public function save($data){
		$save = $this->db->insert('media', $data);
	}

	public function getFileData($name, $created_at, $userId, $status){
		$get = $this->db->get_where('media', 
			array(
				'file_name' => $name, 
				'created_at'=> $created_at, 
				'user_id' 	=> $userId,
				'status'	=> $status
			)
		);
		return $get->result();
	}
}
