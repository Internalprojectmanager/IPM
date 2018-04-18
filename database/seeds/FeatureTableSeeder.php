<?php

use Illuminate\Database\Seeder;

class FeatureTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('feature')->delete();
        
        \DB::table('feature')->insert(array (
            0 => 
            array (
                'id' => 23,
                'feature_uuid' => 'd9083cc5-93fa-4a21-8998-763dfca542d1',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Design choises',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '6',
                'type' => 'Feature',
                'category' => NULL,
                'deadline' => '2018-02-14 14:27:53',
                'author' => '1',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2018-02-14 13:27:53',
            ),
            1 => 
            array (
                'id' => 24,
                'feature_uuid' => 'c5081fcb-b2c9-4b26-aad4-ff38a3198bdb',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Login',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'Feature',
                'category' => NULL,
                'deadline' => '2018-01-09 15:31:41',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
            2 => 
            array (
                'id' => 25,
                'feature_uuid' => '6c9699eb-8c48-4608-8f20-f7982f0a6a69',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Homepage',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'NFR',
                'category' => 15,
                'deadline' => '2018-01-17 15:50:02',
                'author' => '1',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2018-01-17 14:50:02',
            ),
            3 => 
            array (
                'id' => 26,
                'feature_uuid' => '59388e9c-4dd6-47b0-b09d-8bac89e1133a',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'About us',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'NFR',
                'category' => 15,
                'deadline' => '2018-01-09 15:31:32',
                'author' => 'test test',
                'created_at' => '2017-10-17 11:32:59',
                'updated_at' => '2017-10-17 11:32:59',
            ),
            4 => 
            array (
                'id' => 27,
                'feature_uuid' => '70c46161-1ad6-4254-be61-68af185591ef',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Contact Page 3',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'TS',
                'category' => 16,
                'deadline' => '2018-02-14 14:20:23',
                'author' => '1',
                'created_at' => '2017-10-24 15:35:19',
                'updated_at' => '2018-02-14 13:20:22',
            ),
            5 => 
            array (
                'id' => 28,
                'feature_uuid' => '1b6bf3dd-d116-4c84-b86c-4960c1b5045d',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Work Page',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'TS',
                'category' => 16,
                'deadline' => '2018-01-09 15:31:45',
                'author' => 'test test',
                'created_at' => '2017-10-24 15:35:19',
                'updated_at' => '2017-10-24 15:35:19',
            ),
            6 => 
            array (
                'id' => 29,
                'feature_uuid' => '5ea36b87-f72a-44b5-98e0-a70ff3af493b',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Updates Page',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'Scope',
                'category' => NULL,
                'deadline' => '2018-01-09 15:30:38',
                'author' => 'test test',
                'created_at' => '2017-10-24 16:10:18',
                'updated_at' => '2017-10-24 16:10:18',
            ),
            7 => 
            array (
                'id' => 30,
                'feature_uuid' => 'daf36880-9d5d-423a-bb1d-9012899307d5',
                'release_id' => '20e2a83f-8b08-43a8-80bd-082141058168',
                'name' => 'Approach Page',
                'path' => '',
                'description' => 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren \'60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.',
                'status' => '1',
                'type' => 'Scope',
                'category' => NULL,
                'deadline' => '2018-01-09 15:31:47',
                'author' => 'test test',
                'created_at' => '2017-10-24 16:10:18',
                'updated_at' => '2017-10-24 16:10:18',
            ),
        ));
        
        
    }
}