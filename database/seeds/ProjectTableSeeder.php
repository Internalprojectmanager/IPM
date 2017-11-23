<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Project')->delete();
        
        \DB::table('Project')->insert(array (
            0 => 
            array (
                'id' => 1,
                'company_id' => 1,
                'name' => 'Geckoboard CC Sales',
                'description' => NULL,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:52',
                'updated_at' => '2017-11-15 16:04:52',
                'status' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 1,
                'name' => 'MyFietsenwinkel',
                'description' => 'Een nieuwe dashboard voor MyFietsenwinkel om bij te houden wat alle medewerkers doen binnen het bedrijf',
                'deadline' => '2017-12-31 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:07:56',
                'updated_at' => '2017-11-15 10:45:36',
                'status' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 2,
                'name' => 'IPM',
                'description' => 'Project management tool voor itsavirus',
                'deadline' => '2017-11-20 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:51:20',
                'updated_at' => '2017-11-15 10:51:20',
                'status' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 3,
                'name' => 'Nijntje',
                'description' => NULL,
                'deadline' => '2017-11-23 16:04:27',
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:27',
                'updated_at' => '2017-11-15 16:04:27',
                'status' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => 2,
                'name' => 'Shell',
                'description' => NULL,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:34',
                'updated_at' => '2017-11-15 16:04:34',
                'status' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => 2,
                'name' => 'The Prestonator',
                'description' => NULL,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:43',
                'updated_at' => '2017-11-15 16:04:43',
                'status' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'company_id' => 2,
                'name' => 'Website',
                'description' => 'Webiste voor Itsavirus',
                'deadline' => '2017-11-15 00:00:00',
                'users' => NULL,
                'created_at' => '2017-10-24 13:38:29',
                'updated_at' => '2017-10-24 13:38:29',
                'status' => 3,
            ),
            7 => 
            array (
                'id' => 8,
                'company_id' => 3,
                'name' => 'MUSK',
                'description' => 'Een nieuwe dashboard
voor Review Club',
                'deadline' => '2016-11-11 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:50:05',
                'updated_at' => '2017-11-15 10:54:38',
                'status' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'company_id' => 3,
                'name' => 'WILTT',
                'description' => 'WILTT is een bedrijf waar je 
sex speel',
                'deadline' => '2018-12-12 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:50:30',
                'updated_at' => '2017-11-15 10:50:30',
                'status' => 3,
            ),
            9 => 
            array (
                'id' => 10,
                'company_id' => 1,
                'name' => 'Ticketer',
                'description' => NULL,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-23 11:37:16',
                'updated_at' => '2017-11-23 11:37:16',
                'status' => 3,
            ),
            10 => 
            array (
                'id' => 11,
                'company_id' => 4,
                'name' => 'Mobiel Bankieren',
                'description' => 'Nieuwe versie van mobiel bankieren',
                'deadline' => '2017-12-31 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-23 11:56:17',
                'updated_at' => '2017-11-23 11:56:17',
                'status' => 2,
            ),
        ));
        
        
    }
}