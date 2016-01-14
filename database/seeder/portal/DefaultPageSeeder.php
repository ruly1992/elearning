<?php

use Phinx\Seed\AbstractSeed;
use Carbon\Carbon;

class DefaultPageSeeder extends AbstractSeed
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
        $data   = [
            [
                'title'     => 'About Us',
                'slug'      => 'about-us',
                'content'   => 'Please edit this page in administrator',
                'date'      => Carbon::now()
            ],
            [
                'title'     => 'Contact Us',
                'slug'      => 'contact-us',
                'content'   => 'Please edit this page in administrator',
                'date'      => Carbon::now()
            ]
        ];

        Model\Portal\Page::truncate();

        $table = $this->table('pages');
        $table->insert($data)->save();
    }
}
