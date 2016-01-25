<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_forum');
    }

    public function index()
    {
        $data['users']      = sentinel()->findRoleBySlug('ta')->users->pluck('email', 'id')->toArray();
        $forum              = collect(Model\Forum\Category::all());
        $data['categories'] = pagination($forum, '5', 'forum/category');

        $this->template->build('category_index', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();

            redirect('forum/category', 'refresh');
        } else {
            $name           = $this->input->post('name');
            $users          = $this->input->post('tenagaahli', []);
            $same           = FALSE;

            $categories     = Model\Forum\Category::all();
            foreach($categories as $cat){
                if($cat->category_name == $name){
                    $same   = TRUE;
                }
            }
            if($same == FALSE){
                $category       = new Model\Forum\Category;
                $category->name = $name;
                $category->save();

                $category->users()->attach($users);

                set_message_success('Kategori forum berhasil ditambahkan.');
            }else{
                set_message_error('Kategori '.$name.' sudah ada.');
            }
            
            redirect('forum/category', 'refresh');
        }
    }

    public function edit($id)
    {
        $category           = Model\Forum\Category::findOrFail($id);

        $this->form_validation->set_rules('name', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['category']   = $category;
            $data['users']      = sentinel()->findRoleBySlug('ta')->users->pluck('email', 'id')->toArray();

            $this->template->build('category_edit', $data);
        } else {
            $category->name     = set_value('name');
            $category->save();
            $category->users()->sync(set_value('tenagaahli', []));

            set_message_success('Kategori forum berhasil diperbarui.');

            redirect('forum/category', 'refresh');
        }
    }

    public function delete($id)
    {
        $category = Model\Forum\Category::findOrFail($id);
        $category->users()->detach();
        $this->Mod_forum->deleteTopics($id);
        $this->Mod_forum->deleteThreads($id);
        $category->delete();

        set_message_success('Kategori forum berhasil dihapus.');

        redirect('forum/category', 'refresh');
    }

}

/* End of file Category.php */
/* Location: ./application/modules/forum/controllers/Category.php */