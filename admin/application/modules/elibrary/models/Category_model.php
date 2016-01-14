<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->db = $this->load->database('elibrary', TRUE);		
	}

	public function getKategoriList()
	{
		$return[''] = 'Silahkan Pilih Kategori';
	    $query  = $this->db->get('categories');

	    foreach($query->result_array() as $row){
	        $return[$row['id']] = $row['name'];
	    }
	    return $return;
	}

	public function getAllGroupByUser()
	{
		$query = $this->db->group_by('user_id')->get('category_user');

		$grouped = array();

		foreach ($query->result() as $user) {
			$user_categories = $this->getUserKategori($user->user_id);

			$grouped[] = array(
				'user'			=> user($user->user_id),
				'categories'	=> $user_categories->result(),
				'count'			=> $user_categories->num_rows(),
			);
		}

  		return $grouped;
	}

	public function getUserKategori($user_id)
	{
		$data = array('categories.*', 'category_user.*');
		$get  = $this->db->select($data)
				->from('categories')
				->join('category_user', 'categories.id=category_user.category_id')
				->where('category_user.user_id', $user_id)
				->get();

		return $get;
	}

	public function getPengampu()
	{
		$query = $this->db->get('category_user');
		return $query->result();
	}

	public function addPengampu($data=NULL)
	{
        $this->db->insert('category_user', $data);
        return $this->db->insert_id();		
	}

	public function deletePengampu($id)
	{
		$this->db->delete('category_user',array('id'=>$id));
	}
}

/* End of file Category_model.php */
/* Location: ./application/modules/elibrary/models/Category_model.php */