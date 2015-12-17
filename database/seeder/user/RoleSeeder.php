<?php

use Phinx\Seed\AbstractSeed;

class RoleSeeder extends AbstractSeed
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
        $this->execute('DELETE FROM role_users');

        $role   = sentinel()->getRoleRepository()->createModel();
        $role->truncate();

        $roles = [
            'su'    => 'Super Admin',
            'adm'   => 'Admin',
            'edt'   => 'Editor',
            'ctr'   => 'Contributor',
            'ins'   => 'Instructor',
            'lnr'   => 'Learner',
            'pcp'   => 'Principal',
            'mdr'   => 'Moderator',
            'ast'   => 'Asisten',
            'pus'   => 'Pustakawan',
            'ta'    => 'Tenaga Ahli',
        ];

        foreach ($roles as $slug => $name) {
            $role->create(compact('slug', 'name'));
        }
    }
}
