<x-master>
    @section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <span style="font-size:60px; margin-bottom: 30px; margin-top: 50px; color:black;">Let us have a wonderful working day</span>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 ">
                <div class="card card-row card-default" style="height:200px">
                    <div class="card-header d-flex justify-content-center text-white" style="font-size:35px; background: #D9A40C"><span>Total Projects</span></div>
                    <div class="card-body d-flex justify-content-center text-white" style="font-size:30px; align-items: center; background: #FFC106">{{count(auth()->user()->projects)}}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-row card-default" style="height:200px">
                    <div class="card-header d-flex justify-content-center text-white" style="font-size:35px; background: #BC2D3A">Total Tasks</div>
                    <div class="card-body d-flex justify-content-center text-white" style="font-size:30px; align-items: center; background: #DC3444">{{count(auth()->user()->tasks)}}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-row" style="height:200px">
                    <div class="card-header d-flex justify-content-center text-white" style="font-size:35px; background: #268E3B">Task Done</div>
                    <div class="card-body d-flex justify-content-center text-white" style="font-size:30px; align-items: center; background: #28A744">{{ auth()->user()->countTaskDone() }}</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="row" style="justify-content: space-between;">
                <div class="col-3 ">
                    <form action="{{route('project.index')}}">
                        <div class="card card-row card-default" style="height:200px; border:none; background:#F8F9FC">
                            <button class="btn btn-info" style="width:300px; margin-left:-100px; margin-top:60px">VIEW ALL YOUR PROJECT</button>
                        </div>
                    </form>

                </div>
                <div class="col-3 ">
                    <form action="{{route('task.showall')}}">
                        <div class="card card-row card-default" style="height:200px; border:none; background:#F8F9FC">
                            <button class="btn btn-info" style="width:300px; margin-right:360px;  margin-top:60px">VIEW ALL YOUR TASK</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection
</x-master>