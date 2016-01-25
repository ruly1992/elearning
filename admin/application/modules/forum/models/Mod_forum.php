<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_forum extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->db = $this->load->database('forum', TRUE);		
	}

	public function deleteTopics($cat_id)
	{
		$this->db->where('category', $cat_id);
		$this->db->delete('topics');
	}

	public function deleteThreads($cat_id)
	{
		$this->deleteThreadMembers($cat_id);
		$this->db->where('category', $cat_id);
		$this->db->delete('threads');
	}

	public function deleteThreadMembers($cat_id)
	{
		$idThreads 	= $this->db->select('*')->from('threads')->where('category', $cat_id)->get()->result();
		foreach($idThreads as $thread){
			$this->db->where('thread_id', $thread->id);
			$this->db->delete('thread_members');
		}
	}

}

/* End of file Mod_forum.php */
/* Location: ./application/modules/forum/models/Mod_forum.php */