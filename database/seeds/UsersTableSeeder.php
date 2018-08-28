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
        $user->first_name = 'System';
        $user->last_name = 'Administrator';
        $user->email = 'itsaprojectmanager@gmail.com';
        $user->password = 'password';
        $user->active = 1;
        $user->job_title = 14;
        $user->save();
        
    }
}