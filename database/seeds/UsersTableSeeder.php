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
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'IAV',
                'email' => 'info@itsavirus.com',
                'job_title' => 14,
                'active' => 1,
                'password' => '$2y$10$sqT6fqeeZrNZRMOH3KnRxul.H/eXsw7kshYayhTm56jPhrOaG.19S',
                'remember_token' => 'xqAHRLdx9RP72SeYCBmNlY5ggQ7cy5WbGGU8mftjmlhSlJPkTXsMxTGrlfhO',
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2018-02-13 09:35:09',
            ),
        ));
        
        
    }
}