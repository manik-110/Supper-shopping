@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Edit profile information </h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>

                @endif
                <form action="{{ route('update.profile') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" name="name" class="form-label">Name</label>
                        <input type="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
                         </div>
                         <div class="mb-3">
                            <label for="email"name="email" class="form-label">email </label>
                            <input type="email" name="email" class="form-control" value="{{{ Auth::user()->email }}}">
                             </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!--password-->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Password update </h2>
            </div>
            <div class="card-body">
                @if (session('pass_success'))
                <div class="alert alert-success">{{ session('pass_success') }}</div>
                @endif
                <form action="{{ route('update.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Current password</label>
                        <input type="password" name="Current_password" class="form-control">
                        @error('Current_password')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        {{-- @if (session('err'))
                        <strong class="text-danger">{{ session('err') }}</strong>

                        @endif --}}
                         </div>
                         <div class="mb-3 pass">
                            <label for="password" class="form-label"> new password</label>
                            <input  type="password" name="password" class="form-control" id="password">
                            @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            <i class="fa fa-eye show"></i>
                             </div>
                             <div class="mb-3">
                                <label for="password" class="form-label">confirm password </label>
                                <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                                 </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2>Profile picture update</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('update.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                    <strong class="text-danger">{{ session('success') }}</strong>
                    @endif
                    <div class="mb-3">
                        <img src="" alt="">
                        <label for="image" class="form-label">Choose photo</label>
                        <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                         </div>
                         <div class="my-2">
                            <img src="" id="blah" alt="" width="200">
                            @error('image')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                         </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                </form>
            </div>
        </div>


</div>

@endsection
@section('footer_script')
<script>
$('.show').click(function(){
    var passinput = document.getElementById('password');
    if(passinput.type == "password"){
        passinput.type = "text";
    }
    else{
         passinput.type = "password";

    }
})
 </script>
@endsection




