<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $user = new \App\User();
        $user->first_name = 'IAV';
        $user->last_name = 'Admin';
        $user->email = 'info@itsavirus.com';
        $user->password = 'password';
        $user->active = 1;
        $user->job_title = 14;
        $user->save();
        
    }
}