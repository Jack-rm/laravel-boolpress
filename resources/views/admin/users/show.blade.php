@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-5">
            <h1 class="card-title text-danger"> {{$user->name}} </h1>
            <address>
                @forelse ($user->roles as $role)
                    <span class="bagde badge-pill text-light" style="background-color: {{ $role->color}} ">{{ $role->name }}</span>
                @empty
                    <span class="badge bg-warning text-dark">No Roles</span>
                @endforelse
            </address>
            <address class="card-subtitle pb-3"><b>{{ $user->email }}</b> </address>

            <div class="card-footer back-to-list d-flex justify-content-end">
                <a href="{{route('admin.users.index')}}" class="btn btn-toolbar"><u>Go back to users</u></a>
            </div>
            
        </div>
    </div>
@endsection