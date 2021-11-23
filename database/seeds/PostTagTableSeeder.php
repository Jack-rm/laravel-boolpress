<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Post;
use App\Models\Tag;


class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $posts = Post::all();
        $tag_ids = Tag::pluck('id')->toArray();

        foreach ($posts as $post){

            $post->tags()->sync([
                Arr::random($tag_ids), Arr::random($tag_ids), Arr::random($tag_ids)
            ]);
        }
    }
}
