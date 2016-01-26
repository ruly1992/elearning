<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_forum extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('forum', TRUE);	
	}

	public function getMemberNotif($id)
	{
		$get 	= $this->db->select('*')
						->from('threads')
						->join('thread_members', 'thread_members.thread_id=threads.id')
						->where(array('user_id' => $id, 'thread_members.notif_status' => '1'))
						->get()
						->result();
		return $get;
	}

	public function confirm($where, $data)
	{
		$this->db->where($where);
		$this->db->update('thread_members', $data);
		if($this->db->affected_rows() == '1'){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function getCategoryMember($id)
	{
		$get 	= $this->db->select('categories.*')
						->from('categories')
						->join('threads', 'threads.category=categories.id')
						->where('threads.author', $id)
						->group_by('categories.category_name')
						->order_by('categories.id', 'desc')
						->get()
						->result();
		return $get;
	}

	public function getLatestComment($id)
	{
		$get 	= $this->db->select('*')
						->from('threads')
						->where(array(
							'author' 		=> $id,
							'reply_to !=' 	=> '0'
						))
						->order_by('id', 'desc')
						->limit(1)
						->get()
						->result();
		return $get;
	}

	public function threadLatestComment($id)
	{
		$get 	= $this->db->get_where('threads', array('id' => $id));
		return $get->result();
	}

	public function allThreads($id)
	{
		$get 	= $this->db->get_where('threads', array('author' => $id))->result();
		return $get;
	}

	public function newComments($listNewThreadComments)
	{
		$get 	= $this->db->select('*')
						->from('threads')
						->where('notif_status', '1')
						->where_in('reply_to', $listNewThreadComments)
						->order_by('id', 'desc')
						->get()
						->result();
		return $get;
	}

	public function newCommentChecked($where, $data)
	{
		$this->db->where($where);
		$this->db->update('threads', $data);
		if($this->db->affected_rows() == '1'){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

/* End of file Mod_konsultasi.php */
/* Location: ./application/modules/dashboard/models/Mod_konsultasi.php */