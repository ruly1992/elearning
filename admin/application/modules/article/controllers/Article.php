<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Article extends Admin {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mod_artikel');
        $this->load->model('tags/M_tags');
        $this->load->model('kategori/M_kategori');

        $this->status = array(
            'publish'   => 'Publish',
            'draft'     => 'Draft',
        );

        $this->load->library('pagination');
    }

    public function index()
    {

        $request    = Request::createFromGlobals();
        $articles   = Model\Article::published()->latest('date')->get();
        $status     = 'publish';

        if ($request->query->has('status')) {
            $status = $request->query->get('status');
            
            if ($status === 'draft') {
                $articles   = Model\Article::withDrafts()->status($status)->latest('date')->get();            
            } elseif ($status === 'schedule') {
                $articles   = Model\Article::withDrafts()->scheduled()->latest('date')->get();
            } elseif ($status === 'all') {
                $articles   = Model\Article::latest('date')->get();
            }
        }        

        $data['artikel']    = $articles;
        $data['status']     = $status;

       $this->template->build('index', $data);
    }

    public function add()
    {
        $user = auth()->user();

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['categories_checkbox']    = $this->M_kategori->generateCheckbox();
            $data['status']                 = $this->status;
            
            $this->template->build('create', $data);
        } else {
            $artikel    = array(
                'title'             => set_value('title'),
                'content'           => set_value('content', '', FALSE),
                'published'         => set_value('published', '0000-00-00 00:00:00'),
                'type'              => set_value('type', 'public'),
                'slider'            => set_value('slidercarousel', ''),
                'featured_image'    => set_value('featured', ''),
                'contributor_id'    => $user->id,
                'editor_id'         => $user->id,
            );

            $categories = set_value('categories', array());
            $tags       = set_value('tags', array());
            $status     = set_value('status', 'publish');

            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['tmp_name']) {
                $featured_image = $_FILES['featured_image'];
            } else {
                $featured_image = null;
            }

            if (isset($_FILES['slider']) && $_FILES['slider']['tmp_name']) {
                $slider = $_FILES['slider'];
            } else {
                $slider = null;
            }

            if (set_value('private', 0)) {
                $artikel['type'] = 'private';
            } else {
                $artikel['type'] = 'public';
            }

            if (set_value('with_schedule', 0)) {
                $artikel['published'] = set_value('published');
            } else {
                $artikel['published'] = '0000-00-00 00:00:00';
            }

            $id = $this->Mod_artikel->create($artikel, $categories, $tags, $status, $featured_image, $slider);

            set_message_success('Artikel berhasil dibuat.');

            redirect('article/edit/'.$id, 'refresh');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == FALSE) {   
            $artikel = $this->Mod_artikel->getById($id);

            $cat_ids = array_map(function ($cat) {
                return $cat->kategori_id;
            }, $this->M_kategori->getByArticle($id));

            $tag_ids = array();

            foreach ($this->M_tags->getByArticle($id) as $row) {
                $tag_ids[$row->tag] = $row->tag;
            }
            
            $data['artikel']                = $artikel;
            $data['categories_checkbox']    = $this->M_kategori->generateCheckbox(0, $cat_ids);
            $data['tags']                   = $tag_ids;
            $data['status']                 = $this->status;

            $this->template->build('edit', $data);
        } else {
            $artikel    = array(
                'title'             => set_value('title'),
                'content'           => set_value('content', '', FALSE),
                'status'            => set_value('status'),
                'slider'            => set_value('slidercarousel', ''),
                'featured_image'    => set_value('featured', ''),
            );

            $article = Model\Article::withDrafts()->find($id);

            if ($article->status == 'draft' && $article->editor_id == 0)
                $artikel['editor_id'] = auth()->user()->id;

            if (set_value('with_schedule', 0)) {
                $artikel['published'] = set_value('published');
            } else {
                $artikel['published'] = '0000-00-00 00:00:00';
            }

            $categories = set_value('categories', array());
            $tags       = set_value('tags', array());

            if (isset($_FILES['featured_image']) && $_FILES['featured_image']['tmp_name']) {
                $featured_image = $_FILES['featured_image'];
            } else {
                $featured_image = null;
            }

            if (isset($_FILES['slider']) && $_FILES['slider']['tmp_name']) {
                $slider = $_FILES['slider'];
            } else {
                $slider = null; 
            }

            $id = $this->Mod_artikel->update($id, $artikel, $categories, $tags, $featured_image, $slider);

            set_message_success('Artikel berhasil diperbarui.');

            redirect('article/edit/'.$id, 'refresh');
        }
    }

    public function delete($id)
    {
        $delete = $this->Mod_artikel->delete($id);

        if ($delete) {
            set_message_success('Artikel berhasil dihapus.');
        } else {
            set_message_error('Artikel gagal dihapus.');
        }

        redirect('article', 'refresh');
    }
}

/* End of file Artikel.php */
/* Location: ./application/modules/artikel/controllers/Artikel.php */