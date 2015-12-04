<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_kons_kategori extends CI_Model {

	public function readKategori()
	{
		$query = $this->db->get('konsultasi_kategori');
		return $query->result();
	}
	
	public function getByIdKategori($id_kategori)
	{
		$query = $this->db->where('id',$id_kategori)->get('konsultasi_kategori');
		return $query;	
	}

	public function addKategori($data, $tenaga_ahli = array())
	{
		$konsultasi_kategori = $this->db->insert('konsultasi_kategori', $data);
        $kategori = $this->db->insert_id();


		// foreach ($tenaga_ahli as $user_id) {
		// 	$relation['user_id']	 		= $user_id;
		// 	$relation['id_kategori']		= $kategori;

		// 	$this->db->insert('user_kategori', $relation);
		// }
		 
        return $konsultasi_kategori;
	}

	public function updateKategori($id_kategori, $data)
	{
		$query = $this->db->where('id', $id_kategori)->update('konsultasi_kategori', $data);
		return $query;
	}

	public function delete($id_kategori)
	{
		$this->db->where('id', $id_kategori);
		$this->db->delete('konsultasi_kategori');
	}

	public function getByUser($user_id=0)
	{
		$query = $this->db->where('user_id',$user_id)->get('profile');
		return $query;	
	}

	public function getUserGroups()
	{
		$this->db->select('profile.*');
		$this->db->from('users_groups');
		$this->db->join('users', 'users_groups.user_id = users.id');
		$this->db->join('profile', 'profile.user_id = users.id');
		$this->db->where('users_groups.group_id', 10);

		$query = $this->db->get();
  		return $query->result();
	}
}

/* End of file Mod_kons_kategori.php */
/* Location: ./application/modules/konsultasi/models/Mod_kons_kategori.php */