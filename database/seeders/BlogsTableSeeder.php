<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\BlogsFactory;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Blog::class, 100)->create()->each(function($blog){
            $blog->save();
        });
    }
}
