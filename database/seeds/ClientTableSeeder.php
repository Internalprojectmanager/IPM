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
                'name' => 'Test Client',
                'path' => 'test-client',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'status' => 7,
                'contactname' => 'Test Client',
                'contactnumber' => '+31 6 1234578',
                'contactemail' => 'testclient@test.nl',
                'contacts' => NULL,
                'link' => NULL,
                'created_at' => '2017-10-24 13:51:50',
                'updated_at' => '2018-02-14 13:03:12',
            ),
        ));
        
        
    }
}