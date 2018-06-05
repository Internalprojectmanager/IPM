<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
                0 =>
                    array(
                        'name' => 'Project Manager',
                        'description' => 'Responsible for developing a definition of the project. The Project Manager also ensures that the project is delivered on time, to budget and to the required quality standard (within agreed specifications).',
                    ),
                1 =>
                    array(
                        'name' => 'Developer',
                        'description' => 'Staff who actively work on the developing process of the project.',
                    ),
                2 =>
                    array(
                    'name' => 'Designer',
                    'description' => 'Staff who actively work on the design process of the project.',
                )
            )
        );
    }
}
