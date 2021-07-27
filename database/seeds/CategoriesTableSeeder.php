<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Tech",
            "Music",
            "Fashion",
            "Travel",
            "Network",
            "Gaming",
            "Food",
            "Movie"
        ];

        
        foreach($categories as $category) {

            $newCategory = new Category();

            $newCategory->name = $category;
            $newCategory->slug = Str::slug($newCategory->name, '-');

            $newCategory->save();
        }
    }
}
