<?php

namespace Library\Kelas;

use Model\Kelas\Course;
use Model\Kelas\Category;
use Model\Kelas\Chapter;
use Model\Kelas\Attachment;
use Model\Kelas\Quiz;
use Model\Kelas\QuizQuestion;
use Model\Kelas\QuizAnswer;
use Model\Kelas\Exam;
use Model\Kelas\ExamQuestion;
use Model\Kelas\ExamAnswer;
use Model\User;
use Carbon\Carbon;

class CourseRepository
{
    use CategoryTrait;
    use CountingTrait;
    use MemberTrait;

    protected $model;
    protected $user;

    public function __construct($course = null, $user = null, $category = null)
    {
        $this->set($course);
        $this->setUser($user);
        $this->setCategory($category);
    }

    public function set($course)
    {
        if ($course instanceof Course)
            $this->model = $course;
        elseif (is_numeric($course))
            $this->model = Course::withDrafts()->findOrFail($course);
        elseif (is_string($course))
            $this->model = Course::withDrafts()->findBySlug($course);
        else
            $this->model = new Course;

        return $this;
    }

    public function get()
    {
        return $this->model->load('chapters.quiz.questions', 'chapters.quiz.questions', 'instructor', 'members', 'requirements');
    }

    public function getBySlug($slug)
    {
        $this->model = $this->model->findBySlug($slug);

        return $this->get();
    }

    public function getByCategory($slug)
    {
        if (is_string($slug)) {
            $category   = $this->getCategory()->findBySlug($slug);
        } else {
            $category   = $this->getCategory()->find($slug);
        }

        return $category->courses;
    }

