<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('project')->delete();
        
        \DB::table('project')->insert(array (
            0 => 
            array (
                'id' => 'ITSAVWEBSI',
                'company_id' => 'ITSAV',
                'name' => 'Website',
                'description' => NULL,
                'created_at' => '2017-10-24 13:38:29',
                'updated_at' => '2017-10-24 13:38:29',
            ),
        ));
        
        
    }
}