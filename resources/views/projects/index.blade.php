<x-master>
    @section('content')
    <h1>Projects</h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All your projects</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Role on Project</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Role on Project</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{$project->id}}</td>
                            <td>{{$project->title}}</td>
                            <td>{{$project->description}}</td>
                            <td>{{$project->pivot->role}}</td>
                            <td>{{$project->created_at->diffForHumans()}}</td>
                            <td>{{$project->updated_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('project.show', $project->id)}}" class="btn btn-primary">Show</a>
                                <form action="{{route('project.destroy', $project->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach(auth()->user()->projects as $hi)
            <h1>{{$hi->pivot->role}}</h1>
        @endforeach
        <div class="d-flex">
            <div class="mx-auto">
                {{$projects->links('pagination::bootstrap-4')}}
            </div>
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