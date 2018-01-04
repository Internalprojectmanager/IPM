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
        

        \DB::table('assignee')->delete();
        
        \DB::table('assignee')->insert(array (
            0 => 
            array (
                'id' => 1,
                'userid' => 5,
                'uuid' => '1',
                'status' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'userid' => 3,
                'uuid' => '2',
                'status' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'userid' => 5,
                'uuid' => '3',
                'status' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'userid' => 6,
                'uuid' => '3',
                'status' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'userid' => 7,
                'uuid' => '3',
                'status' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'userid' => 8,
                'uuid' => '3',
                'status' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'userid' => 4,
                'uuid' => '4',
                'status' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'userid' => 3,
                'uuid' => '4',
                'status' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'userid' => 10,
                'uuid' => '8',
                'status' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'userid' => 10,
                'uuid' => '9',
                'status' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'userid' => 2,
                'uuid' => '7',
                'status' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'userid' => 4,
                'uuid' => '7',
                'status' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'userid' => 8,
                'uuid' => '07f47c16-cd8f-4710-80b6-50c5a701ad61',
                'status' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'userid' => 5,
                'uuid' => '07f47c16-cd8f-4710-80b6-50c5a701ad61',
                'status' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'userid' => 6,
                'uuid' => '37dc649b-bc1f-4a29-bcb3-eeb32f2f1a0a',
                'status' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'userid' => 7,
                'uuid' => '37dc649b-bc1f-4a29-bcb3-eeb32f2f1a0a',
                'status' => 0,
            ),
        ));
        
        
    }
}