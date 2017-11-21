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
                'id' => 'FIETS',
                'name' => 'Fietsenwinkel',
                'description' => NULL,
                'contactname' => 'Cecilia Lisa',
                'contactnumber' => '(938) 536-4818',
                'contactemail' => 'c.lisa@fietsenwinkel.nl',
                'status' => 'Prospect',
                'created_at' => '2017-10-24 13:51:50',
                'updated_at' => '2017-10-24 13:51:50',
            ),
            1 => 
            array (
                'id' => 'ITSAV',
                'name' => 'Itsavirus',
                'description' => NULL,
                'contactname' => 'Jochem Verheul',
                'contactnumber' => '+31 20 7371594',
                'contactemail' => 'jverheul@itsavirus.com',
                'status' => 'Lead',
                'created_at' => '2017-10-12 15:12:44',
                'updated_at' => '2017-10-12 15:12:44',
            ),
            2 => 
            array (
                'id' => 'STARS',
                'name' => 'Stars & Stories',
                'description' => NULL,
                'contactname' => 'Ludovicus Steinarr',
                'contactnumber' => '(280) 597-0150',
                'contactemail' => 'l.steinarr@starsenstories.nl',
                'status' => 'Client',
                'created_at' => '2017-11-15 10:49:31',
                'updated_at' => '2017-11-15 10:49:31',
            ),
        ));
        
        
    }
}