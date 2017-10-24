<?php

use Illuminate\Database\Seeder;

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
                'release_id' => 'WEBSITEST1',
                'name' => 'About us page with pictures of our team',
                'description' => 'Create a about page for the website',
                'status' => 'Open',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
        ));
        
        
    }
}