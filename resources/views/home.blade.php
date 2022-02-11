<x-master>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

            </div>
            <p>
                {{count(auth()->user()->projects)}}
            </p>
            <p>
                {{count(auth()->user()->tasks)}}
            </p>
        </div>
    </div>
</div>
@endsection
</x-master>
