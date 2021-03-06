<x-master>
    @section('header')

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"> -->

    <!-- Font Awesome JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->

    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


    <style>
        .board-item {}

        .card-header {
            display: flex;
            justify-content: space-between;
        }

        .card-title {
            margin-bottom: 0;
        }

        /* .fa-pen {
            color: #1cc88a;
        }

        .fa-trash-alt {
            color: red;
        } */

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

        .view-task-details-btn {
            justify-content: space-between;
        }

        .task-deadline span {
            font-size: 12px;
        }

        .add-task-btn {
            width: 100%;
        }

        .task-checkbox {
            justify-content: space-between;
        }
    </style>
    @endsection
    @section('content')
    <div class="project-title d-sm-flex align-items-center justify-content-between mb-4 pb-3">
        <h1 class="h3 mb-0 text-gray-800">{{$project->title}}</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#add-board-modal">
            <i class="fas fa-plus fa-sm text-white-50"></i>
            <span>Add new board</span>
        </button>
    </div>

    @if (session('message-not-user'))
        <div class="alert alert-danger">
            {{ session('message-not-user') }}
        </div>
    @endif

    @if (session('task-create-success'))
        <div class="alert alert-success">
            {{ session('task-create-success') }}
        </div>
    @endif


    <div class="row">
        @foreach($project->boards as $board)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4 board-item">
            <div class="card card-row card-default">
                <div class="card-header bg-secondary bg-gradient">
                    <div class="board-title">
                        <h5 class="card-title text-white fw">{{$board->title}}({{count($board->tasks)}})</h5>
                    </div>
                    @if($project->getOwner()->email == auth()->user()->email )
                    <div class="card-tools board-action">
                        <div class="board-edit">
                            <button class="btn btn-sm btn-tool" data-bs-toggle="modal" id="edit-board-btn" data-bs-target="#edit-board-modal" data-attr="{{ route('board.edit', $board->id) }}">
                                <i class="fas fa-sm fa-pen"></i>
                            </button>
                        </div>

                        <form action="{{route('board.destroy', $board->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-tool btn-sm">
                                <i class="fas fa-sm fa-trash-alt bg-default"></i>
                            </button>
                        </form>
                    </div>
                    @endif
                    
                    
                </div>
                <div class="card-body pb-1">
                    @foreach($board->tasks->sortBy('order') as $task)
                    <div class="card card-light card-outline mb-3">
                        <div class="card-body">
                            <div class="d-flex task-tag">
                                @foreach($task->tags as $tag)
                                <button class="mr-1" style="background-color: {{$tag->color}}; font-size:12px; color:white" type="button">{{ $tag->content }}</button>
                                @endforeach
                            </div>
                            <div>
                                <div class="d-flex task-checkbox">
                                    @if($task->status == 1)
                                    <h5 style="text-decoration: line-through" class="task-title text-gray-800">{{ $task->title }}</h5>
                                    @else
                                    <h5 class="task-title text-gray-800">{{ $task->title }}</h5>
                                    @endif
                        <form action="{{route('task.statusUpdate', $task->id)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PATCH')                    @if($task->status == 0)
                                    <button class="btn btn-success btn-sm" type="submit">
                                        CHECK DONE
                                    </button>
                                    @endif

                        </form>

                                </div>
                            </div>
                            <div class="user-in-charge mb-2">
                                @foreach($task->users as $user)
                                <a data-toggle="tooltip" data-placement="top" title="{{$user->name}}" href="{{route('user.profile.show', $user)}}">
                                    <img style="width: 30px; height:30px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                                </a>
                                @endforeach
                                <a href="" data-toggle="tooltip" data-placement="top" title="Add User In Charge"></a>
                            </div>
                            <div class="d-flex view-task-details-btn">
                                <div class="task-deadline">
                                    @if($task->deadline)
                                    <i class="fas fa-sm fa-calendar-alt"></i>
                                    <span>{{ $task->deadline->format('M d, Y') }}</span>
                                    @endif
                                </div>
                                <div class="task-action d-flex">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('task.edit', $task->id) }}">Edit Task</a></li>
                                            <li>
                                                <form action="{{route('task.destroy', $task->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item">Delete Task</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <button class="btn btn-sm btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="view-task-btn" data-attr="{{ route('task.index', $task->id) }}">
                                        <span class="text-sm">View more</span>
                                        <i class="fas fa-sm fa-arrow-right"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-center ">
                    <button class="add-task-btn d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" id="create-task-btn" data-bs-target="#create-task-modal" data-attr="{{ route('task.create', $board->id) }}">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        <span>Add new task</span>
                    </button>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- off canvas - task view details -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" role="document" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Task details</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="task-view">
            <!-- task view here -->
        </div>
    </div>
    <!-- modal -->
    <!-- create task form modal -->
    <div class="modal fade" id="create-task-modal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Create new task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="create-task-form">
                    <!-- create task go here -->
                </div>

                <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div> -->
            </div>
        </div>
    </div>

    <!-- edit task form modal -->
    <div class="modal fade" id="edit-task-modal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Create new task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit-task-form">
                    <!-- create task go here -->
                </div>

                <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div> -->
            </div>
        </div>
    </div>

    <!-- edit board form modal -->
    <div class="modal fade" id="edit-board-modal" tabindex="-1" role="dialog" aria-labelledby="editBoardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBoardModalLabel">Edit board</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit-board-form">
                    <!-- result go here -->
                </div>

                <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div> -->
            </div>
        </div>
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


    <!-- <script type="text/javascript">
        $('.date').datepicker({
            format: 'mm-dd-yyyy'
        });

        $(document).ready(function () {
            $('.date').datepicker({
                format: "yyyy-mm-dd"
            });  

        });
    </script> -->

    @endsection

    @section('scripts')


    <script>
        // display tasks.create view
        $(document).on('click', '#create-task-btn', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#create-task-modal').modal("show");
                    $('#create-task-form').html(result).show();

                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    }
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // display tasks.edit view
        $(document).on('click', '#edit-task-btn', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#edit-task-modal').modal("show");
                    $('#edit-task-form').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        //         $('#create-task-modal').on('shown.bs.modal', function (e) {
        //      $('.date').datepicker();
        //      $('.date').css('z-index','1600');
        // });

        // display board.edit view
        $(document).on('click', '#edit-board-btn', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#edit-board-modal').modal("show");
                    $('#edit-board-form').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        $(document).on('click', '#view-task-btn', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    // $('#offcanvasRight').modal("show");
                    $('#task-view').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
    @endsection
</x-master>