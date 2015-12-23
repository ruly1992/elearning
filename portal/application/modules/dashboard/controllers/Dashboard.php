<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Symfony\Component\HttpFoundation\Request;

use Nurmanhabib\WilayahIndonesia\Sources\DatabaseSource;

class Dashboard extends Admin {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('article');
        $this->load->model('Mod_user', 'model');
        $this->load->model('Mod_sendarticle');
        $this->load->model('category/Mod_category');

        $this->template->set('active', 'dashboard');

        $this->status = array(
            'publish'   => 'Publish',
            'draft'     => 'Draft',
        );

        $this->type = array(
            'public'        => 'Public',
            'private'       => 'Private',
        );
        
        $this->load->library('WilayahIndonesia', null, 'wilayah');

        $hostname = getenv('AUTH_DB_HOST') ?: 'localhost';
        $username = getenv('AUTH_DB_USERNAME') ?: 'root';
        $password = getenv('AUTH_DB_PASSWORD') ?: '';
        $database = getenv('AUTH_DB_DATABASE') ?: 'portal_learning';

        $source = new DatabaseSource($hostname, $username, $password, $database);
        $this->wilayah->setSource($source);
    }

    public function index()
    {
        $user       = auth()->getUser();
        $request    = Request::createFromGlobals();
        $articles   = Model\Portal\Article::published()
                        ->contributor($user->id)
                        ->latest('date')
                        ->get();

        $drafts     = Model\Portal\Article::onlyDrafts()
                        ->contributor($user->id)
                        ->latest('date')
                        ->get();

        $data['categories_checkbox']    = $this->Mod_category->generateCheckbox();
        $data['artikel']    = pagination($articles, 4, 'dashboard');
        $data['drafts']     = pagination($drafts, 4, 'dashboard');
        $data['links']      = $this->Mod_link->read();
        
        $this->template->set('sidebar');
        $this->template->set_layout('privatepage');              
        $this->template->build('index', $data);
    }

    public function article()
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

            'privatepage_category_2_title'  => $privatepage_category_2_title ? $privatepage_category_2_title->name : 'No Category',
            'privatepage_category_2_a'      => $privatepage_category_2_a->count() ? $privatepage_category_2_a->get() : collect([]),
            'privatepage_category_2_b'      => $privatepage_category_2_b->count() ? $privatepage_category_2_b->get() : collect([]),

            'privatepage_category_3_title'  => $privatepage_category_3_title ? $privatepage_category_3_title->name : 'No Category',
            'privatepage_category_3_a'      => $privatepage_category_3_a->count() ? $privatepage_category_3_a->get() : collect([]),
            'privatepage_category_3_b'      => $privatepage_category_3_b->count() ? $privatepage_category_3_b->get() : collect([]),

            'privatepage_category_4_title'  => $privatepage_category_4_title ? $privatepage_category_4_title->name : 'No Category',
            'privatepage_category_4_a'      => $privatepage_category_4_a->count() ? $privatepage_category_4_a->get() : collect([]),
            'privatepage_category_4_b'      => $privatepage_category_4_b->count() ? $privatepage_category_4_b->get() : collect([]),

            'links'                         => $this->Mod_link->read(),
        );

        $latests    = Model\Portal\Article::registered()->latest('date')
                        ->limit(15)
                        ->get();
        $data['latest']     = $latests;
        $this->template->set('active', 'artikel');
        $this->template->set('sidebar', FALSE);
        $this->template->set_layout('article');    
        $this->template->build('articlePrivate', $data);
    }

    public function sendArticle()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['categories_checkbox']    = $this->Mod_category->generateCheckbox();
            $data['status'] = $this->status;

            $this->template->set('sidebar');
            $this->template->set_layout('privatepage');
            $this->template->build('create', $data);
        } else {
            $data   = array(
                'title'             => set_value('title'),
                'content'           => $this->input->post('content'),
                'contributor_id'    => auth()->getUser()->id,
            );

            $categories = set_value('categories', array());
            $status     = set_value('status', 'draft');
            $type       = set_value('type', 'private');

            $id = $this->Mod_sendarticle->send($data, $status, $type, null, $categories);

            $articleLib = new Library\Article\Article;
            $articleLib->set($id);

            if ($featured_image = set_value('featured'))
                $articleLib->setFeaturedImage($featured_image);

            set_message_success('Artikel berhasil dibuat.');

            redirect('dashboard/editArticle/' . $id,  'refresh');
        }
    }

    public function editArticle($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $artikel = $this->Mod_sendarticle->getById($id);

            $cat_ids = array_map(function ($cat){
                return $cat->kategori_id;
            }, $this->Mod_category->getByArticle($id));

            $data['artikel']                = $artikel;
            $data['categories_checkbox']    = $this->Mod_category->generateCheckbox(0, $cat_ids);
            $data['status']                 = $this->status;

            $this->template->set('sidebar');            
            $this->template->set_layout('privatepage');            
            $this->template->build('edit', $data);
        } else {
            $artikel    = array(
                'title'             => set_value('title'),
                'content'           => set_value('content', '', FALSE),
                'featured_image'    => set_value('featured', ''),
            );

            $categories = set_value('categories', array());
            $status     = set_value('status', 'draft');

            if (isset($_FILES['featured']) && $_FILES['featured']['tmp_name']) {
                $featured_image = $_FILES['featured'];
            } else {
                $featured_image = null;
            }

            $id = $this->Mod_sendarticle->edit($id, $artikel, $categories, $featured_image);

            set_message_success('Artikel berhasil diperbarui.');

            redirect('dashboard/editArticle/'.$id, 'refresh');
        }
    }

    public function delete($id)
    {
        $delete = $this->Mod_sendarticle->delete($id);

        if ($delete) {
            set_message_success('Artikel berhasil dihapus.');
        } else {
            set_message_error('Artikel gagal dihapus.');
        }

        redirect('dashboard', 'refresh');
    }

    public function wilayah()
    {
        echo $this->wilayah->ajax();
    }

    public function profile()
    {
        $id     = auth()->getUser()->id;
        $source = $this->wilayah->getSource();

        $user               = sentinel()->findById($id);
        $user->wilayah      = $source->getParentByDesa($user->profile->desa_id);
        
        $data['user']       = $user;
        $data['profile']    = $user->profile;

        $this->template->set('sidebar');
        $this->template->set_layout('privatepage');  
        $this->template->inject_partial('script', $this->wilayah->script(site_url('user/wilayah')));
        $this->template->build('profile',$data);
    }

    public function update()
    {
        $id     = auth()->getUser()->id;        
        $user       = array(
            'email' => $this->input->post('email')
        );
        
        $profile    = array(
            'first_name'         => set_value('first_name'),
            'last_name'          => set_value('last_name'),
            'gender'             => set_value('gender'),
            'tempat_lahir'       => set_value('tempat_lahir'),
            'tanggal_lahir'      => set_value('tanggal_lahir'),
            'address'            => set_value('address'),
            'desa_id'            => set_value('desa'),
            'avatar'             => set_value('avatar'),
        );

        $res = $this->model->update($id, $user, $profile);

        // if (isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name']) {
        //     $this->model->setAvatar($id, $_FILES['avatar']);
        //     $profile['avatar'] = $_FILES['avatar']['file_name'];
        // }        

        if (isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name']) {
            $this->model->setAvatar($id, $_FILES['avatar']);
        }


        if ($res==TRUE) {
            set_message_success('User berhasil diperbarui.');

            redirect('dashboard/profile');
        } else {
            set_message_error('User gagal diperbarui.');

            redirect('dashboard/profile');
        }
    }

    public function changepassword()
    {   
        $user_id = auth()->getUser()->id;
        $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', 'New Password Confirmation', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('password_old', 'Old Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = auth()->getById($user_id);
            
            $this->template->set('sidebar');
            $this->template->set_layout('privatepage');  

            $this->template->build('changePassword', $data);
        } else {
            $password       = set_value('password');
            $password_old   = set_value('password_old');
            $changed        = $this->model->changePassword($user_id, $password, $password_old);

            if ($changed) {
                set_message_success('Password berhasil diperbarui.');

                redirect('dashboard/profile/'.$user_id, 'refresh');
            } else {
                set_message_error('Password lama tidak sesuai.');

                redirect('dashboard/profile/'.$user_id, 'refresh');
            }
        }
    }
}

/* End of file Privatepage.php */
/* Location: ./application/modules/privatepage/controllers/Privatepage.php */