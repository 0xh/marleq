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
        $this->call([
            LaratrustSeeder::class,
            SpecialtySeeder::class,
            ServiceSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
            LanguageSeeder::class,
        ]);
    }
}
