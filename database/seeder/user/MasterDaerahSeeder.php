<?php

use Phinx\Seed\AbstractSeed;

use Illuminate\Database\Capsule\Manager as DB;

class MasterDaerahSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        DB::connection('user')->table('inf_lokasi')->delete();

        $query = file_get_contents(__DIR__.'/../../inf_lokasi.sql');

        $this->execute($query);
    }
}
