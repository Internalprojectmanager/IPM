<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('company')->delete();
        
        \DB::table('company')->insert(array (
            0 => 
            array (
                'id' => 'FIETS',
                'name' => 'Fietsenwinkel',
                'description' => NULL,
                'created_at' => '2017-10-24 13:51:50',
                'updated_at' => '2017-10-24 13:51:50',
            ),
            1 => 
            array (
                'id' => 'ITSAV',
                'name' => 'Itsavirus',
                'description' => NULL,
                'created_at' => '2017-10-12 15:12:44',
                'updated_at' => '2017-10-12 15:12:44',
            ),
        ));
        
        
    }
}