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
                'projectcode' => 'P-GECKO',
                'name' => 'Geckoboard CC Sales',
                'path' => 'geckoboard-cc-sales',
                'description' => 'Nieuwe dashboards voor het Call Center van Fietsenwinkel, Hier wordt de performance van de medewerkes bijgehouden om een effientere dag in te kunnen plannen',
                'status' => 1,
                'deadline' => '2017-12-22 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:52',
                'updated_at' => '2017-11-15 16:04:52',
            ),
            1 => 
            array (
                'id' => 2,
                'company_id' => 1,
                'projectcode' => 'P-MYFIETS',
                'name' => 'MyFietsenwinkel',
                'path' => 'myfietsenwinkel',
                'description' => 'Een nieuwe dashboard voor MyFietsenwinkel om bij te houden wat alle medewerkers doen binnen het bedrijf',
                'status' => 2,
                'deadline' => '2017-12-31 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:07:56',
                'updated_at' => '2017-11-15 10:45:36',
            ),
            2 => 
            array (
                'id' => 3,
                'company_id' => 2,
                'projectcode' => 'P-IAVIPM',
                'name' => 'IPM',
                'path' => 'ipm',
                'description' => 'Project management tool voor itsavirus',
                'status' => 4,
                'deadline' => '2017-11-20 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:51:20',
                'updated_at' => '2017-11-15 10:51:20',
            ),
            3 => 
            array (
                'id' => 4,
                'company_id' => 3,
                'projectcode' => 'P-NIJNTJE',
                'name' => 'Nijntje',
                'path' => 'nijntje',
                'description' => NULL,
                'status' => 6,
                'deadline' => '2017-11-11 16:04:27',
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:27',
                'updated_at' => '2017-11-15 16:04:27',
            ),
            4 => 
            array (
                'id' => 5,
                'company_id' => 2,
                'projectcode' => 'P-SHELL',
                'name' => 'Shell',
                'path' => 'shell',
                'description' => NULL,
                'status' => 1,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:34',
                'updated_at' => '2017-11-15 16:04:34',
            ),
            5 => 
            array (
                'id' => 6,
                'company_id' => 2,
                'projectcode' => 'P-PRESTON',
                'name' => 'The Prestonator',
                'path' => 'the-prestonator',
                'description' => NULL,
                'status' => 1,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-15 16:04:43',
                'updated_at' => '2017-11-15 16:04:43',
            ),
            6 => 
            array (
                'id' => 7,
                'company_id' => 2,
                'projectcode' => 'P-IAVWEBSITE',
                'name' => 'Website',
                'path' => 'website',
                'description' => 'Webiste voor Itsavirus',
                'status' => 3,
                'deadline' => '2017-11-15 00:00:00',
                'users' => NULL,
                'created_at' => '2017-10-24 13:38:29',
                'updated_at' => '2018-01-17 15:19:59',
            ),
            7 => 
            array (
                'id' => 8,
                'company_id' => 3,
                'projectcode' => 'P-MUSK',
                'name' => 'musk',
                'path' => 'musk-2',
                'description' => 'Een nieuwe dashboard
voor Review Club',
                'status' => 1,
                'deadline' => '2016-11-11 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:50:05',
                'updated_at' => '2018-02-14 12:56:27',
            ),
            8 => 
            array (
                'id' => 9,
                'company_id' => 3,
                'projectcode' => 'P-WILLT',
                'name' => 'WILTT',
                'path' => 'wiltt',
                'description' => '',
                'status' => 3,
                'deadline' => '2018-01-12 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-15 10:50:30',
                'updated_at' => '2017-11-15 10:50:30',
            ),
            9 => 
            array (
                'id' => 10,
                'company_id' => 1,
                'projectcode' => 'P-TICKET',
                'name' => 'Ticketer',
                'path' => 'ticketer',
                'description' => NULL,
                'status' => 3,
                'deadline' => NULL,
                'users' => NULL,
                'created_at' => '2017-11-23 11:37:16',
                'updated_at' => '2017-11-23 11:37:16',
            ),
            10 => 
            array (
                'id' => 11,
                'company_id' => 4,
                'projectcode' => 'P-MOBIELBANK',
                'name' => 'Mobiel Bankieren',
                'path' => 'mobiel-bankieren',
                'description' => 'Nieuwe versie van mobiel bankieren',
                'status' => 2,
                'deadline' => '2018-01-31 00:00:00',
                'users' => NULL,
                'created_at' => '2017-11-23 11:56:17',
                'updated_at' => '2017-11-23 11:56:17',
            ),
            11 => 
            array (
                'id' => 15,
                'company_id' => 5,
                'projectcode' => 'P-EFFECT',
                'name' => 'Effect.AI',
                'path' => 'effect.ai',
                'description' => 'The Artificial Intelligence market is growing at a remarkable rate but is becoming increasingly more inaccessible by every passing moment. Large corporations like Google, Facebook and Amazon have driven the innovation of AI and its development behind closed doors. Our project introduces a solution by creating an open, decentralized network that provides all services in the Artificial Intelligence market. This project is called The Effect Network.',
                'status' => 2,
                'deadline' => '2017-12-31 00:00:00',
                'users' => NULL,
                'created_at' => '2017-12-12 14:08:27',
                'updated_at' => '2017-12-12 14:08:27',
            ),
            12 => 
            array (
                'id' => 22,
                'company_id' => 13,
                'projectcode' => 'P-VMC',
                'name' => 'VMC',
                'path' => 'vmc',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'status' => 1,
                'deadline' => '2018-02-11 00:00:00',
                'users' => NULL,
                'created_at' => '2018-02-13 09:13:50',
                'updated_at' => '2018-02-13 09:13:50',
            ),
            13 => 
            array (
                'id' => 23,
                'company_id' => 1,
                'projectcode' => 'P-FIETSTEST',
                'name' => 'Fiets TEST',
                'path' => 'fiets-test',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'status' => 4,
                'deadline' => '2018-02-20 00:00:00',
                'users' => NULL,
                'created_at' => '2018-02-13 10:29:14',
                'updated_at' => '2018-02-13 10:29:14',
            ),
        ));
        
        
    }
}