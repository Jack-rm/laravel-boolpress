<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Post;
use App\User;
use App\Models\Category;

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

        $user_ids = User::pluck('id')->toArray();

        $category_ids = Category::pluck('id')->toArray();


        for ($i = 0 ; $i < 20 ; $i++){

            $newPost = new Post();
            
            $newPost->title = $faker->sentence(4);
            //$newPost->author = $faker->name();
            
            $newPost->user_id = Arr::random($user_ids);
            
            $newPost->post_date = $faker->dateTime();
            $newPost->post_content = $faker->paragraphs(6, true);
            $newPost->image_url = $faker->imageUrl(640, 480, $newPost->title , true, $newPost->author);

            $newPost->category_id = Arr::random($category_ids);

            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->save();
        }
    }
}
