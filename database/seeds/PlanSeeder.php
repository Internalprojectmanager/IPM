<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = new \App\Plan();
        $plan->name = 'No Plan';
        $plan->users = 1;
        $plan->projects = 0;
        $plan->releases = 0;
        $plan->pdf = 0;
        $plan->documents = 0;
        $plan->support = 0;
        $plan->save();
    }
}
