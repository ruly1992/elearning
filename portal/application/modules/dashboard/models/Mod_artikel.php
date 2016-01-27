<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_artikel extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getRecentComment($id)
	{
		$get 	= $this->db->select(array('artikel.*', 'komentar.status AS komentarStatus'))
						->from('artikel')
						->join('komentar', 'komentar.artikel_id=artikel.id')
						->where(array(
							'komentar.user_id' 	=> $id,
							'artikel.status' 	=> 'publish'
						))
						->group_by('artikel.id')
						->order_by('artikel.id', 'desc')
						->limit(5)
						->get()
						->result();
		return $get;
	}
}

/* End of file Mod_artikel.php */
/* Location: ./application/modules/dashboard/models/Mod_artikel.php */