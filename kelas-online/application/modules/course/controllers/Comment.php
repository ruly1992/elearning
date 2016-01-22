<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Comment extends CI_Controller
{
    public function index()
    {
        
    }

    public function store()
    {
        $course = Model\Kelas\Course::withPrivate()->findOrFail(set_value('course_id'));

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('content', 'Komentar', 'required');
        $this->form_validation->set_rules('course_id', '', 'required');
        
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
                
                redirect($course->link . '#comments', 'refresh');
            }
        } else {
            $data = array(
                'content'       => set_value('content'),
                'name'          => set_value('name'),
                'email'         => set_value('email'),
                'course_id'     => set_value('course_id'),
                'parent'        => set_value('parent', 0),
                'status'        => 'draft'
            );

            $comment = Model\Kelas\CourseComment::create($data);

            if ($user = auth()->check()) {
                $comment->user()->associate($user->id);

                if ($user->inRole(['su', 'adm', 'edt', 'ins', 'mdr']))
                    $comment->status    = 'publish';
                else
                    $comment->status    = 'draft';

                $comment->save();
            }

            if ($this->input->is_ajax_request()) {
                $response = new Response;
                $response->setContent(json_encode([
                    'status'    => 'success',
                    'data'      => $comment
                ]));
                $response->headers->set('Content-Type', 'application/json');
            } else {
                if ($comment->status == 'publish') {
                    set_message_success('Komentar Anda sudah ditampilkan.');

                    redirect($course->link . '#comment-' . $comment->id, 'refresh');
                } else {
                    set_message_success('Komentar Anda akan tampil setelah dimoderasi.');

                    redirect($article->link . '#comments', 'refresh');
                }
            }
        }
    }

    public function storechapter()
    {
        $chapter = Model\Kelas\Chapter::findOrFail(set_value('chapter_id'));

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('content', 'Komentar', 'required');
        $this->form_validation->set_rules('chapter_id', '', 'required');
        
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
                
                redirect('course/showchapter/'.$chapter->course->slug . '/chapter-'.$chapter->order.'#comment-' . $comment->id, 'refresh');
            }
        } else {
            $data = array(
                'content'       => set_value('content'),
                'name'          => set_value('name'),
                'email'         => set_value('email'),
                'chapter_id'    => set_value('chapter_id'),
                'parent'        => set_value('parent', 0),
                'status'        => 'draft'
            );

            $comment = Model\Kelas\ChapterComment::create($data);

            if ($user = auth()->check()) {
                $comment->user()->associate($user->id);

                if ($user->inRole(['su', 'adm', 'edt', 'ins', 'mdr']))
                    $comment->status    = 'publish';
                else
                    $comment->status    = 'draft';

                $comment->save();
            }

            if ($this->input->is_ajax_request()) {
                $response = new Response;
                $response->setContent(json_encode([
                    'status'    => 'success',
                    'data'      => $comment
                ]));
                $response->headers->set('Content-Type', 'application/json');
            } else {
                if ($comment->status == 'publish') {
                    set_message_success('Komentar Anda sudah ditampilkan.');

                    redirect('course/showchapter/'.$chapter->course->slug . '/chapter-'.$chapter->order.'#comment-' . $comment->id, 'refresh');
                } else {
                    set_message_success('Komentar Anda akan tampil setelah dimoderasi.');

                    redirect('course/showchapter/'.$chapter->course->slug . '/chapter-'.$chapter->order.'#comment-' . $comment->id, 'refresh');
                }
            }
        }
    }
}

/* End of file Comment.php */
/* Location: ./application/modules/course/controllers/Comment.php */