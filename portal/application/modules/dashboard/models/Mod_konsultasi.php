<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_konsultasi extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('konsultasi', TRUE);	
	}

	public function getKonsultasiKategori()
    {
        $query = $this->db->get('konsultasi_kategori'); 

        return $query->result();
    }

    public function getKonsultasi($user_id)
    {
    	$data = array('konsultasi.*','konsultasi_kategori.name');
        $get  = $this->db->select($data)->from('konsultasi')
                ->join('konsultasi_kategori','konsultasi_kategori.id=konsultasi.id_kategori')
                ->where('konsultasi.user_id', $user_id)
                ->order_by('konsultasi.created_at', 'DESC')
                ->limit(3)->get();
        return $get->result();
    }

    public function getLatestReply($user_id)
    {
    	$data = array('konsultasi.*','rp.isi', 'rp.id_user', 'rp.attachment', 'rp.created_at');
        $get   = $this->db->select($data)->from('konsultasi')->join('reply AS rp','rp.id_konsultasi=konsultasi.id')->where('rp.id_user',$user_id)->order_by('rp.created_at', 'DESC')->limit(3)->get();
        return $get->result();
    }
}

/* End of file Mod_konsultasi.php */
/* Location: ./application/modules/dashboard/models/Mod_konsultasi.php */