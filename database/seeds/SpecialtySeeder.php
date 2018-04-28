<?php

use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Specialties

        DB::table('specialties')->insert([
            ['name' => 'Account Management'],
            ['name' => 'Beauty'],
            ['name' => 'Sales/Business Development'],
            ['name' => 'Student/New Grads'],
            ['name' => 'Creative/Arts'],
            ['name' => 'Design'],
            ['name' => 'Marketing'],
            ['name' => 'Engineering/IT'],
            ['name' => 'Entrepreneurs'],
            ['name' => 'Executives'],
            ['name' => 'Finance'],
            ['name' => 'Fitness/Health'],
            ['name' => 'HR/Recruiting'],
            ['name' => 'Healthcare'],
            ['name' => 'Media'],
            ['name' => 'Mid Career'],
            ['name' => 'New Managers'],
            ['name' => 'Remote'],
            ['name' => 'Startups'],
            ['name' => 'Women'],
            ['name' => 'Other'],
        ]);
    }
}
