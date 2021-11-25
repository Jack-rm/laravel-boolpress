@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <div class="card-header">
                <h2>Dear <span class="text-danger"> {{ session('lead')}}</span>, we appreciate you contacting us!</h2>
                <h3>One of our colleagues will get back in touch with you soon! Have a great day!</h3>
            </div>
        </div>
    </div>
@endsection