    public function setUser($user)
    {
        if ($user instanceof User)
            $this->user = $user;
        elseif (is_numeric($user))
            $this->user = User::findOrFail($user);
        else
            $this->user = sentinel()->getUser();

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function attachCategory($category)
    {
        $this->model->category()->associate($category);
        $this->model->save();

        return $this;
    }

    public function attachInstructor($instructor)
    {
        $this->model->instructor()->associate($this->user);
        $this->model->save();

        return $this;
    }

    public function create($name, $description, $days, $category)
    {
        $this->model = Course::create(compact('name', 'description', 'days'));

        $this->attachCategory($category);
        $this->attachInstructor($this->user);

        if (!is_dir($this->model->content_path)) {
            mkdir($this->model->content_path, 0775);
        }

        $this->model->exam()->create([
            'name'  => '',
            'time'  => 0,
        ]);

        return $this;
    }

    public function saveTo($status = 'publish')
    {
        $this->model->update(compact('status'));

        return $this;
    }

    public function saveToPublish()
    {
        return $this->saveTo('publish');
    }

    public function saveToDraft()
    {
        return $this->saveTo('draft');
    }

    public function update($name, $description, $days, $category)
    {
        $this->model = Course::update(compact('name', 'description', 'days'));

        $this->attachCategory($category);

        return $this;
    }

    public function delete($course = null)
    {
        if ($course) $this->set($course);

        $this->model->chapters->each(function ($chapter) {
            $this->deleteChapter($chapter);
        });

        $this->model->delete();

        return $this;
    }

    public function addChapter($name, $content, $attachments = [], $quiz = [])
    {
        $chapter = Chapter::fill(compact('name', 'content'));
        $chapter->course()->associate($this->model);
        $chapter->save();

        if (!is_dir($chapter->content_path)) {
            mkdir($chapter->content_path, 0775);
        }

        if (count($attachments)) {

        }

        $quiz = Quiz::create(['name' => '', 'time' => 0]);
        $quiz->chapter()->associate($chapter);
        $quiz->save();

        foreach ($quiz as $question) {
            $this->addChapterQuiz($chapter, $question);
        }
    }

    public function deleteChapter($chapter)
    {
        if ($chapter instanceof Chapter)
            $chapter = $this->model->chapters()->findOrFail($chapter->id);
        else
            $chapter = $this->model->chapters()->findOrFail($chapter);

        $chapter->attachments->each(function ($attachment) {            
            $this->deleteChapterAttachment($attachment);
        });

        $chapter->quiz->questions->each(function ($question) {            
            $this->deleteChapterQuiz($question);
        });

        $chapter->delete();

        return $this;
    }

    public function addChapterAttachment($chapter, $file)
    {
        if ($chapter instanceof Chapter)
            $chapter = $this->model->chapters()->findOrFail($chapter->id);
        else
            $chapter = $this->model->chapters()->findOrFail($chapter);

        $file       = collect($file);
        $filename   = $file->get('filename');
        $filtype    = $file->get('filetype');
        $filesize   = $file->get('filesize');

        $attachment = $chapter->attachments()->create(compact('filename', 'filetype', 'filesize'));

        $file_encoded   = $file->get('dataurl');
        $file_encoded   = explode(',', $file_encoded);
        $file_base64    = $file_encoded[1];

        $fp = fopen($attachment->filepath, 'w+');
        fwrite($fp, base64_decode($file_base64));
        fclose($fp);

        return $this;
    }

    public function deleteChapterAttachment($attachment)
    {
        if ($attachment instanceof Attachment)
            $attachment = $this->model->attachments()->findOrFail($attachment->id);
        else
            $attachment = $this->model->attachments()->findOrFail($attachment);

        if (file_exists($attachment->filepath)) {
            unlink($attachment->filepath);
        }

        $attachment->delete();

        return $this;
    }

    public function addChapterQuiz($chapter, $questions = [])
    {
        if ($chapter instanceof Chapter)
            $chapter = $this->model->chapters()->findOrFail($chapter->id);
        else
            $chapter = $this->model->chapters()->findOrFail($chapter);

        $chapter->quiz->questions()->create($questions);

        return $this;
    }

    public function deleteChapterQuiz($question)
    {
        if ($question instanceof QuizQuestion) {
            // 
        } else {
            $question = QuizQuestion::findOrFail($question);
        }

        $question->delete();

        return $this;
    }

    public function addExamQuestion(array $question)
    {
        $exam   = new ExamQuestion;
        $exam->fill($question);
        $exam->exam()->associate($this->model->exam);
        $exam->save();

        return $this;
    }

    public function deleteExamQuestion($question)
    {
        if ($question instanceof ExamQuestion) {
            $question   = $this->model->exam->questions()->findOrFail($question->id);
        } else {
            $question   = $this->model->exam->questions()->findOrFail($question);
        }

        $question->delete();

        return $this;
    }

    public function addRequirement($course)
    {
        $this->model->requirements()->attach($course);

        return $this;
    }

    public function deleteRequirement($course)
    {
        $this->model->requirements()->detach($course);

        return $this;
    }

    public function checkRequirements($course = null, $user = null)
    {
        if ($course) $this->set($course);
        if ($user) $this->set($user);

        $requirements   = $this->model->requirements;
        $user_finished  = $this->getByMemberFinished($this->user);

        $requirement_finished   = $user_finished->filter(function ($course) use ($requirements) {
            return $requirements->search(function ($requirement) use ($course) {
                return $requirement->id === $course->id;
            });
        });

        $be_requirements = $requirements->diff($requirement_finished);

        return $be_requirements;
    }

    public function getPopular($limit = 20)
    {
        return $this->model->popular()->take($limit)->get();
    }

    public function getLatest($limit = 20)
    {
        return $this->model->latest()->take($limit)->get();
    }

    public function getByMemberActive($member)
    {
        return $this->getByMember($member, 'active');
    }

    public function getByMemberPending($member)
    {
        return $this->getByMember($member, 'pending');
    }

    public function getByMemberFinished($member)
    {
        return $this->getByMember($member, 'finished');
    }

    public function getByMember($member, $status = 'all')
    {
        if (!($member instanceof User)) {
            $member = User::findOrFail($member);
        }

        $courses = $this->model->newQuery();
        $courses->select('courses.*', 'course_member.status', 'course_member.joined_at');
        $courses->join('course_member', 'course_member.course_id', '=', 'courses.id');
        $courses->where('course_member.user_id', $member->id);

        if ($status && $status !== 'all')
            $courses->where('course_member.status', $status);

        return $courses->get();
    }

    public function search($term)
    {
        $course     = $this->model->newQuery();
        $result     = $course->search($term);

        return $result;
    }

    public function searchWithCategory($term, $category)
    {
        $this->setCategory($category);

        $course     = $this->model->newQuery();

        $course->whereHas('category', function ($query) {
            return $query->where('id', $this->category->id);
        });

        $result     = $course->search($term);

        return $result;
    }

    public function hasFeaturedImage()
    {
        return $this->model->hasFeatured();
    }

    public function memberHasFinishedChapter(Chapter $chapter)
    {
        return $chapter->memberHasFinished($this->user);
    }

    public function memberAllowChapter(Chapter $chapter)
    {
        $chapters   = $this->model->chapters;
        $first      = $chapters->first();

        if ($first->id === $chapter->id) {
            return true;
        } else {
            $before = $first;

            foreach ($chapters as $item) {
                if ($item->id === $chapter->id)
                    return $before->memberHasFinished($this->user);

                $before = $item;
            }

            return false;
        }
    }

    public function startQuiz(Quiz $quiz, $attempt = 1)
    {
        if (!$this->checkQuizMember($quiz)) {
            $quiz->members()->create([
                'user_id'       => $this->user->id,
                'attempt'       => $attempt,
                'started_at'    => Carbon::now(),
                'finished_at'   => Carbon::now()->addMinutes($quiz->time),
            ]);
        }
    }

    public function getMemberSessionQuiz(Quiz $quiz)
    {
        if ($this->checkQuizTimeout($quiz)) {
            $member = $quiz->members()->where('user_id', $this->user->id)->first();

            return $member;
        } else {
            return null;
        }
    }

    public function getMemberQuiz(Quiz $quiz)
    {
        return $quiz->members;
    }

    public function checkQuizMember(Quiz $quiz, User $user = null)
    {
        if ($user) $this->setUser($user);

        $search = $this->getMemberQuiz($quiz)->search(function ($member) {
            return $member->user_id === $this->user->id;
        });

        if ($search !== FALSE) {
            return true;
        } else {
            return false;
        }
    }

    public function checkQuizTimeout(Quiz $quiz, $attempt = 1)
    {
        $member = $quiz->members()->where('user_id', $this->user->id)->first();

        if ($member) {
            if ($member->finished_at->diffInSeconds(Carbon::now(), false) < 0) {
                return true;
            }
        }

        return false;
    }

    public function submitQuizMember(Quiz $quiz, $answers = [])
    {
        $member = $this->getMemberSessionQuiz($quiz);

        if ($member) {
            $answers = collect($answers)->map(function ($answer, $question_id) {
                $question = QuizQuestion::find($question_id);

                return new QuizAnswer([
                    'question_id'   => $question_id,
                    'answer'        => $answer,
                    'is_correct'    => $question->correct == $answer,
                ]);
            });

            $member->answers()->saveMany($answers);

            return $member->answers;
        }

        return null;
    }
}