

    <form action="{{route('task.store' , $board->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" aria-describedby="" class="form-control" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input type="text" name="tag" id="tag" aria-describedby="" class="form-control" placeholder="Enter tag">
        </div>

        <div class="form-group">
        <label>Deadline:</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
        <div class="text-center">
            <a class="btn btn-primary" href="" data-dismiss="modal"> Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <script type="text/javascript">
        $('.date').datepicker({
            format: 'mm-dd-yyyy'
            
        });
    
        // $('.date').css('z-index','1600');
    //     $('#reservationdate').datetimepicker({
    //     format: 'L'
    // });
        
    </script>