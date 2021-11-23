@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session("deleted_title"))
            <div class="alert alert-warning">
                {{session('alert-message')}}
            </div>
        @endif

        <header class="p-3 d-flex justify-content-between align-items-center">
            <h1>My Posts</h1>
            <a class="text-danger" href="{{route('admin.posts.create')}}">New Post</a>
        </header>
        
        <table class="table table-bordered table-fit">
            <thead>
                <th class="col">Title</th>
                <th class="col">Category</th>
                <th class="col">Tags</th>
                <th class="col">Author</th>
                <th class="col">Date</th>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td><a class="text-danger" href="{{ route('admin.posts.show', $post->id ) }}">{{ $post->title }}</a></td>
                        
                        <td>
                            @if ($post->category)
                            <span class="badge bg-info">{{ $post->category->name }}</span>
                            @else
                            <span class="badge bg-warning text-dark">None</span>
                            @endif
                        </td>

                        <td>
                            @forelse ($post->tags as $tag)
                            
                                <span class="bagde badge-pill text-light" style="background-color: {{ $tag->color}} ">{{ $tag->name }}</span>
                            @empty
                                <span class="badge bg-warning text-dark">No Tags</span>
                            @endforelse
                        </td>
                            

                        <td>{{ $post->user->name}}</td> <!-- Richiamo il nome del singolo user per via del collegamento one to one -->

                        <td>{{ $post->getFormattedDate('post_date')}}</td>
                        <td><a href="{{ route('admin.posts.edit', $post ) }}" class="btn btn-secondary">Edit</a></td>
                        <td>
                            <form action="{{route('admin.posts.destroy', $post->id )}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" type="submit">Delete</a>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No posts available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <footer>
            <div class="d-flex flex-row-reverse pt-2">
                {{ $posts->links() }}
            </div>
        </footer>

    </div>
@endsection