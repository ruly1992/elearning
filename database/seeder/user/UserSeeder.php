<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
        $user   = sentinel()->getUserRepository()->createModel();

        Model\Activation::truncate();
        Model\Throttle::truncate();
        Model\Profile::truncate();

        $user->truncate();

        $users = [
            'su'    => ['superadmin1', 'superadmin2'],
            'adm'   => ['admin1', 'admin2'],
            'edt'   => ['editor1', 'editor2'],
            'ctr'   => ['contributor1', 'contributor2'],
            'ins'   => ['instructor1', 'instructor2'],
            'lnr'   => ['learner1', 'learner2', 'kader1', 'kader2'],
            'pcp'   => ['principal1', 'principal2'],
            'mdr'   => ['moderator1', 'moderator2'],
            'ast'   => ['asisten1', 'asisten2'],
            'pus'   => ['pustakawan1', 'pustakawan2'],
            'ta'    => ['tenagaahli1', 'tenagaahli2'],
        ];

        foreach ($users as $role_slug => $usernames) {
            $role = sentinel()->findRoleBySlug($role_slug);

            foreach ($usernames as $username) {
                $user = sentinel()->registerAndActivate([
                    'email'     => $username . '@desamembangun.go.id',
                    'password'  => '123',
                ]);

                $role->users()->attach($user);

                $user->profile()->update([
                    'first_name'    => $role->name
                ]);
            }
        }            
    }
}
