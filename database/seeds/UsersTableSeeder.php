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
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'iav@itsavirus.com',
                'password' => bcrypt('avocad0'),
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),

            1 =>
                array (
                    'first_name' => 'test',
                    'last_name' => 'test',
                    'email' => 'iav2@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),

            2 =>
                array (
                    'first_name' => 'test',
                    'last_name' => 'test',
                    'email' => 'iav3@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),
        ));
        
        
    }
}