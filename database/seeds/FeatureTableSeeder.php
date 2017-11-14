<?php

use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class FeatureTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('feature')->delete();
        
        \DB::table('feature')->insert(array (
            0 => 
            array (
                'id' => 23,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Design choises',
                'description' => 'Choose a new design for the website',
                'status' => 'Closed',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
            1 => 
            array (
                'id' => 24,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Login',
                'description' => 'Login for users',
                'status' => 'Testing',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
            2 => 
            array (
                'id' => 25,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Homepage',
                'description' => 'Create a homepage for the website',
                'status' => 'In Progress',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
            3 => 
            array (
                'id' => 26,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'About us',
                'description' => 'Create a about page for the website',
                'status' => 'Open',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
            4 => 
            array (
                'id' => 27,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Contact Page',
                'description' => NULL,
                'status' => 'Open',
                'author' => 'test test',
                'created_at' => '2017-10-24 15:35:19',
                'updated_at' => '2017-10-24 15:35:19',
            ),
            5 => 
            array (
                'id' => 28,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Work Page',
                'description' => NULL,
                'status' => 'Testing',
                'author' => 'test test',
                'created_at' => '2017-10-24 15:35:19',
                'updated_at' => '2017-10-24 15:35:19',
            ),
            6 => 
            array (
                'id' => 29,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Updates Page',
                'description' => NULL,
                'status' => 'Open',
                'author' => 'test test',
                'created_at' => '2017-10-24 16:10:18',
                'updated_at' => '2017-10-24 16:10:18',
            ),
            7 => 
            array (
                'id' => 30,
                'feature_uuid' => Uuid::generate(4),
                'release_id' => 'WEBSITEST1',
                'name' => 'Approach Page',
                'description' => NULL,
                'status' => 'In Progress',
                'author' => 'test test',
                'created_at' => '2017-10-24 16:10:18',
                'updated_at' => '2017-10-24 16:10:18',
            ),
        ));
        
        
    }
}