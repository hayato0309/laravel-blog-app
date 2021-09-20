<?php

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
        // seeder
        $this->call(CategoriesTableSeeder::class);
        $this->call(PostTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        // factory
        factory(App\User::class, 5)->create();
    }
}
