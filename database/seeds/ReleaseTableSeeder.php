<?php

use Illuminate\Database\Seeder;

class ReleaseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('release')->delete();
        
        \DB::table('release')->insert(array (
            0 => 
            array (
                'release_uuid' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'id' => 1,
                'project_id' => 7,
                'name' => 'Specs',
                'path' => 'specs',
                'description' => 'test',
                'version' => 1.0,
                'status' => 1,
                'author' => 'Test',
                'specificationtype' => 'test',
                'document_status' => 1,
                'extra_content' => NULL,
                'deadline' => '2018-02-14 14:09:01',
                'created_at' => '2017-10-17 11:32:00',
                'updated_at' => '2017-10-17 11:32:00',
            ),
            1 => 
            array (
                'release_uuid' => '7738ad51-139c-4653-be18-12164bc6d897',
                'id' => 6,
                'project_id' => 3,
                'name' => 'Sprint',
                'path' => 'sprint',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'version' => 1.0,
                'status' => 3,
                'author' => '1',
                'specificationtype' => 'Project Specification',
                'document_status' => 11,
                'extra_content' => NULL,
                'deadline' => '2018-02-14 14:09:04',
                'created_at' => '2018-02-13 09:23:44',
                'updated_at' => '2018-02-13 09:23:44',
            ),
            2 => 
            array (
                'release_uuid' => '70c390b3-de94-4df0-8467-5a8052355574',
                'id' => 7,
                'project_id' => 7,
                'name' => 'test',
                'path' => 'test',
                'description' => 'test',
                'version' => 2.0,
                'status' => 2,
                'author' => '1',
                'specificationtype' => 'test',
                'document_status' => 3,
                'extra_content' => NULL,
                'deadline' => '2018-02-19 00:00:00',
                'created_at' => '2018-02-14 13:15:18',
                'updated_at' => '2018-02-14 13:15:18',
            ),
        ));
        
        
    }
}