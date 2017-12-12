<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client')->delete();
        
        \DB::table('client')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Fietsenwinkel',
                'description' => NULL,
                'status' => 7,
                'contactname' => 'Cecilia Lisa',
            'contactnumber' => '(938) 536-4818',
                'contactemail' => 'c.lisa@fietsenwinkel.nl',
                'created_at' => '2017-10-24 13:51:50',
                'updated_at' => '2017-10-24 13:51:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Itsavirus',
                'description' => NULL,
                'status' => 8,
                'contactname' => 'Jochem Verheul',
                'contactnumber' => '+31 20 7371594',
                'contactemail' => 'jverheul@itsavirus.com',
                'created_at' => '2017-10-12 15:12:44',
                'updated_at' => '2017-10-12 15:12:44',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Stars & Stories',
                'description' => NULL,
                'status' => 9,
                'contactname' => 'Ludovicus Steinarr',
            'contactnumber' => '(280) 597-0150',
                'contactemail' => 'l.steinarr@starsenstories.nl',
                'created_at' => '2017-11-15 10:49:31',
                'updated_at' => '2017-11-15 10:49:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'ABN AMRO',
                'description' => 'Nederlandse bank',
                'status' => 8,
                'contactname' => 'Piet Dijkstra',
                'contactnumber' => '+31 6 12345678',
                'contactemail' => 'pdijksta@abnamro.nl',
                'created_at' => '2017-11-23 11:54:33',
                'updated_at' => '2017-11-23 11:54:33',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Effect.AI',
                'description' => NULL,
                'status' => 7,
                'contactname' => 'Chris Dawe',
                'contactnumber' => '+31 6 12345678',
                'contactemail' => 'cdawe@effect.ai',
                'created_at' => '2017-12-12 14:07:09',
                'updated_at' => '2017-12-12 14:07:09',
            ),
        ));
        
        
    }
}