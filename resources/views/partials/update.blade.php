<div class="container">
    <div class="card p-5">
        <header class="pb-4">
            <h1>{{ $request->routeIs('admin.posts.edit') ? "Edit $post->title" : "Create New Post" }}</h1>
        </header>
    
        <section id="post-form">
            <form action="{{  $request->routeIs('admin.posts.edit') ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST">
            
            @if($request->routeIs('admin.posts.edit')) 
            
                @method('PATCH')
            
            @endif
        
            @csrf
                <div class="form-group">
                    <label for="title" class="form-label text-danger">Title</label>
                    <input class="form-control form-control-lg" type="text" id="title" name="title" placeholder="Title" value="{{ $post->title }}">
                </div>
    
                <div class="form-group">
                    <label for="category_id" class="form-label text-danger">Category </label>
                    <br>
                    <select name="category_id" id="category_Id">
                        <option value="">None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="author" class="form-label text-danger">Author</label>
                    <input class="form-control" type="text" id="author" name="author" placeholder="Author" value="{{ $post->author }}">
                </div>

    
                <div class="form-group">
                    <label for="post_content" class="form-label text-danger">Content</label>
                    <input class="form-control" type="text" id="post_content" name="post_content" placeholder="Post Content" required value="{{ $post->post_content }}">
                </div>
    
                <div class="form-group">
                    <label for="image_url" class="form-label text-danger">Image</label>
                    <input class="form-control" type="text" id="image_url" name="image_url" placeholder="URL Image" required value="{{ $post->image_url }}">
                </div>
    
                <div class="card-footer mt-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-danger">{{ $request->routeIs('admin.posts.edit') ? "Edit $post->title" : "Create" }}</button>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-toolbar"><u>Go back to Posts</u></a>
                </div>
            </form>
        </section>
    </div>

</div>