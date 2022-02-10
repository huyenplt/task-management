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
    <div class="row deadline task-details-item">
        <label class="col-3">Deadline:</label>
        <div class="col-7">
            {{$task->deadline->format('M d, Y')}}
        </div>
    </div>
    @endif
</div>