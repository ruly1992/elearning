<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Article extends CI_Controller {

    public function index()
    {
        $cat_slider = config('privatepage_slider');
        $cat_1      = config('privatepage_category_1');
        $cat_2      = config('privatepage_category_2');
        $cat_3      = config('privatepage_category_3');
        $cat_4      = config('privatepage_category_4');

        $privatepage_slider_title      = Model\Portal\Category::find($cat_slider);
        $privatepage_slider            = Model\Portal\Article::categoryId($cat_slider);

        $privatepage_category_1_title  = Model\Portal\Category::find($cat_1);
        $privatepage_category_1_a      = Model\Portal\Article::onlyRegistered()->categoryId($cat_1)->take(3)->latest('date');
        $privatepage_category_1_b      = Model\Portal\Article::onlyRegistered()->categoryId($cat_1)->take(3)->skip(2)->latest('date');

        $privatepage_category_2_title  = Model\Portal\Category::find($cat_2);
        $privatepage_category_2_a      = Model\Portal\Article::onlyRegistered()->categoryId($cat_2)->take(3)->latest('date');
        $privatepage_category_2_b      = Model\Portal\Article::onlyRegistered()->categoryId($cat_2)->take(3)->skip(2)->latest('date');

        $privatepage_category_3_title  = Model\Portal\Category::find($cat_3);
        $privatepage_category_3_a      = Model\Portal\Article::onlyRegistered()->categoryId($cat_3)->take(3)->latest('date');
        $privatepage_category_3_b      = Model\Portal\Article::onlyRegistered()->categoryId($cat_3)->take(3)->skip(2)->latest('date');

        $privatepage_category_4_title  = Model\Portal\Category::find($cat_4);
        $privatepage_category_4_a      = Model\Portal\Article::onlyRegistered()->categoryId($cat_4)->take(3)->latest('date');
        $privatepage_category_4_b      = Model\Portal\Article::onlyRegistered()->categoryId($cat_4)->take(3)->skip(2)->latest('date');

        $data = array(
            'privatepage_slider_title'      => $privatepage_slider_title ? $privatepage_slider_title->name : '',
            'privatepage_slider'            => $privatepage_slider->count() ? $privatepage_slider->take(9)->latest('date')->get() : collect([]),

            'privatepage_category_1_title'  => $privatepage_category_1_title ? $privatepage_category_1_title->name : 'No Category',
            'privatepage_category_1_a'      => $privatepage_category_1_a->count() ? $privatepage_category_1_a->get() : collect([]),
            'privatepage_category_1_b'      => $privatepage_category_1_b->count() ? $privatepage_category_1_a->get() : collect([]),
            'private_category_1_link'       => $privatepage_category_1_title ? site_url('dashboard/category/show/' . $privatepage_category_1_title->name) : site_url('/'),

            'privatepage_category_2_title'  => $privatepage_category_2_title ? $privatepage_category_2_title->name : 'No Category',
            'privatepage_category_2_a'      => $privatepage_category_2_a->count() ? $privatepage_category_2_a->get() : collect([]),
            'privatepage_category_2_b'      => $privatepage_category_2_b->count() ? $privatepage_category_2_b->get() : collect([]),
            'private_category_2_link'       => $privatepage_category_2_title ? site_url('dashboard/category/show/' . $privatepage_category_2_title->name) : site_url('/'),

            'privatepage_category_3_title'  => $privatepage_category_3_title ? $privatepage_category_3_title->name : 'No Category',
            'privatepage_category_3_a'      => $privatepage_category_3_a->count() ? $privatepage_category_3_a->get() : collect([]),
            'privatepage_category_3_b'      => $privatepage_category_3_b->count() ? $privatepage_category_3_b->get() : collect([]),
            'private_category_3_link'       => $privatepage_category_3_title ? site_url('dashboard/category/show/' . $privatepage_category_3_title->name) : site_url('/'),

            'privatepage_category_4_title'  => $privatepage_category_4_title ? $privatepage_category_4_title->name : 'No Category',
            'privatepage_category_4_a'      => $privatepage_category_4_a->count() ? $privatepage_category_4_a->get() : collect([]),
            'privatepage_category_4_b'      => $privatepage_category_4_b->count() ? $privatepage_category_4_b->get() : collect([]),
            'private_category_4_link'       => $privatepage_category_4_title ? site_url('dashboard/category/show/' . $privatepage_category_4_title->name) : site_url('/'),

            'links'                         => $this->Mod_link->read(),
            'categories'                    => Model\Portal\Category::all(),
        );

        $latests            = Model\Portal\Article::onlyRegistered()->latest('date')->get();
        $data['latest']     = $latests;
        
        $this->template->set('active', 'artikel');
        $this->template->set('sidebar', FALSE);
        $this->template->set_layout('article');    
        $this->template->build('articlePrivate', $data);
    }

    public function show($slug = null)
    {
        try {
            $article                    = Model\Portal\Article::onlyRegistered()->with('contributor', 'comments')->slug($slug);
            $data['article']            = $article;
            $data['contributor']        = $article->contributor;
            $data['comments']           = $article->comments;
            $data['links']              = $this->Mod_link->read();
            
            $article->resolveVisitorUnique();

            if ($article->categories->count()) {
                $data['relevance_title']    = $article->categories->first()->name;
                $data['relevance']          = Model\Portal\Article::categoryId($article->categories->first()->id)
                                                ->where('id', '!=', $article->id)
                                                ->take(6)
                                                ->latest('date')
                                                ->get();
            } else {
                $category_id    = config('homepage_category_1');
                $category       = Model\Portal\Category::find($category_id);

                if ($category) {
                    $data['relevance_title']    = $category->name;
                    $data['relevance']          = $category->articles_registered()->take(9)->latest('date')->get();
                } else {
                    $data['relevance_title']    = 'No Category';
                    $data['relevance']          = collect();
                }
            }

            $this->template->set('active', $article->categories->first() ? $article->categories->first()->id : '');
            $this->template->set_layout('single_private');
            $this->template->title($article->title);
            $this->template->build('show', $data);
        } catch (ModelNotFoundException $e) {
            $data['message'] = 'Artikel tidak ditemukan.';

            $this->template->set('single', TRUE);
            $this->template->set('sidebarCategory', TRUE);
            $this->template->set('railnews', FALSE);
            $this->template->set('sidebar', FALSE);
            $this->template->build('errors/404', $data);
        }
    }
}

/* End of file Article.php */
/* Location: ./application/modules/dashboard/controllers/Article.php */