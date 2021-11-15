<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0 ; $i < 20 ; $i++){

            $newPost = new Post();
            
            $newPost->title = $faker->sentence(4);
            $newPost->author = $faker->name();
            $newPost->post_date = $faker->dateTime();
            $newPost->post_content = $faker->paragraphs(6, true);
            $newPost->image_url = $faker->imageUrl(640, 480, $newPost->title , true, $newPost->author);

            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->save();
        }
    }
}
