<x-master>
    @section('content')
    <h1>{{ $user->name }}'s profile page</h1>

    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('user.profile.update', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <img class="img-profile rounded-circle" height="150px" width="150px" src="{{$user->avatar}}">
                </div>
                <div class="form-group">
                    <input type="file" name="avatar">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    @if(auth()->user()->email == $user->email)
                    <input type="text" name="name" class="
                            form-control
                            @error('name') 
                                is-invalid 
                            @enderror
                            " id="name" aria-describedby="" value="{{$user->name}}">

                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    @else
                    <input disabled style="color:black" type="text" name="name" class="
                            form-control
                            @error('name') 
                                is-invalid 
                            @enderror
                            " id="name" aria-describedby="" value="{{$user->name}}">
                    @endif


                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    @if(auth()->user()->email == $user->email)
                    <input type="text" name="email" class="
                            form-control
                            @error('email') 
                                is-invalid 
                            @enderror
                        " id="email" aria-describedby="" value="{{$user->email}}">

                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    @else
                    <input disabled style="color:black" type="text" name="name" class="
                    form-control
                            @error('email') 
                                is-invalid 
                            @enderror
                        " id="email" aria-describedby="" value="{{$user->email}}">
                    @endif
                </div>
                @if(auth()->user()->email == $user->email)
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                @else
                <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                @endif
            </form>
        </div>
    </div>
    @endsection
</x-master>