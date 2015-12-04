<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Intervention\Image\ImageManager;

class Mod_artikel extends CI_Model {

    protected $table = 'artikel';

    public function __construct()
    {
        parent::__construct();

        $config = array(
            'table'         => 'artikel',
            'id'            => 'id',
            'field'         => 'slug',
            'title'         => 'title',
            'replacement'   => 'dash' // Either dash or underscore
        );

        $this->load->library('slug', $config);
        $this->load->model('tags/M_tags');
    }

    public function mustPublicAndPublished()
    {        
        $this->db->where("status = 'publish' AND (published = 'NULL' OR published <= '".date('Y-m-d H:i:s')."')");
    }

    public function filterBy($column, $value)
    {

    }

    public function getLatest()
    {
        $this->db->order_by('date', 'DESC');
        
        $query = $this->db->get($this->table);

        return $query->result();
    }
    public function getLatestPagging($halaman, $offset)
    {
        $this->db->order_by('date', 'DESC');

        //$this->db->limit(10, 5);
        
        // $query = $this->db->get('artikel');

        //$this->db->limit($halaman , $offset);

        return $query = $this->db->get('artikel', $halaman, $offset)->result();
    }

    public function getPopuler()
    {
        $this->db->select($this->table.'.*, COUNT(va.id) AS visitor');
        $this->db->join('visitor_artikel AS va', 'va.artikel_id = '.$this->table.'.id');
        $this->db->group_by($this->table.'.id');
        $this->db->order_by('visitor', 'DESC');
        
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function getById($id)
    {
        $this->db->where('id', $id);

        $query = $this->db->get($this->table);

        return $query->row();
    }

    public function getByCategory($id)
    {
        $this->db->select('artikel.*');
        $this->db->from('artikel');
        $this->db->join('kategori_has_artikel AS pivot', 'pivot.artikel_id = artikel.id');
        $this->db->join('kategori', 'kategori.id = pivot.kategori_id');
        $this->db->where('kategori.id', $id);

        return $this->db->get();
    }

    public function saveToDraft($data, $categories = array(), $featured_image = null)
    {
        return $this->create($data, $categories, 'draft', $featured_image);
    }

    public function setFeaturedImage($article_id, $featured_image = null)
    {
        if ($featured_image) {
            $source     = $featured_image['tmp_name'];
            $filename   = $featured_image['name'];

            $manager    = new ImageManager;
            $upload_dir = BASEPATH . '../assets/upload/featured/';
            $image      = $manager->make($source);

            $image->save($upload_dir . $filename, 90);

            $data['featured_image'] = $filename;
            
            $this->db->where('id', $article_id);        
            $this->db->update('artikel', $data);

            return $image->exif();
        } else {
            return FALSE;
        }
    }

    public function removeFeaturedImage($article_id)
    {
        $this->db->where('id', $article_id);
        $this->db->update('artikel', array('featured_image' => ''));
    }

    public function setCarouselImage($article_id, $slider = null)
    {
        if ($slider) {
            $source     = $slider['tmp_name'];
            $filename   = $slider['name'];

            $manager    = new ImageManager;
            $upload_dir = BASEPATH . '../assets/upload/slider/';
            $image      = $manager->make($source);

            $image->save($upload_dir . $filename, 90);

            $data['slider'] = $filename;

            $this->db->where('id', $article_id);
            $this->db->update('artikel', $data);

            return $image->exif();
        } else {
            return FALSE;
        }
    }

    public function removeCarouselImage($article_id)
    {
        $this->db->where('id', $article_id);
        $this->db->update('artikel', array('slider' => ''));
    }

    public function setType($id, $type)
    {
        $data['type'] = $type;

        $this->db->where('id', $id);
        $this->db->update('artikel', $data);
    }

    public function create($data, $categories = array(), $tags = array(), $status = 'publish', $featured_image = null, $slider = null)
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

        $this->M_tags->assignToArticle($article_id, $tags);
        $this->setFeaturedImage($article_id, $featured_image);
        $this->setCarouselImage($article_id, $slider);

        return $article_id;
    }

    public function setDatetimePublished($id, $datetime)
    {
        $data['published'] = $datetime;
        
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update($this->table);

        if ($this->db->affected_rows())
            return TRUE;
            return FALSE;
    }

    public function update($id, $data, $categories = array(), $tags = array(), $featured_image = null, $slider = null)
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

        $this->M_tags->deleteByArticle($id);
        $this->M_tags->assignToArticle($id, $tags);

        $remove = set_value('remove_featured_image', 0);
        $removeCarousel = set_value('remove_carousel_image', 0);

        if ($remove) {
            $this->removeFeaturedImage($id);
        } else {
            $this->setFeaturedImage($id, $featured_image);
        }

        if ($removeCarousel) {
            $this->removeCarouselImage($id);
        } else {
            $this->setCarouselImage($id, $slider);
        }

        return $id;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);

        if ($this->db->affected_rows() == 1)
            return TRUE;
            return FALSE;
    }

    public function visit($id)
    {
        $ip_address = $this->getRealIpAddr();
        
        $this->db->where('artikel_id', $id);
        $this->db->where('ip_address', $ip_address);

        $query = $this->db->get('visitor_artikel');

        if ($query->num_rows() == 0) {
            $this->db->set(array(
                'ip_address'    => $ip_address,
                'artikel_id'    => $id,
                'date'          => date('Y-m-d H:i:s'),
            ));
            $this->db->insert('visitor_artikel');
        }
    }

    protected function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }



}

/* End of file Mod_artikel.php */
/* Location: ./application/modules/artikel/models/Mod_artikel.php */