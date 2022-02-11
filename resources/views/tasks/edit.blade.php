<x-master>
    @section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- color picker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>

    <!-- date picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <style>
        .task-tag button {
            border: none;
            border-radius: 3px;
        }

        .task-tag {
            margin-bottom: 10px;
        }
    </style>
    @endsection

    @section('content')
    <h1>Edit Task</h1>
    <form action="{{route('task.update', $task->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" aria-describedby="" class="
            form-control
            @error('title') 
                is-invalid 
            @enderror
            " value="{{$task->title}}">
        @error('title')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{$task->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="userInCharge">User in charge</label>
            <div>
                @foreach($task->users as $user)

                <a data-toggle="tooltip" data-placement="top" title="{{$user->name}}" href="{{route('user.profile.show', $user)}}">
                    <img style="width: 30px; height:30px" class="img-profile rounded-circle mr-15" src="{{$user->avatar}}">
                    {{$user->name}}
                </a>
                @endforeach
            </div>

        </div>

        <div class="form-group">
            <label for="tag">Tag</label>
            <!-- <input type="text" name="tag" id="tag" aria-describedby="" class="form-control" placeholder="Enter tag"> -->
            <div class="cur-tag">
                <div class="d-flex task-tag">
                    @foreach($task->tags as $tag)
                    <a href="{{route('tag.destroy', $tag->id)}}">
                        <button class="mr-1" style="background-color: {{$tag->color}}; font-size:12px" type="button">{{ $tag->content }}</button>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="form-group">
            <label>Deadline:</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                @if($task->deadline)
                <input type="text" name="deadline" id="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{$task->deadline->format('d-m-y')}}" />
                @else
                <input type="text" name="deadline" id="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" />
                @endif
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        @csrf
        @method('PATCH')
        <div class="text-center">
            <a class="btn btn-primary" href="{{url()->previous()}}" data-dismiss="modal"> Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>



    @endsection

    @section('scripts')
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'dd-mm-yyyy'
        });

        $('.colorpicker').colorpicker();
    </script>
    @endsection

</x-master>