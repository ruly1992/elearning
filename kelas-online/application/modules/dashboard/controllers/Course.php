<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Intervention\Image\ImageManager;

class Course extends Admin
{
    public function __construct()
    {
        parent::__construct();

        $this->kelas    = new Library\Kelas\Kelas;
    }

    public function create()
    {
        $this->template->set_layout('dashboard');

        $this->form_validation->set_rules('course[name]', 'Nama Kelas', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            keepValidationErrors();

            $data   = [
                'category_lists' => $this->kelas->getCategoryLists()
            ];
            
            $this->template->build('course/create', $data);
        } else {
            print_r($_FILES);
            // $kelas      = new Library\Kelas\Kelas;

            // $name       = $this->input->post('name');
            // $category   = $this->input->post('category');

            // $kelas      = $kelas->create($name, $category);

            // redirect('dashboard/course/edit/'.$kelas->id, 'refresh');
        }
    }

    public function submit()
    {
        // 1. Prepare from input
        $input = collect($this->input->post('course'));
        
        // 2. Create Course
        $course                 = new Model\Kelas\Course;
        $course->name           = $input->get('name');
        $course->description    = $input->get('description');
        $course->days           = $input->get('days');
        $course->status         = 'draft';

        $course->category()->associate($input->get('category_id'));
        $course->instructor()->associate(sentinel()->getUser());
        $course->save();

        // 3. Create Folder Content and Upload Images
        $kelas_content = PATH_KELASONLINE_CONTENT.'/'.$course->id;

        if (!is_dir($kelas_content)) {
            mkdir($kelas_content, 0775);
        }

        $imageManager   = new ImageManager;

        // 3.a. Featured image
        $featured = $this->input->post('featured[src]');
        
        if (!empty($featured)) {
            $image = $imageManager->make($featured);

            if ($image->mime == 'image/jpeg')
                $extension = '.jpg';
            elseif ($image->mime == 'image/png')
                $extension = '.png';
            elseif ($image->mime == 'image/gif')
                $extension = '.gif';
            else
                $extension = '';

            $prefix     = 'featured_';
            $filename   = $prefix . $course->id . $extension;

            $image->save($kelas_content.'/'.$filename);

            $course->featured   = $filename;
            $course->save();
        }

        // 3.b. Thumbnail image
        $thumbnail = $this->input->post('thumbnail[src]');
        
        if (!empty($thumbnail)) {
            $image = $imageManager->make($thumbnail);

            if ($image->mime == 'image/jpeg')
                $extension = '.jpg';
            elseif ($image->mime == 'image/png')
                $extension = '.png';
            elseif ($image->mime == 'image/gif')
                $extension = '.gif';
            else
                $extension = '';

            $prefix     = 'thumbnail_';
            $filename   = $prefix . $course->id . $extension;

            $image->save($kelas_content.'/'.$filename);

            $course->thumbnail = $filename;
            $course->save();
        }

        // 4. Chapters
        $chapters = collect($input->get('chapters'));

        $chapters->each(function ($chapter) use ($course) {
            $chapter                    = collect($chapter);
            $modelChapter               = new Model\Kelas\Chapter;
            $modelChapter->name         = $chapter->get('name');
            $modelChapter->content      = $chapter->get('content');
            $modelChapter->order        = $chapter->get('order');
            
            $modelChapter->course()->associate($course);
            $modelChapter->save();

            // 5. Quiz Chapter
            $quiz               = collect($chapter->get('quiz'));
            $modelQuiz          = new Model\Kelas\Quiz;
            $modelQuiz->name    = $quiz->get('name');
            $modelQuiz->time    = $quiz->get('time');

            $modelQuiz->chapter()->associate($modelChapter);
            $modelQuiz->save();

            $questions = collect($quiz->get('questions'));

            $questions->each(function ($question) use ($modelQuiz, $modelChapter, $course) {
                $question                   = collect($question);
                $modelQuestion              = new Model\Kelas\QuizQuestion;
                $modelQuestion->question    = $question->get('question');
                $modelQuestion->option_a    = $question->get('option_a');
                $modelQuestion->option_b    = $question->get('option_b');
                $modelQuestion->option_c    = $question->get('option_c');
                $modelQuestion->option_d    = $question->get('option_d');
                $modelQuestion->correct     = $question->get('correct');

                $modelQuestion->quiz()->associate($modelQuiz);
                $modelQuestion->save();
            });
        });

        // 6. Exam
        $exam               = collect($input->get('exam'));
        $modelExam          = new Model\Kelas\Exam;
        $modelExam->name    = $exam->get('name');
        $modelExam->time    = $exam->get('time');

        $modelExam->course()->associate($course);
        $modelExam->save();

        $questions = collect($exam->get('questions'));

        $questions->each(function ($question) use ($modelExam, $course) {
            $question                   = collect($question);
            $modelQuestion              = new Model\Kelas\ExamQuestion;
            $modelQuestion->question    = $question->get('question');
            $modelQuestion->option_a    = $question->get('option_a');
            $modelQuestion->option_b    = $question->get('option_b');
            $modelQuestion->option_c    = $question->get('option_c');
            $modelQuestion->option_d    = $question->get('option_d');
            $modelQuestion->correct     = $question->get('correct');

            $modelQuestion->exam()->associate($modelExam);
            $modelQuestion->save();
        });
    }

    public function edit($id, $page = 'index')
    {
        $data = [
            'category_lists'    => $this->kelas->getCategoryLists(),
            'course'            => $this->kelas->getCourse($id),
            'sidebar_active'    => 'basic',
        ];

        $this->template->set($data);
        $this->template->set_layout('dashboard_course');

        if ($page == 'index') {
            $this->template->build('course/edit');

            return;
        } else {
            $this->template->set('sidebar_active', $page);

            call_user_func_array([$this, 'edit'.ucfirst($page)], [$id]);

            return;
        }
    }

    public function editImage($id)
    {
        $this->template->build('course/image');
    }

    public function editChapter($id)
    {
        $this->template->build('course/image');
    }
}

/* End of file Course.php */
/* Location: ./application/modules/dashboard/controllers/Course.php */