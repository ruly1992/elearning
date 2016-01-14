<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin
{
	public function __construct()
	{
		parent::__construct();

		$this->kelas = new Library\Kelas\Kelas;
	}

	public function index()
	{
		$data['categories'] = Model\Kelas\Category::orderBy('name', 'asc')->get();

		$this->template->build('category_index', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Nama Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			redirect('kelasonline/category','refresh');
		} else {
			$name		= set_value('name');
			$category	= $this->kelas->createCategory($name);

			set_message_success('Kategori berhasil ditambahkan');

			redirect('kelasonline/category', 'refresh');
		}
	}

	public function edit($id)
	{
		$category = Model\Kelas\Category::findOrFail($id);

		$data['category'] = $category;

		$this->form_validation->set_rules('name', 'Nama Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->build('category_edit', $data);
		} else {
			$category->update([
				'name' => set_value('name')
			]);

			set_message_success('Kategori berhasil diperbarui.');

			redirect('kelasonline/category','refresh');
		}
	}

	public function delete($id)
	{
		$category = Model\Kelas\Category::findOrFail($id);
		$category->delete();

		set_message_success('Kategori berhasil dihapus.');

		redirect('kelasonline/category','refresh');
	}

}

/* End of file Category.php */
/* Location: ./application/modules/kelasonline/controllers/Category.php */