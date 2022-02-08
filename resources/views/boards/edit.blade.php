<form action="{{route('board.update', $board->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" aria-describedby="" class="form-control" value="{{$board->title}}">
    </div>

    <div class="text-center">
        <a class="btn btn-primary" href="" data-dismiss="modal"> Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>