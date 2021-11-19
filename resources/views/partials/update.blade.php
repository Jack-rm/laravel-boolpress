<div class="container">
    <div class="card p-5">
        <header class="pb-4">
            <h1>{{ $request->routeIs('admin.posts.edit') ? "Edit $post->title" : "Create New Post" }}</h1>
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

            <form action="{{  $request->routeIs('admin.posts.edit') ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST">
            
            @if($request->routeIs('admin.posts.edit')) 
            
                @method('PATCH')
            
            @endif

            @csrf
                <div class="form-group">
                    <label for="title" class="form-label text-danger">Title</label>
                    <input class="form-control form-control-lg" type="text" id="title" name="title" placeholder="Title" value="{{ old('title', $post->title) }}">
                </div>
    
                <div class="form-group">
                    <label for="category_id" class="form-label text-danger">Category </label>
                    <br>
                    <select name="category_id" id="category_Id">
                        <option value="">None</option>  <!-- Devo lasciare value="" altrimenti non potrei assegnare valore nullo alla category-->
                        
                        @foreach ($categories as $category)
                            <option

                            @if (old('category_id') == $category->id)
                             selected
                            @endif
                            
                            value="{{ $category->id }}"
                            {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label text-danger h">Tags</label>
                    <br>
                    <div class="form-check form-check-inline">    

                        @foreach ($tags as $tag)
                            <input type="checkbox" class="form-check-input mx-2" id="tag-{{ $tag->id }}"
                            value="{{ $tag->id }}" name="tags[]"
                            
                            @if ( in_array( $tag->id, old("tags", $tagIds ? $tagIds : [] )) )
                             checked
                            @endif >
                            
                            <label class="form-check-label me-2" for="tag-{{$tag->id}}">{{$tag->name}}</label>    
                        @endforeach
                    </div>
                </div>

                @if($request->routeIs('admin.posts.edit')) 

                <div class="form-group">
                    <label for="user_id" class="form-label text-danger">Author </label>
                    <br>
                    <select name="user_id" id="user_id">
                        
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                            {{ $user->id == $post->user_id ? 'selected' : '' }}> {{ $user->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
        
                @endif

    
                <div class="form-group">
                    <label for="post_content" class="form-label text-danger">Content</label>
                    <input class="form-control" type="text" id="post_content" name="post_content" placeholder="Post Content" required value="{{ old('post_content', $post->post_content) }}">
                </div>
    
                <div class="form-group">
                    <label for="image_url" class="form-label text-danger">Image</label>
                    <input class="form-control" type="text" id="image_url" name="image_url" placeholder="URL Image" required value="{{ old('image_url', $post->image_url) }}">
                </div>
    
                <div class="card-footer mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-danger">{{ $request->routeIs('admin.posts.edit') ? "Edit $post->title" : "Create" }}</button>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-toolbar"><u>Go back to Posts</u></a>
                </div>
            </form>
        </section>
    </div>

</div>