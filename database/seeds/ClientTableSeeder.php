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
                'contactname' => 'Cecilia Lisa',
            'contactnumber' => '(938) 536-4818',
                'contactemail' => 'c.lisa@fietsenwinkel.nl',
                'created_at' => '2017-10-24 13:51:50',
                'updated_at' => '2017-10-24 13:51:50',
                'status' => 7,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Itsavirus',
                'description' => NULL,
                'contactname' => 'Jochem Verheul',
                'contactnumber' => '+31 20 7371594',
                'contactemail' => 'jverheul@itsavirus.com',
                'created_at' => '2017-10-12 15:12:44',
                'updated_at' => '2017-10-12 15:12:44',
                'status' => 8,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Stars & Stories',
                'description' => NULL,
                'contactname' => 'Ludovicus Steinarr',
            'contactnumber' => '(280) 597-0150',
                'contactemail' => 'l.steinarr@starsenstories.nl',
                'created_at' => '2017-11-15 10:49:31',
                'updated_at' => '2017-11-15 10:49:31',
                'status' => 9,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'ABN AMRO',
                'description' => 'Nederlandse bank',
                'contactname' => 'Piet Dijkstra',
                'contactnumber' => '+31 6 12345678',
                'contactemail' => 'pdijksta@abnamro.nl',
                'created_at' => '2017-11-23 11:54:33',
                'updated_at' => '2017-11-23 11:54:33',
                'status' => 8,
            ),
        ));
        
        
    }
}