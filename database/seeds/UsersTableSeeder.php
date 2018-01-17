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
                'id' => 1,
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'iav@itsavirus.com',
                'job_title' => 14,
                'active' => 0,
                'password' => '$2y$10$sqT6fqeeZrNZRMOH3KnRxul.H/eXsw7kshYayhTm56jPhrOaG.19S',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            1 => 
            array (
                'id' => 2,
                'first_name' => 'Jochem',
                'last_name' => 'Verheul',
                'email' => 'jverheul@itsavirus.com',
                'job_title' => 14,
                'active' => 0,
                'password' => '$2y$10$7DXR4KB/qlgkoZKvmsgjjufTQ48C3Xy7v8FmW2on6pXRW64THCv.G',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            2 => 
            array (
                'id' => 3,
                'first_name' => 'Laurens',
                'last_name' => 'Verspeek',
                'email' => 'lverspeek@itsavirus.com',
                'job_title' => 12,
                'active' => 0,
                'password' => '$2y$10$UnmW3ATZxgxf6zxsj4pK.ubuhFjcFL6ehMGb/KmhJahMcA8Rw.DGq',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            3 => 
            array (
                'id' => 4,
                'first_name' => 'Nick',
                'last_name' => 'Vogel',
                'email' => 'nvogel@itsavirus.com',
                'job_title' => 13,
                'active' => 0,
                'password' => '$2y$10$dwwTXtaSlziewuPrmzlgAu75epAq9o6j7d00uH3ujv62yj4AtWwUG',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            4 => 
            array (
                'id' => 5,
                'first_name' => 'Jeffrey',
                'last_name' => 'Walst',
                'email' => 'jwalst@itsavirus.com',
                'job_title' => 12,
                'active' => 0,
                'password' => '$2y$10$0dnzeEWt68GHsxvdx/vNvO7DkSF6zkxhzibxynag0yHCHiXRxdxrO',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            5 => 
            array (
                'id' => 6,
                'first_name' => 'Preston',
                'last_name' => 'Ziessen',
                'email' => 'pziessen@itsavirus.com',
                'job_title' => 12,
                'active' => 0,
                'password' => '$2y$10$EGalUza1qqIa7gxvGC/GjO4ngzYZDSsP4bWKW2K/o8vx5D8HKIPsW',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            6 => 
            array (
                'id' => 7,
                'first_name' => 'Robin',
                'last_name' => 'Geerlings',
                'email' => 'rgeerlings@itsavirus.com',
                'job_title' => 12,
                'active' => 0,
                'password' => '$2y$10$7DC4zz9FxKCPt0sihAmlnumTZvwgf4p3L4xuXXzG915sS61NHQYSy',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            7 => 
            array (
                'id' => 8,
                'first_name' => 'Mike',
                'last_name' => 'van der Berg',
                'email' => 'mvanderberg@itsavirus.com',
                'job_title' => 12,
                'active' => 0,
                'password' => '$2y$10$aGD78ZZHRcLPXoDkQvW5L.5fexTwtehb486O4gfvUF1otucdfTmCa',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            8 => 
            array (
                'id' => 9,
                'first_name' => 'Chris',
                'last_name' => 'Dawe',
                'email' => 'cdawe@itsavirus.com',
                'job_title' => 14,
                'active' => 0,
                'password' => '$2y$10$817qlKrk69OyUSJTMQ.vP.uRvTAylpM3Ac7cIB6Waa/Lj1R6.nZSC',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
            9 => 
            array (
                'id' => 10,
                'first_name' => 'Noman',
                'last_name' => 'Jabbar',
                'email' => 'njabbar@itsavirus.com',
                'job_title' => 12,
                'active' => 0,
                'password' => '$2y$10$cqb9AyzJlc6tI.8v0beH7OCJ0wyxACDLiweRJFdCBBhP5OuoYbrq2',
                'remember_token' => NULL,
                'created_at' => '2017-10-12 15:12:37',
                'updated_at' => '2017-10-12 15:12:37',
            ),
        ));
        
        
    }
}