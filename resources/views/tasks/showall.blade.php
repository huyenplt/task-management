<x-master>
@section('header')
    <style>
        .task-tag button {
            border: none;
            border-radius: 3px;
        }

        .task-tag {
            margin-bottom: 10px;
            f
        }
    </style>
    @endsection
    @section('content')
    <h1>Tasks</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">All your tasks</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Project name</th>
                            <th>Deadline</th>
                            <th>Tag</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->title}}</td>
                            <td>{{$task->description}}</td>
                            <td>
                                @if($task->deadline)
                                {{$task->deadline->format('M d, Y')}}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex task-tag">
                                    @foreach($task->tags as $tag)
                                    <a href="">
                                        <button class="mr-1" style="background-color: {{$tag->color}}; font-size:15px; color: white" type="button">{{ $tag->content }}</button>
                                    </a>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @if($task->status == 1) 
                                    <div class="btn btn-success btn-sm">
                                        DONE
                                    </div>
                                @else
                                    <div class="btn btn-warning btn-sm">
                                        IN PROGRESS
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex">

        </div>
    </div>

    @endsection

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{asset('js/datatables-scripts.js')}}"></script> -->
    @endsection
</x-master>