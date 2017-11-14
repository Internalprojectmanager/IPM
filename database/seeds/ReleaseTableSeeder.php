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
                'id' => 1,
                'release_uuid' => Uuid::generate(4),
                'project_id' => 'ITSAVWEBSI',
                'name' => 'Specs',
                'description' => 'test',
                'version' => 1.0,
                'author' => 'Test',
                'specificationtype' => 'test',
                'created_at' => '2017-10-17 11:32:00',
                'updated_at' => '2017-10-17 11:32:00',
            ),
        ));
        
        
    }
}