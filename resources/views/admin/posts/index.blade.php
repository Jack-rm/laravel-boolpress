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
        
        <table class="table table-bordered">
            <thead>
                <th class="col">Title</th>
                <th class="col">Author</th>
                <th class="col">Date</th>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td><a class="text-danger" href="{{ route('admin.posts.show', $post->id ) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->author}}</td>
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
        

    </div>
@endsection