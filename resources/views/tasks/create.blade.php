<form action="{{route('task.store' , $board->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @error('title')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" aria-describedby="" class="form-control" placeholder="Enter title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="userInCharge">User in charge</label>
        <!-- <input type="text" name="tag" id="tag" aria-describedby="" class="form-control" placeholder="Enter tag"> -->
        <input type="text" name="userInCharge" id="userInCharge" aria-describedby="" class="form-control" placeholder="Enter user email">
    </div>
    <div class="form-group">
        <label for="tag">Tag</label>
        <!-- <input type="text" name="tag" id="tag" aria-describedby="" class="form-control" placeholder="Enter tag"> -->
        <div class="tag-input d-flex">
            <div class="tag-content">
                <input type="text" name="tag" id="tag" list="cityname" class="form-control" placeholder="Enter tag">
                <datalist id="cityname">
                    @foreach($tags as $tag)
                    <option value="{{$tag->content}}">
                        <!-- <option value="OuledSlama"> -->
                        @endforeach
                </datalist>
            </div>
            <div class="tag-color">
                <input type="text" name="colorTag" id="colorTag" class="form-control colorpicker" placeholder="Choose color tag">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Deadline:</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" name="deadline" id="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" />
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-primary" href="" data-dismiss="modal"> Cancel</a>
        <button type="submit" class="btn btn-primary" id="formSubmit">Submit</button>
    </div>

</form>
<!-- color picker -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>

<!-- date picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script type="text/javascript">
    


    $('.date').datepicker({
        format: 'dd-mm-yyyy'

    });

    $('.colorpicker').colorpicker();

    // $('.date').css('z-index','1600');
    //     $('#reservationdate').datetimepicker({
    //     format: 'L'
    // });
</script>