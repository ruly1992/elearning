<?php 

use Symfony\Component\HttpFoundation\Request;

class Kategori extends Admin
{
    protected $roles = ['su', 'adm'];

    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_kategori', 'model');
    }

    public function index()
    {
        $group  = sentinel()->findRoleBySlug('edt');

        $data['kategori']   = $this->model->read();
        $data['parent']     = $this->model->getLists();
        $data['users']      = $group->users->pluck('email', 'id')->toArray();

        $this->template->build('kategori_tampil', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Kategori', 'required|is_unique[kategori.name]');
        $this->form_validation->set_rules('editor[]', 'Editor', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori'] = $this->model->getLists();

            keepValidationErrors();
            
            redirect('kategori');
        } else {
            $kategori['name']           = set_value('name');
            $kategori['description']    = set_value('description');
            $kategori['parent']         = $this->input->post('parent');
            $editor                     = set_value('editor', []);
            
            $category = Model\Portal\Category::create($kategori);

            if ($editor) {
                $category->editors()->attach($editor);
            }

            set_message_success('Kategori berhasil ditambahkan.');
            
            redirect('kategori');
        }   
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('editor[]', 'Editor', 'required');

        if ($this->form_validation->run() == FALSE) {
            $group  = sentinel()->findRoleBySlug('edt');

            $data['kategori']       = Model\Portal\Category::findOrFail($id);
            $data['kategori_lists'] = $this->model->getLists($id);
            $data['users']          = $group->users->pluck('email', 'id')->toArray();

            $this->template->build('kategori_edit',$data);
        } else {
            $kategori['name']           = $this->input->post('name');
            $kategori['description']    = $this->input->post('description');
            $kategori['parent']         = $this->input->post('parent');
            $editor                     = set_value('editor', []);

            $category   = Model\Portal\Category::findOrFail($id);
            $updated    = $category->update($kategori);

            $category->editors()->sync($editor);

            if ($updated) {
                set_message_success('Kategori berhasil diperbarui.');

                redirect('kategori');
            } else {
                set_message_error('Kategori gagal diperbarui.');

                redirect('kategori/update/'.$id);    
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
        $delete     = $this->input->post('delete', 0);
        $category   = Model\Portal\Category::findOrFail($id);

        if (!$delete) {
            $data['category']   = $category;

            $this->template->build('kategori_delete', $data);
        } else {
            $category->editors()->detach();
            $category->articles()->delete();
            $category->delete();

            set_message_success('Kategori berhasil dihapus.');

            redirect('kategori');
        }
    }
}