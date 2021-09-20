<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Violin',
                'slug' => 'violin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Viola',
                'slug' => 'viola',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cello',
                'slug' => 'cello',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contrabass',
                'slug' => 'contrabass',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beethoven',
                'slug' => 'beethoven',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brahms',
                'slug' => 'brahms',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hilary Hahn',
                'slug' => 'hilary_hahn',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ray Chen',
                'slug' => 'ray_chen',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
