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
                'project_id' => 1,
                'name' => 'Specs',
                'path' => 'specs',
                'description' => 'test',
                'version' => 1.0,
                'status' => 1,
                'author' => 'Test',
                'specificationtype' => 'test',
                'document_status' => 1,
                'extra_content' => NULL,
                'deadline' => '2018-02-14 14:09:01',
                'created_at' => '2017-10-17 11:32:00',
                'updated_at' => '2017-10-17 11:32:00',
            ),
        ));
        
        
    }
}