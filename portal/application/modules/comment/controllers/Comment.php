<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Comment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->request  = Request::createFromGlobals();
        $this->query    = $this->request->query;

        if ($this->query->has('article_id'))
            $this->article  = Model\Portal\Article::withPrivate()->findOrFail($this->query->get('article_id'));
        else
            $this->article  = new Model\Portal\Article;
    }

    public function show()
    {
        if ($this->article)
            echo $this->article->comments()->parentOnly()->get()->toJson();
        else
            echo json_encode([]);
    }

    public function create()
    {
        $data['article'] = $this->article;
        $data['parent'] = $this->query->get('parent', 0);

        $this->template->build('create', $data);
    }

    public function store()
    {
        $article = Model\Portal\Article::withPrivate()->findOrFail(set_value('article_id'));

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('content', 'Komentar', 'required');
        $this->form_validation->set_rules('article_id', 'Artikel', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            if ($this->request->isXmlHttpRequest()) {
                $response = new Response;
                $response->setContent(json_encode([
                    'status'    => 'error',
                    'data'      => $this->form_validation->error_array()
                ]));
                $response->headers->set('Content-Type', 'application/json');
            } else {
                keepValidationErrors();
                
                redirect($article->link . '#comments', 'refresh');
            }
        } else {
            $data = array(
                'content'       => set_value('content'),
                'nama'          => set_value('name'),
                'email'         => set_value('email'),
                'artikel_id'    => set_value('article_id'),
                'parent'        => set_value('parent', 0),
                'status'        => 'draft',
                'date'          => Carbon::now(),
            );

            $comment = Model\Portal\Comment::create($data);

            if ($user = auth()->check()) {
                $comment->user()->associate($user->id);

                if ($user->inRole(['su', 'adm', 'edt', 'ins', 'mdr']))
                    $comment->status    = 'publish';
                else
                    $comment->status    = 'draft';

                $comment->save();
            }

            if ($this->request->isXmlHttpRequest()) {
                $response = new Response;
                $response->setContent(json_encode([
                    'status'    => 'success',
                    'data'      => $comment
                ]));
                $response->headers->set('Content-Type', 'application/json');
            } else {
                if ($comment->status == 'publish') {
                    set_message_success('Komentar Anda sudah ditampilkan.');

                    redirect($article->link . '#comment-' . $comment->id, 'refresh');
                } else {
                    set_message_success('Komentar Anda akan tampil setelah dimoderasi.');

                    redirect($article->link . '#comments', 'refresh');
                }
            }
        }
    }
}

/* End of file Comment.php */
/* Location: ./application/modules/comment/controllers/Comment.php */