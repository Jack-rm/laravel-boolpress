@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-3">
            <h1 class="card-title"> {{$post->title}} </h1>
            <address class="card-subtitle"> from {{ $post->author }} </address>
            <address class="card-subtitle date"> on {{ $post->getFormattedDate('post_date')}} </address>

            <p class="card-body"> {{$post->post_content}} </p>
            <div class="card-footer back-to-list">
                <a href="{{route('admin.posts.index')}}" class="btn btn-toolbar">Torna alla lista dei post</a>
            </div>
            
        </div>
    </div>
@endsection