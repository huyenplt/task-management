<x-master>
    @section('content')
        <h1>{{ $user->name }}</h1>

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
                    <input 
                        type="text" 
                        name="name" 
                        class="
                            form-control
                            @error('name') 
                                is-invalid 
                            @enderror
                            " 
                        id="name" 
                        aria-describedby=""
                        value="{{$user->name}}">

                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="text" 
                        name="email" 
                        class="
                            form-control
                            @error('email') 
                                is-invalid 
                            @enderror
                        " 
                        id="email" 
                        aria-describedby=""
                        value="{{$user->email}}"
                    >

                    @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="
                            form-control
                            @error('password') 
                                is-invalid 
                            @enderror
                        " 
                        id="password" 
                        aria-describedby="">
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Comfirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="form-control" 
                        id="password_confirmation" 
                        aria-describedby="">
                </div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
    </div>
    @endsection
</x-master>