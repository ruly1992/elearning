<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_sendarticle extends CI_Model {

    protected $table = 'artikel';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$config = array(
            'table'         => 'artikel',
            'id'            => 'id',
            'field'         => 'slug',
            'title'         => 'title',
            'replacement'   => 'dash' // Either dash or underscore
        );

        $this->load->library('slug', $config);
	}

    public function send($data, $status = 'draft', $featured_image = null, $categories = array())
    {
        $default    = array(
            'date'      => date('Y-m-d H:i:s'),
            'status'    => $status,            
        );

        $data           = array_merge($default, $data);
        $data['slug']   = $this->slug->create_uri($data);


        $this->db->set($data);
        $this->db->insert($this->table);

        $article_id = $this->db->insert_id();

        foreach ($categories as $cat_id) {
            $relation['kategori_id']    = $cat_id;
            $relation['artikel_id']     = $article_id;

            $this->db->insert('kategori_has_artikel', $relation);
        }

        $this->setFeaturedImage($article_id, $featured_image);
        
        return $article_id;
    }
}

/* End of file Mod_sendarticle.php */
/* Location: ./application/modules/nonregister/models/Mod_sendarticle.php */