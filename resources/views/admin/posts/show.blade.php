@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-3">
            <h1 class="card-title"> {{$post->title}} </h1>
            <address class="card-subtitle"> from {{ $post->author }} </address>
            <address class="card-subtitle date"> on {{ $post->getFormattedDate('post_date')}} </address>
            <div class="card-body row">
                <div class="col-4">
                    <img class="img-fluid" src="{{$post->image_url}}" alt="{{$post->title}} image">
                </div>
                <div class="col-8">
                    <p class="card-body"> {{$post->post_content}} </p>
                </div>
            </div>

            <div class="card-footer back-to-list d-flex justify-content-end">
                <a href="{{route('admin.posts.index')}}" class="btn btn-toolbar"><u>Go back to posts</u></a>
            </div>
            
        </div>
    </div>
@endsection