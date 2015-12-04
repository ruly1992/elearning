<?php 

use Symfony\Component\HttpFoundation\Request;

class Kategori extends Admin {

    public function __construct()
    {

        parent::__construct();
        $this->load->model('M_kategori','model');
    }

    public function index()
    {
        $group = Model\Group::where('name', 'edt')->first();

        $data['kategori']   = $this->model->read();
        $data['parent']     = $this->model->getLists();
        $data['users']      = $group->users->pluck('email', 'id')->toArray();

        $this->template->build('kategori_tampil', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori'] = $this->model->getLists();

            keepValidationErrors();
            
            redirect('kategori');
        } else {
            $kategori['name']           = set_value('name');
            $kategori['description']    = set_value('description');
            $kategori['parent']         = $this->input->post('parent');
            $editor                     = set_value('editor', 0);
            
            $category = Model\Category::create($kategori);

            if ($editor) {
                $user = Model\User::find($editor);
                $user->editorcategory()->attach($category);
            }

            set_message_success('Kategori berhasil ditambahkan.');
            
            redirect('kategori');
        }   
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $param                  = $this->model->getById($id);
            $data['kategori']       = $param->row();
            $data['kategori_lists'] = $this->model->getLists($id);

            $this->template->build('kategori_edit',$data);
        } else {
            $kategori['name']           = $this->input->post('name');
            $kategori['description']    = $this->input->post('description');
            $kategori['parent']         = $this->input->post('parent');
            
            $res = $this->model->update($id, $kategori);

            if ($res==TRUE) {
                set_message_success('Kategori berhasil diperbarui.');

                redirect('kategori');
            } else {
                set_message_error('Kategori gagal diperbarui.');

                redirect('kategori/update');    
            }
        }
    }

    public function nestable()
    {
        $request    = Request::createFromGlobals();
        $json       = $request->query->get('nestable_json');
        $nestable   = json_decode($json);

        (new Model\Category)->updateFromNestable($nestable);

        echo json_encode(['status' => 'success']);
    }

    public function delete($id)
    {
        $data = $this->model->delete($id);

        set_message_success('Kategori berhasil dihapus.');

        redirect('kategori');
    }
}