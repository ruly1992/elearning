<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin {

    public function index()
    {
        $data['users']      = sentinel()->findRoleBySlug('ta')->users->pluck('email', 'id')->toArray();
        $data['categories'] = Model\Forum\Category::all();

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

            $category       = new Model\Forum\Category;
            $category->name = $name;
            $category->save();

            $category->users()->attach($users);

            set_message_success('Kategori forum berhasil ditambahkan.');

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
        // $category->topics()->delete();
        $category->delete();

        set_message_success('Kategori forum berhasil dihapus.');

        redirect('forum/category', 'refresh');
    }

}

/* End of file Category.php */
/* Location: ./application/modules/forum/controllers/Category.php */