<?php

use Illuminate\Database\Seeder;

class AssigneeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('assignee')->truncate();
        
        \DB::table('assignee')->insert(array (
            0 => 
            array (
                'userid' => 5,
                'uuid' => '1',
            ),
            1 => 
            array (
                'userid' => 3,
                'uuid' => '2',
            ),
            2 => 
            array (
                'userid' => 5,
                'uuid' => '3',
            ),
            3 => 
            array (
                'userid' => 6,
                'uuid' => '3',
            ),
            4 => 
            array (
                'userid' => 7,
                'uuid' => '3',
            ),
            5 => 
            array (
                'userid' => 8,
                'uuid' => '3',
            ),
            6 => 
            array (
                'userid' => 4,
                'uuid' => '4',
            ),
            7 => 
            array (
                'userid' => 3,
                'uuid' => '4',
            ),
            8 => 
            array (
                'userid' => 10,
                'uuid' => '8',
            ),
            9 => 
            array (
                'userid' => 10,
                'uuid' => '9',
            ),
            10 => 
            array (
                'userid' => 2,
                'uuid' => '7',
            ),
            11 => 
            array (
                'userid' => 4,
                'uuid' => '7',
            ),
        ));
        
        
    }
}