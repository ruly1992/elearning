<?php

use Phinx\Migration\AbstractMigration;

class CreateTableKonsultasi extends AbstractMigration
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
        $table = $this->table('konsultasi');
        $table->addColumn('subjek', 'string')
              ->addColumn('prioritas', 'string', ['default' => 'High'])
              ->addColumn('pesan', 'text')
              ->addColumn('attachment', 'string')
              ->addColumn('user_id', 'integer')
              ->addColumn('status', 'string', ['default' => 'Open'])
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime')
              ->addColumn('id_kategori', 'integer')
              ->create();

        $table = $this->table('konsultasi_kategori');
        $table->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('reply');
        $table->addColumn('id_konsultasi', 'integer')
            ->addColumn('id_user', 'integer')
            ->addColumn('isi', 'text')
            ->addColumn('attachment', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();

        $table = $this->table('konsultasi_kategori_has_konsultasi');
        $table->addColumn('id_kategori_kategori', 'integer')
            ->addColumn('id_konsultasi', 'integer')
            ->create();

        $table = $this->table('konsultasi_user_has_kategori');
        $table->addColumn('user_id','integer')
            ->addColumn('id_kategori', 'integer')
            ->create();
    }

    public function down()
    {

    }
}
