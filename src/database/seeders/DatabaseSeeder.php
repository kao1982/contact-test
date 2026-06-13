<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  CategorySeederを呼び出すように指示します
        $this->call(CategorySeeder::class);

        \App\Models\Contact::factory()->count(35)->create();
    }
}
