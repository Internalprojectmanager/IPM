<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status')->delete();
        
        \DB::table('status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Draft',
                'type' => 'Progress',
                'color' => '#5D99CA',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'In Progress',
                'type' => 'Progress',
                'color' => '#F5A623',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Paused',
                'type' => 'Progress',
                'color' => '#CECECE',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Cancelled',
                'type' => 'Progress',
                'color' => '#FF3300',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Testing',
                'type' => 'Progress',
                'color' => '#BD10E0',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Completed',
                'type' => 'Progress',
                'color' => '#7ED321',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Client',
                'type' => 'Client',
                'color' => '#B8E986',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Lead',
                'type' => 'Client',
                'color' => '#F5A623',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Prospect',
                'type' => 'Client',
                'color' => '#5D99CA',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'No Partners Anymore',
                'type' => 'Client',
                'color' => '#9B9B9B',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Final',
                'type' => 'Progress',
                'color' => '#727AA0',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Developer',
                'type' => 'Job',
                'color' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Designer',
                'type' => 'Job',
                'color' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Project Manager',
                'type' => 'Job',
                'color' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Document',
                'type' => 'Document',
                'color' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Test Rapport',
                'type' => 'Document',
                'color' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Letter',
                'type' => 'Document',
                'color' => NULL,
            ),
        ));
        
        
    }
}