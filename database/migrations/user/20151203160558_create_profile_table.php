<?php

use Phinx\Migration\AbstractMigration;

class CreateProfileTable extends AbstractMigration
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
        $table = $this->table('profile');
        $table->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('gender', 'string', ['limit' => 10, 'default' => 'male'])
            ->addColumn('tempat_lahir', 'string')
            ->addColumn('tanggal_lahir', 'date')
            ->addColumn('address', 'string')
            ->addColumn('desa_id', 'string', ['limit' => 20])
            ->addColumn('avatar', 'string')
            ->addColumn('user_id', 'integer')
            ->save();
    }
}
