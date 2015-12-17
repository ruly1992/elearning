<?php

use Phinx\Migration\AbstractMigration;

class CreateElibraryDb extends AbstractMigration
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
            ->addColumn('description', 'string')
            ->addColumn('parent', 'string')
            ->addColumn('order', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('media');
        $table->addColumn('file_name', 'string')
            ->addColumn('file_type', 'string')
            ->addColumn('file_size', 'integer')
            ->addColumn('title', 'string')
            ->addColumn('description', 'string')
            ->addColumn('full_description', 'text')
            ->addColumn('type', 'string', array('limit' => 50, 'default' => 'public'))
            ->addColumn('status', 'string', array('default' => 'publish'))
            ->addColumn('category_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addColumn('deleted_at', 'datetime')
            ->create();

        $table = $this->table('metadata');
        $table->addColumn('key', 'string')
            ->addColumn('value', 'text')
            ->addColumn('media_id', 'integer')
            ->create();

        $table = $this->table('metadata_standards');
        $table->addColumn('name', 'string')
            ->addColumn('description', 'string')
            ->create();

        $table = $this->table('metadata_standard_details');
        $table->addColumn('key', 'string')
            ->addColumn('description', 'text')
            ->addColumn('standard_id', 'integer')
            ->create();

        $table = $this->table('settings');
        $table->addColumn('key', 'string')
            ->addColumn('value', 'string')
            ->create();

        $table = $this->table('tags');
        $table->addColumn('name', 'string')
            ->create();

        $table = $this->table('visitor_media');
        $table->addColumn('ip_address', 'string', array('limit' => 50))
            ->addColumn('media_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();
    }
}
