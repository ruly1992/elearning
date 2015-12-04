<?php 

class Model_thread extends CI_Model 
{
	function save_thread($data)
	{
		if($this->db->insert('tb_thread',$data)){
		  return TRUE;
		} else {
		  return FALSE;
		}
	}
	
	function delete_thread($id)
	{
		$delete = $this->db->delete('tb_thread',array('id'=>$id));
		if($delete){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function update_thread($id,$data)
	{
		$where="id = '".$id."'"; 
		$update = $this->db->update('tb_thread', $data, $where); 
		
		if($update){
			return TRUE;
		}
		return FALSE;
	}
	
	function count_thread()
	{
		return $this->db->count_all('tb_thread');
	}
	
	function get_thread($id)
	{
		$get =  $this->db->get_where('tb_thread', array('id' => $id));
		return $get->result();
	}
	
	function get_category()
	{
		$get = $this->db->get('tb_category');
		return $get->result();
	}
	
	function get_all_thread()
	{
		$items = array('tb_thread.id','tb_thread.category','tb_thread.topic','tb_thread.type','tb_thread.title','tb_thread.message','tb_thread.created_at','tb_thread.views','tb_thread.author','tb_thread.status','tb_category.category_name');
		$get = $this->db->select($items)->from('tb_thread')->join('tb_category','tb_category.id=tb_thread.category')->get();
		return $get->result();
	}
}