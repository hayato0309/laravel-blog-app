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
        factory(App\User::class, 20)->create(); // PostFactory内でもUserFactoryをコールしているので、このFactoryは合計2回コールされる
        factory(App\Post::class, 20)->create();

        // Userデータが作られた後に実行する
        $this->call(EnsemblesTableSeeder::class);
    }
}
