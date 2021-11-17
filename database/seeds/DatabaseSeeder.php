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
        $this->call([
            
            // E' importante scriverli come array e con un ordine che segua la logica delle relazioni tra le varie tabelle
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CategoriesTableSeeder::class,
        ]);
    }
}
