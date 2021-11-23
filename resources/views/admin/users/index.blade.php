@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session("deleted_title"))
            <div class="alert alert-warning">
                {{session('alert-message')}}
            </div>
        @endif

        <header class="p-3 d-flex justify-content-between align-items-center">
            <h1>Users</h1>
            <a class="text-danger" href="{{route('admin.users.create')}}">New User</a>
        </header>

        <table class="table table-bordered table-fit">
            <thead>
                <th class="col-1">ID</th>
                <th class="col-3">Name</th>
                <th class="col-3">Email</th>
                <th class="col-3">Roles</th>
            </thead>
            <tbody>
                @forelse ($users as $user)

                    <tr>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id ) }}">{{ $user->id}}</a>
                        </td>       
                        <td>
                            <a href="{{ route('admin.users.show', $user->id ) }}">{{ $user->name}}</a>
                        </td>
                        <td>{{ $user->email}}</td>
                        <td>
                            @forelse ($user->roles as $role)
                                
                                <span class="bagde badge-pill text-light" style="background-color: {{ $role->color }} ">{{$role->name}}</span>
                            @empty
                                <span class="badge bg-warning text-dark">No Roles</span>
                            @endforelse
                        </td>
                        <td><a href="{{ route('admin.users.edit', $user ) }}" class="btn-sm btn-secondary">Edit</a></td>
                        <td>
                            <form action="{{route('admin.users.destroy', $user->id )}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn-sm btn-danger" type="submit">Delete</a>
                            </form>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3">No users available</td>
                    </tr>

                @endforelse
            </tbody>
        </table>

    </div>
@endsection