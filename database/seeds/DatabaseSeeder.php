<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectTableSeeder::class);
        $this->call(ReleaseTableSeeder::class);
        $this->call(FeatureTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(AssigneeTableSeeder::class);
        $this->call(RequirementTableSeeder::class);
    }
}
