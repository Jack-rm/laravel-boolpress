<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Category;
use App\User;
use App\Models\Tag;


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
        $tags = Tag::all();
        $tagIds = $post->tags->pluck('id')->toArray();

        return view('admin.posts.create', compact('post', 'request','categories','tags', 'tagIds'));
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
            'post_content' => 'required|string',
            'image_url' => 'string',
            'category_id' => 'nullable|numeric'
        ],
        [
            'required' => 'You need to compile :attribute correctly',
            'title.required' => 'Title cannot be empty',
            'post_content.min' => 'Post has to be a string'
        ]);
        
        
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        $data['post_date'] = Carbon::now();

        $post = new Post();
        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->save();

        // Dopo la save poichè è necessario che esista il post prima
        if (array_key_exists('tags', $data))
            $post->tags()->sync($data['tags']);  // in questo caso ogni id ha tot tags quindi tags è un array
        // Scelgo sync per ottimizzazione invece di Attach() e Deatch()
        // Sync mi permette di avere nell'array solo gli elementi di data, eliminando i non richiesti ogni volta.

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
        $users = User::all();
        $tags = Tag::all();

        // Processo di logica la cui necessità è nata nel view ma che è giusto sia nel controller
        // Prendo la lista degli id dei tag per il singolo post esprimendola in array
        $tagIds = $post->tags->pluck('id')->toArray();

        return view("admin.posts.edit", compact('post', 'request', 'categories','users', 'tags', 'tagIds'));
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
        $request->validate([

            'title' => 'required|string|unique:posts|max:100',
            'post_content' => 'required|string',
            'image_url' => 'string',
            'category_id' => 'nullable|numeric'
        ],
        [
            'required' => 'You need to compile :attribute correctly',
            'title.required' => 'Title cannot be empty',
            'post_content.min' => 'Post has to be a string'
        ]);

        $data = $request->all();

        $data['post_date'] = Carbon::now();

        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');
        $post->update();


        //Esattamente come in store implemento la linea di codice dopo la chiamata update()

        if (array_key_exists('tags', $data))
            $post->tags()->sync($data['tags']);

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