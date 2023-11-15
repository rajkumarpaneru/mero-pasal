<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $categories = ['Women\'s Fashion', 'Health & Beauty', 'Men\'s Fashion', 'Watches & Accessories'];

        foreach ($categories as $index => $category) {
            Category::updateOrCreate([
                'name' => $category,
            ], [
                'rank' => $index + 1,
            ]);
        }
    }
}
