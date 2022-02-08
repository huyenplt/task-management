<x-master>
    @section('header')
    <style>
        .board-item {
            max-width: 30%;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
        }

        .card-title {
            margin-bottom: 0;
        }

        .fa-pen {
            color: #1cc88a;
        }

        .fa-trash-alt {
            color: red;
        }

        .board-action .btn {
            background: white;
        }

        .task-tag button {
            border: none;
            border-radius: 3px;
        }

        .task-tag {
            margin-bottom: 10px;
        }

        .task-tag .col {
            max-width: 25%;
            /* margin-right: 5px; */
        }
    </style>
    @endsection
    @section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$project->title}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            <span>Add new board</span>
        </a>
    </div>
    <div class="row">
        @foreach($project->boards as $board)
        <div class="col board-item">
            <div class="card card-row card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">{{$board->title}}</h3>
                </div>
                <div class="card-body">
                    @foreach($board->tasks as $task)
                    <div class="card card-light card-outline">
                        <div class="card-header">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row task-tag">
                                    @foreach($task->tags as $tag) 
                                        <div class="col">
                                            <button style="background-color: {{$tag->color}}; font-size:12px" type="button">{{ $tag->content }}</button>
                                        </div>
                                    @endforeach
                            </div>
                            <p>{{ $task->description }}</p>
                            <div class="user-in-charge">
                                @foreach($task->users as $user)
                                <a 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="{{$user->name}}" 
                                    href="{{route('user.profile.show', $user)}}"
                                    >
                                        <img style="width: 30px; height:30px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection
</x-master>