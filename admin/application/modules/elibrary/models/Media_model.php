<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Media_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->db = $this->load->database('elibrary', TRUE);		
	}

	public function save($data){
		$save = $this->db->insert('media', $data);
	}
	
	public function getFileData($name, $created_at, $userId, $status)
	{
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

	public function update($id, $dataFile)
	{
		$this->db->update('media', $dataFile, array('id'=>$id));
		if($this->db->affected_rows() == '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function cekMeta($id, $key, $value)
	{
		$this->db->get_where('metadata', array('key' => $key, 'value' => $value, 'media_id' => $id));	
		if ($this->db->affected_rows() == '1') { 
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function addMeta($data)
	{
		$this->db->insert('metadata', $data);
	}
	
}