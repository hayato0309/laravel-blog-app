<?php

use Illuminate\Database\Seeder;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_types')->insert([
            [
                'name' => 'Article',
                'slug' => 'article',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Question',
                'slug' => 'question',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
