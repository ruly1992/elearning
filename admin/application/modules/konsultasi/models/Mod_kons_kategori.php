<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_kons_kategori extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->db = $this->load->database('konsultasi', TRUE);		
	}

	public function readKategori()
	{
		$query = $this->db->get('konsultasi_kategori');
		return $query->result();
	}

	public function getKategoriList()
	{
		$return[''] = 'Silahkan Pilih Kategori';
	    $query  = $this->db->get('konsultasi_kategori');

	    foreach($query->result_array() as $row){
	        $return[$row['id']] = $row['name'];
	    }
	    return $return;
	}

	public function getKategori()
	{
		$query = $this->db->get('konsultasi_kategori');
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
		 
        return $konsultasi_kategori;
	}

	public function updateKategori($id_kategori, $data)
	{
		$query = $this->db->where('id', $id_kategori)->update('konsultasi_kategori', $data);
		return $query;
	}

	public function delete($id_kategori)
	{
		$delete = $this->db->delete('konsultasi_kategori',array('id'=>$id_kategori));
        if($this->db->affected_rows() == '1'){
            return TRUE;
        }else{
            return FALSE;
        }
	}

	public function delete_kategori_has_konsultasi($id)
	{
		$delete = $this->db->delete('konsultasi_kategori_has_konsultasi', array('id_konsultasi_kategori'=>$id));
        if($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	public function delete_kategori_has_user($id)
	{
		$delete = $this->db->delete('konsultasi_user_has_kategori', array('id_kategori'=>$id));
        if($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	public function getAllGroupByUser()
	{

		$query = $this->db->group_by('user_id')->get('konsultasi_user_has_kategori');

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
		$data = array('konsultasi_kategori.*', 'konsultasi_user_has_kategori.*');
		$get  = $this->db->select($data)
				->from('konsultasi_kategori')
				->join('konsultasi_user_has_kategori', 'konsultasi_kategori.id=konsultasi_user_has_kategori.id_kategori')
				->where('konsultasi_user_has_kategori.user_id', $user_id)
				->get();

		return $get;
	}

	public function addPengampu($data=NULL)
	{
        $this->db->insert('konsultasi_user_has_kategori', $data);
        return $this->db->insert_id();		
	}

	public function deletePengampu($id)
	{
		$this->db->delete('konsultasi_user_has_kategori',array('id'=>$id));
	}
}

/* End of file Mod_kons_kategori.php */
/* Location: ./application/modules/konsultasi/models/Mod_kons_kategori.php */