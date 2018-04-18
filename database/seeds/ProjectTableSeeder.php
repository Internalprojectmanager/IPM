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
                'id' => 1,
                'company_id' => 1,
                'projectcode' => 'P-1',
                'name' => 'Test Project',
                'path' => 'test-project',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'status' => 6,
                'deadline' => '2018-02-20 23:59:59',
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:52',
                'updated_at' => '2018-02-20 15:02:00',
            ),
        ));
        
        
    }
}