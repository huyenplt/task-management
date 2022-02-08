<x-master>
    @section('header')
    <style>
        .board-item {}

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

        .board-action {
            display: flex;
        }

        .board-action .btn {
            background: white;
            margin-left: 3px;
        }

        .task-tag button {
            border: none;
            border-radius: 3px;
        }

        .task-tag {
            margin-bottom: 10px;
        }

        .task-tag .col {
            /* margin-right: 5px; */
        }

        .card-footer {
            background-color: #fff;
            border-top: none;
            display: flex;
        }

        .project-title {
            border-bottom: 1px solid #e3e6f0;
        }
    </style>
    @endsection
    @section('content')
    <div class="project-title d-sm-flex align-items-center justify-content-between mb-4 pb-3">
        <h1 class="h3 mb-0 text-gray-800">{{$project->title}}</h1>
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#add-board-modal">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            <span class="text-white">Add new board</span>
        </a>
    </div>
    <div class="row">
        @foreach($project->boards as $board)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 board-item">
            <div class="card card-row card-default">
                <div class="card-header bg-info">
                    <div class="board-title">
                        <h5 class="card-title">{{$board->title}}</h5>
                    </div>
                    <div class="card-tools board-action">
                        <div class="board-edit">
                            <a href="" class="btn btn-tool" data-bs-toggle="modal" data-bs-target="#edit-board-modal">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>

                        <form action="{{route('board.destroy', $board->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>
                    </div>
                </div>
                <div class="card-body pb-1">
                    @foreach($board->tasks as $task)
                    <div class="card card-light card-outline mb-3">

                        <div class="card-body">
                            <div class="row task-tag">
                                @foreach($task->tags as $tag)
                                <div class="col">
                                    <button style="background-color: {{$tag->color}}; font-size:12px" type="button">{{ $tag->content }}</button>
                                </div>
                                @endforeach
                            </div>
                            <p>{{ $task->title }}</p>
                            <div class="user-in-charge">
                                @foreach($task->users as $user)
                                <a data-toggle="tooltip" data-placement="top" title="{{$user->name}}" href="{{route('user.profile.show', $user)}}">
                                    <img style="width: 30px; height:30px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-center ">
                    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        <span>Add new task</span>
                    </a>
                </div>
            </div>

            <!-- edit board form modal -->
    <div class="modal fade" id="edit-board-modal" tabindex="-1" aria-labelledby="editBoardModalLabel" aria-hidden="true">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBoardModalLabel">Edit board "{{$board->title}}"</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" aria-describedby="" class="form-control" value="{{$board->title}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
        </div>
        @endforeach
    </div>
    <!-- create board form modal -->
    <div class="modal fade" id="add-board-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('board.store', $project->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new board</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" aria-describedby="" class="form-control" placeholder="Enter title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @endsection
</x-master>