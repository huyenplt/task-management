<x-master>
    @section('content')
    <h1>Projects</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between mb-4">
            <h6 class="m-0 font-weight-bold text-primary">All your projects</h6>
            <a href="{{route('project.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                <span>Add new project</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Role on Project</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{$project->title}}</td>
                            <td>{{$project->description}}</td>
                            <td>{{$project->pivot->role}}</td>
                            <td>{{$project->created_at->diffForHumans()}}</td>
                            <td>{{$project->updated_at->diffForHumans()}}</td>
                            <td class="d-flex">
                                <a href="{{route('project.show', $project->id)}}" class="btn btn-primary mr-2">
                                <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('project.edit', $project->id)}}" class="btn btn-success mr-2">
                                <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{route('project.destroy', $project->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mr-2">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="{{route('project.settings', $project->id)}}" class="btn btn-primary">
                                <i class="fas fa-users"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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