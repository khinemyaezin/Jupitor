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
        // \App\Models\ArticleGroup::factory(20)->create();
        // \App\Models\Article::factory(20)->create();
        //\App\Models\Image::factory(20)->create();
        \App\Models\Quotation::factory(50)->create();
    }
}
