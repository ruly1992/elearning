<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
	protected $medialib;

	public function __construct()
	{
		parent::__construct();

		$this->medialib = new Library\Media\Media;
	}

	public function index()
	{
		$data['categories'] = $this->medialib->getCategories();

		$this->template->build('category_index', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Nama Kategori', 'required|callback_category_name_check[0]');

		if ($this->form_validation->run() == FALSE) {
			keepValidationErrors();

			redirect('elibrary/category','refresh');
		} else {
			$name			= set_value('name');
			$description	= set_value('description');

			$this->medialib->createCategory($name, $description);

			$category = $this->medialib->getCategory();

			set_message_success('Kategori berhasil dibuat.');

			redirect('elibrary/category','refresh');
		}
	}

	public function edit($category_id)
	{
		$this->medialib->setCategory($category_id);

		$this->form_validation->set_rules('name', 'Nama Kategori', 'required|callback_category_name_check['.$category_id.']');

		if ($this->form_validation->run() == FALSE) {
			$data['category'] = $this->medialib->getCategory();

			$this->template->build('category_edit', $data);
		} else {
			$data = [
				'name'			=> set_value('name'),
				'description'	=> set_value('description'),
			];

			$this->medialib->updateCategory($category_id, $data);

			set_message_success('Kategori berhasil diperbarui.');

			redirect('elibrary/category', 'refresh');
		}
	}

	public function category_name_check($name, $except = 0)
	{
		$category = Library\Media\Model\Category::whereNotIn('id', [$except])->where('name', $name);

		if ($category->count()) {
			$this->form_validation->set_message('category_name_check', 'Nama kategori "'. $name .'" sudah tersedia.');

			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function delete($category_id)
	{
		$this->medialib->deleteCategory($category_id);

		set_message_success('Kategori berhasil dihapus.');

		redirect('elibrary/category','refresh');
	}
}

/* End of file Category.php */
/* Location: ./application/modules/elibrary/controllers/Category.php */