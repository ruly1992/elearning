<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tags extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function read(){
		$this->db->from('tags');
		$this->db->order_by('id');
		$query = $this->db->get();

		return $query->result();
	}

	public function create($param){
		$query = $this->db->insert('tags', $param);
		return $this->db->insert_id();
	}

	public function createMany($tags)
	{
		$ids = array();

		foreach ($tags as $name) {
			$ids[] = $this->getOrCreateTag($name)['id'];
		}

		return $ids;
	}

	public function assignToArticle($article_id, $tags)
	{
		$ids = $this->createMany($tags);

		foreach ($ids as $tag_id) {
			$data['artikel_id']	= $article_id;
			$data['tags_id']	= $tag_id;
			$this->db->set($data);
			$this->db->insert('artikel_has_tags');
		}
	}

	public function getByArticle($article_id)
	{		
		$this->db->select('tags.tag');
		$this->db->from('tags');
		$this->db->join('artikel_has_tags', 'artikel_has_tags.tags_id = tags.id');
		$this->db->join('artikel', 'artikel.id=artikel_has_tags.artikel_id');
		$this->db->where('artikel.id', $article_id);
        $query = $this->db->get();

    	return $query->result();
	}

	public function getId($id){
		$this->db->from('tags');
		$this->db->where('id', $id);
		$query=$this->db->get();

		return $query->row_array();
	}

	public function getOrCreateTag($tag){
		$this->db->from('tags');
		$this->db->where('tag', $tag);

		$query = $this->db->get();

		if ($query->num_rows()) {
			return $query->row_array();
		} else {
			$query = $this->create(array('tag' => $tag));
			return $this->getId($query);
		}
	}

	public function update($param,$id){
		$this->db->set($param);
		$this->db->where('id', $id);
		$query=$this->db->update('tags');

		return $query;	
	}

	public function delete($param){
		$query = $this->db->delete('tags',$param);
		return $query;
	}

	public function deleteByArticle($artikel_id)
	{
		$this->db->where('artikel_id', $artikel_id);
		$this->db->delete('artikel_has_tags');
	}


}

/* End of file M_tags.php */
/* Location: ./application/modules/tags/models/M_tags.php */