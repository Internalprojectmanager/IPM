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
        // $this->call(UsersTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(ReleaseTableSeeder::class);
        $this->call(FeatureTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
