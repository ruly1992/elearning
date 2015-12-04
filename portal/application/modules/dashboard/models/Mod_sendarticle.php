<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Intervention\Image\ImageManager;

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
            'replacement'   => 'dash', // Either dash or underscore
        );

        $this->load->library('slug', $config);
	}

	public function send($data, $status = 'draft', $type = 'private', $featured_image = null, $categories = array())
	{
		$default    = array(
            'date'      => date('Y-m-d H:i:s'),
            'status'    => $status,            
            'type'      => $type,            
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

    public function getById($id)
    {
        $this->db->where('id', $id);

        $query = $this->db->get($this->table);

        return $query->row();
    }

    public function removeFeaturedImage($article_id)
    {
        $this->db->where('id', $article_id);
        $this->db->update('artikel', array('featured_image' => ''));
    }
    
    public function edit($id, $data, $categories = array(), $featured_image = null)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update($this->table);

        $this->db->where('artikel_id', $id);
        $this->db->delete('kategori_has_artikel');

        foreach ($categories as $cat_id) {
            $relation['kategori_id']    = $cat_id;
            $relation['artikel_id']     = $id;

            $this->db->insert('kategori_has_artikel', $relation);
        }

        $remove = set_value('remove_featured_image', 0);        

        if ($remove) {
            $this->removeFeaturedImage($id);
        } else {
            $this->setFeaturedImage($id, $featured_image);
        }

        return $id;

    }

	public function setFeaturedImage($article_id, $featured_image = null)
    {
        if ($featured_image) {
            $source     = $featured_image['tmp_name'];
            $filename   = $featured_image['name'];

            $manager    = new ImageManager;
            $upload_dir = ASSET_MEDIA . 'featured/';
            $image      = $manager->make($source);

            $image->save($upload_dir . $filename, 90);

            $data['featured_image'] = asset('media/featured/' . $filename);
            
            $this->db->where('id', $article_id);        
            $this->db->update('artikel', $data);

            return $image->exif();
        } else {
            return FALSE;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);

        if ($this->db->affected_rows() == 1)
            return TRUE;
            return FALSE;
    }

}

/* End of file Mod_sendArticle.php */
/* Location: ./application/modules/dashboard/models/Mod_sendArticle.php */