<div class="text-black task-details">
    <h3> {{$task->title}} </h3>
    <div class="row desc task-details-item">
        <label class="col-3 text-black" for="description">Description:</label>
        <span class="col-7">{{ $task->description }}</span>
    </div>
    <div class="row person-in-charge task-details-item">
        <label class="col-3" for="">Users in charge:</label>
        <div class="col-7">
            @foreach($task->users as $user)
            <a data-toggle="tooltip" data-placement="top" title="{{$user->name}}" href="{{route('user.profile.show', $user)}}">
                <img style="width: 30px; height:30px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                {{$user->name}}</br>
            </a>
            @endforeach
        </div>
    </div>
    <div class="row tags task-details-item">
        <label class="col-3" for="">Tags:</label>
        <div class="col-7 text-gray-dark">
            @foreach($task->tags as $tag)
                {{$tag->content}},
            @endforeach
        </div>
    </div>
    @if($task->deadline)
    {{$task->deadline->format('Y.m.d')}}
    @endif
</div>

<div class="form-group">
        <label>Date:</label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->

    <script type="text/javascript">
        

        $('#reservationdate').datetimepicker({
        format: 'L'
    });
    </script>