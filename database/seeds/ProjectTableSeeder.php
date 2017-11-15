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
        

        \DB::table('project')->delete();
        
        \DB::table('project')->insert(array (
            0 => 
            array (
                'id' => 'FIETSGECKO',
                'company_id' => 'FIETS',
                'name' => 'Geckoboard CC Sales',
                'description' => NULL,
                'status' => 'Draft',
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:52',
                'updated_at' => '2017-11-15 16:04:52',
            ),
            1 => 
            array (
                'id' => 'FIETSTEST',
                'company_id' => 'FIETS',
                'name' => 'MyFietsenwinkel',
                'description' => 'Een nieuwe dashboard voor MyFietsenwinkel om bij te houden wat alle medewerkers doen binnen het bedrijf',
                'status' => 'In Progress',
                'deadline' => '2017-12-31 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:07:56',
                'updated_at' => '2017-11-15 10:45:36',
            ),
            2 => 
            array (
                'id' => 'ITSAVIPM',
                'company_id' => 'ITSAV',
                'name' => 'IPM',
                'description' => 'Project management tool voor itsavirus…',
                'status' => 'Canceled',
                'deadline' => '2017-11-18 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:51:20',
                'updated_at' => '2017-11-15 10:51:20',
            ),
            3 => 
            array (
                'id' => 'ITSAVNIJNT',
                'company_id' => 'STARS',
                'name' => 'Nijntje',
                'description' => NULL,
                'status' => 'Draft',
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:27',
                'updated_at' => '2017-11-15 16:04:27',
            ),
            4 => 
            array (
                'id' => 'ITSAVSHELL',
                'company_id' => 'ITSAV',
                'name' => 'Shell',
                'description' => NULL,
                'status' => 'Draft',
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:34',
                'updated_at' => '2017-11-15 16:04:34',
            ),
            5 => 
            array (
                'id' => 'ITSAVTHE P',
                'company_id' => 'ITSAV',
                'name' => 'The Prestonator',
                'description' => NULL,
                'status' => 'Draft',
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:43',
                'updated_at' => '2017-11-15 16:04:43',
            ),
            6 => 
            array (
                'id' => 'ITSAVWEBSI',
                'company_id' => 'ITSAV',
                'name' => 'Website',
                'description' => 'Webiste voor Itsavirus...
',
                'status' => 'Paused',
                'deadline' => '2017-11-15 00:00:00',
                'users' => NULL,
                'created_at' => '2017-10-24 13:38:29',
                'updated_at' => '2017-10-24 13:38:29',
            ),
            7 => 
            array (
                'id' => 'STARSMUSK',
                'company_id' => 'STARS',
                'name' => 'MUSK',
                'description' => 'Een nieuwe dashboard
voor Review Club…',
                'status' => 'Draft',
                'deadline' => '2016-11-11 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:50:05',
                'updated_at' => '2017-11-15 10:54:38',
            ),
            8 => 
            array (
                'id' => 'STARSWILTT',
                'company_id' => 'STARS',
                'name' => 'WILTT',
                'description' => 'WILTT is een bedrijf waar je 
sex speel…',
                'status' => 'Paused',
                'deadline' => '2018-12-12 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:50:30',
                'updated_at' => '2017-11-15 10:50:30',
            ),
        ));
        
        
    }
}