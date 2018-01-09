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
                'name' => 'Choose a color',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.
',
                'status' => '1',
                'deadline' => '2018-01-09 15:32:17',
                'author' => '1',
                'created_at' => NULL,
                'updated_at' => '2018-01-09 14:15:08',
            ),
            1 => 
            array (
                'id' => 2,
                'requirement_uuid' => '37dc649b-bc1f-4a29-bcb3-eeb32f2f1a0a',
                'feature_uuid' => 'd9083cc5-93fa-4a21-8998-763dfca542d1',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Layout',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.
',
                'status' => '1',
                'deadline' => '2018-01-09 15:32:13',
                'author' => '1',
                'created_at' => NULL,
                'updated_at' => '2018-01-09 14:15:10',
            ),
        ));
        
        
    }
}