@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <h1 class="card-title"> {{$post->title}} </h1>
            <address>
                @if ($post->category)
                    <span class="badge badge-info px-3"> {{ $post->category->name }}</span>
                @else
                    <span class="badge bg-warning text-dark">None</span>
                @endif
            </address>
            <address class="card-subtitle"> from <b>{{ $post->user->name }}</b> </address>
            <address class="card-subtitle date"> on {{ $post->getFormattedDate('post_date')}} </address>
            <div class="card-body row">
                <div class="col-4">
                    <img class="img-fluid" src="{{$post->image_url}}" alt="{{$post->title}} image">
                </div>
                <div class="col-8">
                    <p> {{$post->post_content}} </p>
                </div>
            </div>

            <div class="card-footer back-to-list d-flex justify-content-end">
                <a href="{{route('admin.posts.index')}}" class="btn btn-toolbar"><u>Go back to posts</u></a>
            </div>
            
        </div>
    </div>
@endsection