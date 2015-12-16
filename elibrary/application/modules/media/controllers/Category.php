<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

class Category extends Admin
{
    public function create()
    {
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|min_length[2]|is_unique[categories.name]');

        if ($this->form_validation->run() == FALSE) {
            $this->template->build('category_create');
        } else {
            $media = new Library\Media\Media;
            $media->createCategory(
                set_value('name'),
                set_value('description')
            );

            set_message_success('Kategori berhasil dibuat.');

            redirect('media/show/' . $media->getCategory()->id, 'refresh');
        }
    }

    public function edit($category)
    {

    }

    public function delete($category)
    {
        $media = new Library\Media\Media;
        $media->deleteCategory($category);

        set_message_success('Kategori berhasil dihapus.');

        redirect('media', 'refresh');
    }
}

/* End of file Category.php */
/* Location: ./application/modules/media/controllers/Category.php */