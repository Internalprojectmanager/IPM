<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                    'color' => '#417505'
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'In Progress',
                    'type' => 'Progress',
                    'color' => '#5D99CA'
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Paused',
                    'type' => 'Progress',
                    'color' => '#9B9B9B'
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Cancelled',
                    'type' => 'Progress',
                    'color' => '#FF3300'
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Testing',
                    'type' => 'Progress',
                    'color' => ''
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Completed',
                    'type' => 'Progress',
                    'color' => ''
                ),

            6 =>
                array (
                    'id' => 7,
                    'name' => 'Client',
                    'type' => 'Client',
                    'color' => '#417505'
                ),

            7 =>
                array (
                    'id' => 8,
                    'name' => 'Lead',
                    'type' => 'Client',
                    'color' => '#5D99CA'
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Prospect',
                    'type' => 'Client',
                    'color' => '#FF3300'
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'No Partners Anymore',
                    'type' => 'Client',
                    'color' => '#9B9B9B'
                ),
        ));
    }
}
