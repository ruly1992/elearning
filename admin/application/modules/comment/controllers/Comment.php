<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends Admin {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mod_comment');

        $this->status = array(
            'approve'   => 'Approve',
            'unapprove' => 'Unapprove',
        );
    }

    public function index()
    {
        $status = $this->input->get('status') ?: 'publish';

        if ($status == 'draft') {
            $this->indexDraft();
        } else {
            $data['result'] = Model\Portal\Comment::latest('date')->get();
            $data['status'] = $status;
            
            $this->template->build('index', $data);
        }
    }

    public function indexDraft()
    {
        $status         = 'Draft';

        $data['result'] = Model\Portal\Comment::onlyDrafts()->latest('date')->get();
        $data['status'] = $status;
        
        $this->template->build('index', $data);
    }

    public function edit($comment_id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $data['data'] = $this->Mod_comment->getById($comment_id);

            $this->template->build('update', $data);

        } else {
           
           $data = array(
                'nama'          => set_value('nama'),
                'email'         => set_value('email'),
                'content'       => set_value('content'),
            );

            if ($this->input->post('publish'))
                $data['status'] = 'publish';

            $comment = $this->Mod_comment->update($comment_id, $data);

            if ($data == TRUE) {
               set_message_success('Komentar Berhasi di Ubah');

               redirect('comment');
            } else {
                set_message_error('Kateogri Gagal di Ubah');

                redirect('comment/update');
            }
        }
    }


    public function delete($comment_id)
    {
        $data = $this->Mod_comment->delete($comment_id);

        redirect('comment', $data);
    }

}

/* End of file Comment.php */
/* Location: ./application/modules/comment/controllers/Comment.php */