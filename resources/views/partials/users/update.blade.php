<div class="container">
    <div class="card p-5">
        <header class="pb-4">
            <h1>{{ $request->routeIs('admin.users.edit') ? "Edit $user->name" : "Create New User" }}</h1>
        </header>
        
        <section id="post-form">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{  $request->routeIs('admin.users.edit') ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST">
            
            @if($request->routeIs('admin.users.edit')) 
            
                @method('PATCH')
            
            @endif

            @csrf
                <div class="form-group">
                    <label for="name" class="form-label text-danger">Name</label>
                    <input class="form-control form-control-lg" type="text" id="name" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label class="form-label text-danger h">Roles</label>
                    <br>
                    <div class="form-check form-check-inline">    

                        @foreach ($roles as $role)
                            <input type="checkbox" class="form-check-input mx-2" id="role-{{ $role->id }}"
                            value="{{ $role->id }}" name="roles[]"
                            
                            @if ( in_array( $role->id, old("roless", $roleIds ? $roleIds : [] )) )
                             checked
                            @endif >
                            
                            <label class="form-check-label me-2" for="role-{{$role->id}}">{{$role->name}}</label>    
                        @endforeach
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="email" class="form-label text-danger">Email</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" required value="{{ old('email', $user->email) }}">
                </div>
    
                <div class="form-group">
                    <label for="password" class="form-label text-danger">Password</label>
                    <input class="form-control" type="text" id="password" name="password" placeholder="Password" required value="{{ old('password', $user->password) }}">
                </div>
    
    
                <div class="card-footer mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-danger">{{ $request->routeIs('admin.users.edit') ? "Edit $user->name" : "Create" }}</button>
                    <a href="{{route('admin.users.index')}}" class="btn btn-toolbar"><u>Go back to Users</u></a>
                </div>
            </form>
        </section>
    </div>

</div>