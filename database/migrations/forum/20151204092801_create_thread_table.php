<?php

use Phinx\Migration\AbstractMigration;

class CreateThreadTable extends AbstractMigration
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
    public function up()
    {
        $table = $this->table('threads');
        $table->addColumn('category', 'integer', array('limit' => 1))
            ->addColumn('topic', 'integer')
            ->addColumn('type', 'string', array('limit' => 6)) 
            ->addColumn('title','text')
            ->addColumn('message','text')
            ->addColumn('reply_to', 'integer')
            ->addColumn('author', 'integer')
            ->addColumn('status', 'integer', array('limit' => 1))
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('topics');
        $table->addColumn('tenaga_ahli', 'integer')
            ->addColumn('category', 'integer')
            ->addColumn('topic', 'string', array('limit' => 100))
            ->addColumn('daerah', 'string', array('limit' => 50))
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('visitors');
        $table->addColumn('thread', 'integer')
            ->addColumn('ip_address', 'string', array('limit' => 64))
            ->addColumn('access_url', 'string')
            ->addColumn('user_agent', 'string')
            ->addColumn('times', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();
    }

    public function down()
    {

    }
}
