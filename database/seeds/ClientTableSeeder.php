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
                'path' => 'fietsenwinkel',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'status' => 7,
                'contactname' => 'Cecilia Lisa',
                'contactnumber' => NULL,
                'contactemail' => NULL,
                'contacts' => NULL,
                'link' => NULL,
                'created_at' => '2017-10-24 13:51:50',
                'updated_at' => '2018-02-14 13:03:12',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Itsavirus',
                'path' => 'itsavirus',
                'description' => NULL,
                'status' => 8,
                'contactname' => 'Jochem Verheul',
                'contactnumber' => '+31 20 7371594',
                'contactemail' => 'jverheul@itsavirus.com',
                'contacts' => NULL,
                'link' => NULL,
                'created_at' => '2017-10-12 15:12:44',
                'updated_at' => '2017-10-12 15:12:44',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Stars & Stories',
                'path' => 'stars-&-stories',
                'description' => NULL,
                'status' => 9,
                'contactname' => 'Ludovicus Steinarr',
                'contactnumber' => NULL,
                'contactemail' => NULL,
                'contacts' => NULL,
                'link' => NULL,
                'created_at' => '2017-11-15 10:49:31',
                'updated_at' => '2018-02-14 09:02:08',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'ABN AMRO',
                'path' => 'abn-amro',
                'description' => 'Nederlandse bank',
                'status' => 8,
                'contactname' => 'Piet Dijkstra',
                'contactnumber' => '+31 6 12345678',
                'contactemail' => 'pdijksta@abnamro.nl',
                'contacts' => NULL,
                'link' => NULL,
                'created_at' => '2017-11-23 11:54:33',
                'updated_at' => '2017-11-23 11:54:33',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Effect.AI',
                'path' => 'effect.ai',
                'description' => NULL,
                'status' => 7,
                'contactname' => 'Chris Dawe',
                'contactnumber' => '+31 6 12345678',
                'contactemail' => 'cdawe@effect.ai',
                'contacts' => NULL,
                'link' => NULL,
                'created_at' => '2017-12-12 14:07:09',
                'updated_at' => '2017-12-12 14:07:09',
            ),
            5 => 
            array (
                'id' => 13,
                'name' => 'VMC',
                'path' => 'vmc',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'status' => 7,
                'contactname' => NULL,
                'contactnumber' => NULL,
                'contactemail' => NULL,
                'contacts' => NULL,
                'link' => 'a:2:{s:5:"title";N;s:4:"link";N;}',
                'created_at' => '2018-02-13 09:13:15',
                'updated_at' => '2018-02-13 09:13:15',
            ),
        ));
        
        
    }
}