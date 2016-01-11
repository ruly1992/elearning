<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thread extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array(
            'Model_thread'  => 'model_thread',
            'Model_visitor' => 'model_visitor',
            'Model_topic'   => 'model_topic'
        ));
        $this->load->helper(array('bbcodeparser','visitor','thread'));

        if(!sentinel()->check()) {
            redirect(login_url());
        }
    }
    
    public function index()
    {
        if($this->session->flashdata('success')){
            $data['success'] = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed'] = $this->session->flashdata('failed');
        }

        $user = sentinel()->getUser();
        if ($this->checkTA()==TRUE){
            $data['addTopic']   = anchor('topic/create', '<i class="fa fa-plus"></i> Topic Baru', 'class="btn btn-primary btn-sm"');
            $data['dashTopic']  = anchor('topic/', 'Your Topics', 'class="btn btn-primary btn-sm"');
            $data['draftSide']  = $this->model_thread->get_all_drafts($user->id);
            $data['tenagaAhli'] = $user->id;
            $threads            = collect($this->model_thread->get_all_threads());
        }else{
            $daerahUser         = $user->profile->desa_id;
            $threads            = collect($this->model_thread->get_threads_by_user($daerahUser));
        }
        
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $this->model_thread->get_categories();
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_approved_topics();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['threadMembers']  = $this->model_thread->get_thread_members();
        $data['userID']         = $user->id;

        $data['threads']        = pagination($threads, 10, 'thread', 'bootstrap_md');

        $this->load->view('thread/all_threads',$data);
    }

    public function category($idCategory)
    {
        $getCategory            = $this->model_thread->get_category($idCategory);
        foreach($getCategory as $cat){
            $data['category']   = $cat->category_name;
        }

        $user = sentinel()->getUser();
        if ($this->checkTA()==TRUE){
            $data['addTopic']   = anchor('topic/create', '<i class="fa fa-plus"></i> Topic Baru', 'class="btn btn-primary btn-sm"');
            $data['dashTopic']  = anchor('topic/', 'Your Topics', 'class="btn btn-primary btn-sm"');
            $data['draftSide']  = $this->model_thread->get_all_drafts($user->id);
            $data['tenagaAhli'] = $user->id;
            $threads            = collect($this->model_thread->get_threads_category($idCategory));
        }else{
            $daerahUser         = $user->profile->desa_id;
            $threads            = collect($this->model_thread->get_threads_category_by_user($idCategory, $daerahUser));
        }
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['comments']       = $this->model_thread->get_count_reply(); 
        $data['visitors']       = $this->model_visitor->get_visitors();
        $data['categoriesHead'] = $getCategory;
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['topics']         = $this->model_topic->get_approved_topics();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['threadMembers']  = $this->model_thread->get_thread_members();
        $data['userID']         = $user->id;

        $data['threads']        = pagination($threads, 10, 'thread', 'bootstrap_md');

        $this->load->view('thread/all_threads',$data);
    }
    
    public function create()
    {
        if($this->session->flashdata('hasil')){
            $data['breadcrumb'] = $this->session->flashdata('hasil');
        }else{
            $data['breadcrumb'] = 'Post New Thread';
        }
        
        $user       = sentinel()->getUser();
        $daerahUser = $user->profile->desa_id;
        if ($this->checkTA()==TRUE){
            $data['tenagaAhli'] = $user->id;
            $data['draftSide']  = $this->model_thread->get_all_drafts($user->id);
            $data['categories'] = $this->model_thread->get_categories();
        }else{
            $data['categories']     = $this->model_topic->getCategory_by_Wilayah($daerahUser);
        }
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $role                   = sentinel()->findRoleBySlug('lnr');
        $data['users']          = $role->users;
        // $data['users']          = Model\User::where('slug', 'lnr')->get();
        $this->load->view('thread/create',$data);
    }
    
    public function post()
    {
        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('type','Type','required');
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('message','Message','required');
        
        if($this->form_validation->run()==TRUE){ 
            $user       = sentinel()->getUser();
            $idTopic    = set_value('topic');
            $status     = '1';
            
            // START : check status apabila nantinya thread perlu di approve
            // if ($this->checkTA()==TRUE){ 
            //     $userTopics = $this->model_thread->get_topics_by_user($user->id);
            //     if(checkTopic($idTopic, $userTopics) == TRUE){
            //         $status = '1';
            //     }else{
            //         $status = '0';
            //     }
            // }else{
            //     $status = '0';
            // }
            // END : check status apabila nantinya thread perlu di approve

            $data=array(
                'category'  => set_value('kategori'),
                'type'      => set_value('type'),
                'topic'     => set_value('topic'),
                'title'     => set_value('title'),
                'message'   => set_value('message'),
                'reply_to'  => '0',
                'author'    => $user->id,
                'status'    => $status,
                'created_at'=> date('Y-m-d H:i:s')
            );
            $data = $this->security->xss_clean($data); //xss clean
            $save = $this->model_thread->save_thread($data);

            $typeThread     = set_value('type');
            if($typeThread == 'close'){
                $where      = $data;
                $getThread  = $this->model_thread->get_thread_by_all($where);
                foreach($getThread AS $thread){
                    $idThread   =   $thread->id;
                }

                $member = $this->input->post('member');
                foreach($member AS $key => $value){
                    $threadMember = array(
                        'thread_id' => $idThread,
                        'user_id'   => $value
                    );
                    $this->model_thread->save_thread_member($threadMember);
                }
            }

            if($save==TRUE){
                $this->session->set_flashdata('success','Thread baru berhasil dibuat');
            }else{
                $this->session->set_flashdata('failed','Thread baru tidak berhasil dibuat');
            }
            redirect('thread/');
        }else{
            $this->session->set_flashdata('failed',validation_errors());
            redirect('thread/');
        }
    }
    
    public function view($id)
    {
        $get_thread = $this->model_thread->get_thread($id);
        foreach($get_thread as $t){
            $data = array(
                'idCategory'=> $t->category,
                'category'  => $t->category_name,
                'topic'     => $t->topicName,
                'user'      => $t->author,
                'tanggal'   => $t->created_at,
                'title'     => $t->title,
                'status'    => $t->status,
                'message'   => BBCodeParser($t->message)
            );
        }

        $user                   = sentinel()->getUser();
        $visitorIdentity        = visitorIdentity($user->id,$id);
        $this->model_visitor->saveVisitor($visitorIdentity);

        if ($this->checkTA()==TRUE){
            $data['tenagaAhli'] = $user->id;
            $data['draftSide']  = $this->model_thread->get_all_drafts($user->id);
        }
        $data['authorSide']     = $this->model_thread->get_thread_from_author($user->id);
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $data['reply']          = $this->model_thread->get_reply($id);
        $data['countReply']     = count($data['reply']);
        $data['id']             = $id;
        
        if($this->session->flashdata('success')){
            $data['success']    = $this->session->flashdata('success');
        }elseif($this->session->flashdata('failed')){
            $data['failed']     = $this->session->flashdata('failed');
        }

        $this->load->view('thread/single',$data);
    }
    
    public function deleteThread($id)
    {
        $delete = $this->model_thread->delete_thread($id);

        if($delete==TRUE){
            $this->model_thread->delete_replies($id);
            $this->model_thread->delete_thread_members($id);
            $this->session->set_flashdata('success','Thread berhasil dihapus');
        }else{
            $this->session->set_flashdata('failed','Thread tidak berhasil dihapus');
        }
        redirect('thread/');
    }
    
    public function update($controller, $id)
    {
        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('topic','Topic','required');
        $this->form_validation->set_rules('type','type','required');
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('message','Message','required');
        
        if($this->form_validation->run()==TRUE){    
            $data=array(
                'category'  => set_value('kategori'),
                'topic'     => set_value('topic'),
                'type'      => set_value('type'),
                'title'     => set_value('title'),
                'message'   => set_value('message'),
                'updated_at'=> date('Y-m-d H:i:s')
            );
            $data = $this->security->xss_clean($data); //xss clean
            $save = $this->model_thread->update_thread($id,$data);
            if($save==TRUE){
                $this->session->set_flashdata('success','Thread berhasil diperbarui');
            }else{
                $this->session->set_flashdata('failed','Thread tidak berhasil diperbarui');
            }
            redirect($controller.'/');
        }else{
            $this->session->set_flashdata('failed',validation_errors());
            redirect($controller.'/');
        }
    }

    public function replyThread($id)
    {
        $this->form_validation->set_rules('message','Message','required');

        if($this->form_validation->run()==TRUE){
            $get_thread = $this->model_thread->get_thread($id);

            foreach($get_thread as $t){
                $category = $t->category;
                $topic    = $t->topic;
                $type     = $t->type;
                $comments = $t->comments;
            }

            $user = sentinel()->getUser();
            $data=array(
                'category'  => $category,
                'topic'     => $topic,
                'type'      => $type,
                'title'     => 'Thread Reply',
                'message'   => set_value('message'),
                'reply_to'  => $id,
                'author'    => $user->id,
                'status'    => '1',
                'created_at'=> date('Y-m-d').' '.date('G:i:s')
            );
            $post_reply = $this->model_thread->save_thread($data);

            if($post_reply==TRUE){
                $this->session->set_flashdata('success', 'Komentar anda berhasil dikirim');
            }else{
                $this->session->set_flashdata('failed', 'Komentar anda tidak berhasil dikirim');
            }
            redirect('thread/view/'.$id);
        }else{
            $this->session->set_flashdata('failed',validation_errors());
            redirect('thread/view/'.$id);
        }
    }

    public function editReply($idThread,$idReply)
    {
        $thread=$this->model_thread->get_thread($idReply);
        foreach($thread as $t){
            $data=array(
                'idThread'=> $idThread,
                'idReply' => $idReply,
                'title'   => $t->title,
                'message' => $t->message,
            );
        }
        
        $data['categoriesSide'] = $this->model_thread->get_categories();
        $data['threadSide']     = $this->model_thread->get_all_threads();
        $data['closeThreads']   = $this->model_thread->get_close_threads($user->id);
        $this->load->view('thread/edit_reply',$data);
    }

    public function updateReply($idThread,$idReply)
    {
        $this->form_validation->set_rules('message','Message','required');

        if($this->form_validation->run()==TRUE){
            $data = array(
                'message' => set_value('message')
            );

            $update = $this->model_thread->update_thread($idReply,$data);
            if($update==TRUE){
                $this->session->set_flashdata('success', 'Komentar berhasil diperbarui');
            }else{
                $this->session->set_flashdata('failed', 'Komentar tidak berhasil diperbarui');
            }

            redirect('thread/view/'.$idThread.'#'.$idReply);
        }else{
            redirect('thread/view/'.$idThread);
        }
    }

    public function deleteReply($idThread,$idReply)
    {
        $delete=$this->model_thread->delete_thread($idReply);
        if($delete==TRUE){
            $this->session->set_flashdata('success', 'Komentar berhasil dihapus');
        }else{
            $this->session->set_flashdata('failed', 'Komentar tidak berhasil dihapus');
        }
        redirect('thread/view/'.$idThread);
    }

    public function get_topics(){
        $idCategory = $this->input->post('idCategory');
        $getTopics  = $this->model_topic->getTopics_by_Category($idCategory);

        $topics = null;
        if(!empty($getTopics)){
            foreach($getTopics as $top){
                $topics .= '<option value="'.$top->id.'" >'.$top->topic.'</option>';
            }
        }else{
            $topics     = '<option value="">- Topic belum tersedia -</option>';
        }
        echo $topics;
    }

    public function checkTA()
    {
        if (sentinel()->inRole('ta')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
