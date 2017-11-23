<?php

use Illuminate\Database\Seeder;

class ReleaseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('release')->delete();
        
        \DB::table('release')->insert(array (
            0 => 
            array (
                'release_uuid' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'id' => 1,
                'project_id' => 7,
                'name' => 'Specs',
                'description' => 'test',
                'version' => 1.0,
                'author' => 'Test',
                'specificationtype' => 'test',
                'deadline' => '2017-11-08 11:43:59',
                'created_at' => '2017-10-17 11:32:00',
                'updated_at' => '2017-10-17 11:32:00',
            ),
        ));
        
        
    }
}