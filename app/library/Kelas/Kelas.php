<?php

namespace Library\Kelas;

use Model\User;
use Model\Kelas\Course;
use Model\Kelas\Category;
use Model\Kelas\Chapter;
use Model\Kelas\Attachment;

class Kelas
{
    use CategoryTrait;

    protected $course;
    protected $var_category;
    protected $chapter;
    protected $attachment;
    protected $user;

    public function __construct()
    {
        $this->user         = sentinel()->getUser();
        $this->course       = new Course;
        $this->category     = new Category;
        $this->chapter      = new Chapter;
        $this->attachment   = new Attachment;
    }

    public function setCourse($course)
    {
        if ($course instanceof Course)
            $this->course   = $course;
        else
            $this->course   = $this->course->withDrafts()->findOrFail($course);
    }

    public function getCourse($id = null)
    {
        if ($id)
            $this->setCourse($id);
        
        return $this->course;
    }

    public function create($name, $var_category)
    {
        $this->setCategory($var_category);

        $course         = new $this->course;
        $course->name   = $name;

        $course->category()->associate($this->category);
        $course->instructor()->associate($this->user);

        $course->save();

        $this->setCourse($course);

        return $course;
    }

    public function update($name, $var_category = null)
    {
        if ($var_category)
            $this->setCategory($var_category);

        $course         = new $this->course;
        $course->name   = $name;

        $course->category()->associate($this->category);
        $course->instructor()->associate($this->user);

        $course->save();

        $this->setCourse($course);

        return $course;
    }
}