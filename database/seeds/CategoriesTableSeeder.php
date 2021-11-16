<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creo manualmente i nomi delle categorie
        $categoryNames = ['HTML','CSS','JS','PHP','MySQL','VueJS','Laravel'];

        foreach($categoryNames as $name) {

            $category = new Category();

            $category->name = $name;
            $category->slug = Str::slug($name, '-');

            $category->save();

        }

    }
}
