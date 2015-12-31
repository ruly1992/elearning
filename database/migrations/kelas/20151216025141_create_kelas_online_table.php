<?php

use Phinx\Migration\AbstractMigration;

class CreateKelasOnlineTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {        
        $table = $this->table('categories');
        $table->addColumn('name', 'string')
            ->addColumn('slug', 'string')
            ->addColumn('description', 'string')
            ->addIndex('slug', array('unique' => true))
            ->create();

        $table = $this->table('courses');
        $table->addColumn('code', 'string', array('limit' => 10))
            ->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('days', 'integer')
            ->addColumn('status', 'string', array('limit' => 10, 'default' => 'publish'))
            ->addColumn('featured', 'string')
            ->addColumn('thumbnail', 'string')
            ->addColumn('tags', 'string')
            ->addColumn('category_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex('code', array('unique' => true))
            ->create();

        $table = $this->table('course_requirements');
        $table->addColumn('course_id', 'integer')
            ->addColumn('requirement_course_id', 'integer')
            ->create();

        $table = $this->table('chapters');
        $table->addColumn('name', 'string')
            ->addColumn('order', 'integer', array('default' => 0))
            ->addColumn('content', 'text')
            ->addColumn('course_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('attachments');
        $table->addColumn('filename', 'string')
            ->addColumn('filetype', 'string')
            ->addColumn('filesize', 'integer')
            ->addColumn('chapter_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('quiz');
        $table->addColumn('name', 'string')
            ->addColumn('time', 'integer')
            ->addColumn('chapter_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('quiz_questions');
        $table->addColumn('question', 'text')
            ->addColumn('option_a', 'string')
            ->addColumn('option_b', 'string')
            ->addColumn('option_c', 'string')
            ->addColumn('option_d', 'string')
            ->addColumn('correct', 'string')
            ->addColumn('quiz_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('exams');
        $table->addColumn('name', 'string')
            ->addColumn('time', 'integer')
            ->addColumn('course_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('exam_questions');
        $table->addColumn('question', 'text')
            ->addColumn('option_a', 'string')
            ->addColumn('option_b', 'string')
            ->addColumn('option_c', 'string')
            ->addColumn('option_d', 'string')
            ->addColumn('correct', 'string')
            ->addColumn('exam_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();
    }
}
