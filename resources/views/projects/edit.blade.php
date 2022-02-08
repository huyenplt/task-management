<x-master>
    @section('content')
    <h1>Create new Project</h1>
    <form action="{{route('project.update', $project->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" aria-describedby="" class="form-control" value="{{ $project->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="10">
            {{ $project->description }}
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection
</x-master>