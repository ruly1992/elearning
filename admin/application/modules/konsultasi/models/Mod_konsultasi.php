<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_konsultasi extends CI_Model {

	protected $table = 'konsultasi';

	public function __construct()
	{
		parent::__construct();

		$this->db = $this->load->database('konsultasi', TRUE);

		$config = array(
            'table'         => 'konsultasi',
            'id'            => 'id',
            'field'         => 'slug',
            'title'         => 'subjek',
            'replacement'   => 'dash' // Either dash or underscore
        );

        $this->load->library('slug', $config);
	}

	public function getByIdKonsultasi($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get($this->table);

        return $query->num_rows() ? $query->row() : FALSE;
	}

	public function readKonsultasi()
	{
		$this->db->from('konsultasi');
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function getAllReply($id)
	{
		$data = array('konsultasi.*','rp.isi', 'rp.id_user', 'rp.attachment', 'rp.created_at');
        $get   = $this->db->select($data)->from('konsultasi')->join('reply AS rp','rp.id_konsultasi=konsultasi.id')->where('konsultasi.id',$id)->order_by('rp.created_at', 'DESC')->get();
        return $get->result();
	}

	public function getByKategori($id)
	{
		$this->db->select('*');
		$this->db->from('konsultasi');
		$this->db->join('konsultasi_kategori_has_konsultasi AS kons', 'kons.id_konsultasi = id_konsultasi');
		$this->db->join('konsultasi_kategori', 'konsultasi_kategori.id = kons.id_konsultasi_kategori');
		$this->db->where('konsultasi_kategori.id', $id);

		return $this->db->get();
  		return $query->result();
	}

	public function changeStatus($open,$close)
	{	
		if ($open == 'open') {
			$this->db->update('konsultasi', array('status'=>'close'), array('id'=> $close));
		} else {
			$this->db->update('konsultasi', array('status'=>'open'), array('id'=> $close));
		}
	}

	public function delete_konsultasi_by_kategori($id)
	{
		$delete = $this->db->delete('konsultasi', array('id_kategori'=>$id));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	public function delete_reply($id_konsultasi)
	{
		$this->db->where('id_konsultasi', $id_konsultasi);
        $delete = $this->db->delete('reply');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } else {
            return FALSE;
        }
	}
}

/* End of file Mod_konsultasi.php */
/* Location: ./application/modules/konsultasi/models/Mod_konsultasi.php */