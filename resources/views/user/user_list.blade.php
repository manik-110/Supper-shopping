{{-- @extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3>User List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl=>$user)

                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <button class="btn btn-success">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <h3>user list</h3>
            </div>
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>

            @endif
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Sl</th>
                        <th>photo</th>
                        <th>name</th>
                        <th>email</th>
                        <th>created</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as $Sl=>$user )
                    <tr>
                        <td>{{ $Sl+1 }}</td>
                        <td>
                            @if ($user->photo != null)
                            <img src="{{ asset('uploads/users/'.$user->photo) }}" alt="profile">
                            @else
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" alt="profile">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{ route('user.delete', $user->id) }}" class='btn btn-danger'>Delete</a>
                            <a href="" class='btn btn-success'>Edit</a>
                        </td>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
