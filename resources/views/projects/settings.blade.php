<x-master>
    @section('header')

    <style>
        .project-title {
            border-bottom: 1px solid #e3e6f0;
        }

        .table-container {
            width: 70%;
        }
    </style>
    @endsection
    @section('content')
    <div class="project-title d-sm-flex align-items-center justify-content-between mb-4 pb-3">
        <h1 class="h3 mb-0 text-gray-800">{{$project->title}}</h1>
    </div>

    <div class="row table-container">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Project Members</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role in Project</th>
                                    <th>Change role</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role in Project</th>
                                    <th>Change role</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($project->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->pivot->role}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btn btn-primary">Save changes</div>
    @endsection
</x-master>