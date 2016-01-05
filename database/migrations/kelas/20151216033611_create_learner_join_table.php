<?php

use Phinx\Migration\AbstractMigration;

class CreateLearnerJoinTable extends AbstractMigration
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
        $table = $this->table('course_member');
        $table->addColumn('user_id', 'integer')
            ->addColumn('course_id', 'integer')
            ->addColumn('joined_at', 'datetime')
            ->create();

        $table = $this->table('member_quiz');
        $table->addColumn('user_id', 'integer')
            ->addColumn('quiz_id', 'integer')
            ->addColumn('attempt', 'integer', array('default' => 1))
            ->addColumn('started_at', 'datetime')
            ->addColumn('finished_at', 'datetime')
            ->create();

        $table = $this->table('member_quiz_answers');
        $table->addColumn('question_id', 'integer')
            ->addColumn('answer', 'string')
            ->addColumn('is_correct', 'string')
            ->create();

        $table = $this->table('member_exam');
        $table->addColumn('user_id', 'integer')
            ->addColumn('exam_id', 'integer')
            ->addColumn('attempt', 'integer', array('default' => 1))
            ->addColumn('started_at', 'datetime')
            ->addColumn('finished_at', 'datetime')
            ->create();

        $table = $this->table('member_exam_answers');
        $table->addColumn('question_id', 'integer')
            ->addColumn('answer', 'string')
            ->addColumn('is_correct', 'string')
            ->addColumn('member_exam_id', 'integer')
            ->create();
    }
}
