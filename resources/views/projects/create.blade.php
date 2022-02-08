<x-master>
    @section('content')
        <h1>Create new Project</h1>
        <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input 
                type="text" 
                name="title" 
                id="title"
                aria-describedby=""
                class="form-control"
                placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input 
                type="file" 
                name="post_image" 
                id="post_image"
                class="form-control">
        </div>
        <div class="form-group">
            <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection
</x-master>