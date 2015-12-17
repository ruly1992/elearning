<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin {

	public function index()
	{
		$data['pages']	= Model\Page::latest('date')->get();

		$this->template->build('index', $data);
	}

    public function add()
    {
        $user = auth()->user();

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->build('create');
        } else {
            $data    = array(
                'title'             => set_value('title'),
                'content'           => set_value('content', '', FALSE),
                'featured_image'    => set_value('featured', ''),
                'contributor_id'    => $user->id,
                'date'				=> Carbon\Carbon::now(),
            );

	        $config = array(
	            'table'         => 'pages',
	            'id'            => 'id',
	            'field'         => 'slug',
	            'title'         => 'title',
	            'replacement'   => 'dash' // Either dash or underscore
	        );

	        $this->load->library('slug', $config);

			$data['slug']   = $this->slug->create_uri($data);

            $page = Model\Page::create($data);

            set_message_success('Halaman berhasil dibuat.');

            redirect('pages/edit/'.$page->id, 'refresh');
        }
    }

    public function edit($page_id)
    {
    	$this->form_validation->set_rules('title', 'Judul Halaman', 'required');

    	$page = Model\Page::findOrFail($page_id);

    	if ($this->form_validation->run() == FALSE) {
	    	$data['page'] = $page;

	    	$this->template->build('edit', $data);
    	} else {
            $data    = array(
                'title'             => set_value('title'),
                'content'           => set_value('content', '', FALSE),
                'featured_image'    => set_value('featured', ''),
            );

            $page->update($data);

            set_message_success('Halaman berhasil diperbarui.');

            redirect('pages/edit/' . $page->id,'refresh');
    	}
    }

    public function delete($page_id)
    {
    	$page = Model\Page::findOrFail($page_id);
    	$page->delete();

    	set_message_success('Halaman berhasil dihapus.');

    	redirect('pages','refresh');
    }
}

/* End of file Pages.php */
/* Location: ./application/modules/pages/controllers/Pages.php */