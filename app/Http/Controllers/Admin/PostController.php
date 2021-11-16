<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post = new Post();

        $categories = Category::all();

        return view('admin.posts.create', compact('post', 'request','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required|string|unique:posts|max:100',
            'author' => 'required|string|max:100',
            'post_content' => 'required|string',
            'image_url' => 'string',
            'category_id' => 'nullable|numeric'
        ],
        [
            'required' => 'You need to compile :attribute correctly',
            'title.required' => 'You mast insert a title',
            'author.max' => 'Author can have 100 char max',
            'post_content.min' => 'Post has to be a string'
        ]);
        
        
        $data = $request->all();

        $data['post_date'] = Carbon::now();

        $post = new Post();
        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Request $request)
    {
        $categories = Category::all();

        return view("admin.posts.edit", compact('post', 'request', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $data['post_date'] = Carbon::now();

        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->update();

        return redirect()->route('admin.posts.show', compact('post'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with("deleted_title", $post->title )->with('alert-message', "$post->title has been deleted!");
    }
}