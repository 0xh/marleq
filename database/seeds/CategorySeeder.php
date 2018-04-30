<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Categories

        DB::table('categories')->insert([
            ['name' => 'Events'],
            ['name' => 'Inspiration']
        ]);
    }
}
