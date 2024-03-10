@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category</h3>
            </div>
            <div class="card-body">
                @if (session('update'))
                <div class="alert alert-success">{{ session('update') }}</div>

                @endif
                <div class="mb-3">
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="" class="form-label">Edit_name</label>
                    <input type="text" name="category_name" class="form-control" value="{{$category->category_name }}">
                    <div class="mb-3">
                        <label for="" class="form-label">photo</label>
                        <input type="file" name="category_photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img id="blah" width="200" src="{{ asset('uploads/category/') }}/{{ $category->category_photo }}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">category_update</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
