<?php

use Phinx\Migration\AbstractMigration;

class CreateInfLokasiTable extends AbstractMigration
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
        $this->execute("
            CREATE TABLE IF NOT EXISTS `inf_lokasi` (
              `lokasi_ID` int(11) NOT NULL AUTO_INCREMENT,
              `lokasi_kode` varchar(50) NOT NULL DEFAULT '',
              `lokasi_nama` varchar(100) NOT NULL DEFAULT '',
              `lokasi_propinsi` int(2) NOT NULL,
              `lokasi_kabupatenkota` int(2) unsigned zerofill DEFAULT NULL,
              `lokasi_kecamatan` int(2) unsigned zerofill NOT NULL,
              `lokasi_kelurahan` int(4) unsigned zerofill NOT NULL,
              PRIMARY KEY (`lokasi_ID`),
              KEY `lokasi_kode` (`lokasi_kode`),
              KEY `lokasi_propinsi` (`lokasi_propinsi`),
              KEY `lokasi_kabupatenkota` (`lokasi_kabupatenkota`),
              KEY `lokasi_kecamatan` (`lokasi_kecamatan`),
              KEY `lokasi_kelurahan` (`lokasi_kelurahan`)
            ) ENGINE=InnoDB AUTO_INCREMENT=68427 DEFAULT CHARSET=utf8;
        ");
    }

    public function down()
    {
        $this->execute('DROP TABLE IF EXISTS `inf_lokasi`;');
    }
}
