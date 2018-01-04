<?php

use Illuminate\Database\Seeder;

class RequirementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('requirement')->delete();
        
        \DB::table('requirement')->insert(array (
            0 => 
            array (
                'id' => 1,
                'requirement_uuid' => '07f47c16-cd8f-4710-80b6-50c5a701ad61',
                'feature_uuid' => 'd9083cc5-93fa-4a21-8998-763dfca542d1',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Chose a color',
                'description' => 'CHOISES ARE BETWEEN:

- Black 
- Pink
- White
- Green',
                'status' => '2',
                'deadline' => '2018-01-04 16:34:13',
                'author' => '1',
                'created_at' => NULL,
                'updated_at' => '2018-01-04 15:34:13',
            ),
            1 => 
            array (
                'id' => 2,
                'requirement_uuid' => '37dc649b-bc1f-4a29-bcb3-eeb32f2f1a0a',
                'feature_uuid' => 'd9083cc5-93fa-4a21-8998-763dfca542d1',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Layout',
                'description' => 'Chose a nice layout',
                'status' => '1',
                'deadline' => '2018-01-04 16:33:16',
                'author' => '1',
                'created_at' => NULL,
                'updated_at' => '2018-01-04 15:24:04',
            ),
        ));
        
        
    }
}