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
        

        \DB::table('users')->truncate();
        
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
                    'first_name' => 'Jochem',
                    'last_name' => 'Verheul',
                    'email' => 'jverheul@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),

            2 =>
                array (
                    'first_name' => 'Laurens',
                    'last_name' => 'Verspeek',
                    'email' => 'lverspeek@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),

            3 =>
                array (
                    'first_name' => 'Nick',
                    'last_name' => 'Vogel',
                    'email' => 'nvogel@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),

            4 =>
                array (
                    'first_name' => 'Jeffrey',
                    'last_name' => 'Walst',
                    'email' => 'jwalst@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),
            5 =>
                array (
                    'first_name' => 'Preston',
                    'last_name' => 'Ziessen',
                    'email' => 'pziessen@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),
            6 =>
                array (
                    'first_name' => 'Robin',
                    'last_name' => 'Geerlings',
                    'email' => 'rgeerlings@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),
            7 =>
                array (
                    'first_name' => 'Mike',
                    'last_name' => 'van der Berg',
                    'email' => 'mvanderberg@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),

            8 =>
                array (
                    'first_name' => 'Chris',
                    'last_name' => 'Dawe',
                    'email' => 'cdawe@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),

            9 =>
                array (
                    'first_name' => 'Noman',
                    'last_name' => 'Jabbar',
                    'email' => 'njabbar@itsavirus.com',
                    'password' => bcrypt('avocad0'),
                    'remember_token' => NULL,
                    'created_at' => '2017-10-12 15:12:37',
                    'updated_at' => '2017-10-12 15:12:37',
                ),
        ));
        
        
    }
}