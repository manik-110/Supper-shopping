@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>category list</h3>
            </div>
            <div class="card-body">
                @if (session('del'))
                <strong class="alert alert-success">{{ session('del') }}</strong>

                @endif
             <table class="table table-striped">
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="chkDel" type="checkbox" id="chkSelectAll">
                            <label class="chkDel" >
                             check-all
                            </label>
                          </div>
                    </th>
                    <th>category_name</th>
                    <th>category_image</th>
                    <th>slug</th>
                    <th>Action</th>
                </tr>
                <tr>
                    @foreach ($categories as $category )
                    <td>
                        <div class="form-check">
                            <input class="chkDel" type="checkbox" value="" id="flexCheckDefault">
                            <label class="chkDel" for="checkSelectAll">
                               checkbox
                            </label>
                          </div>
                    </td>
                    <td>{{$category->category_name  }}</td>
                  <td><img width="200 " src="{{ asset('uploads/category') }}/{{ $category->category_photo }}" alt=""></td>
                    <td>{{ $category->category_slug }}</td>
                    <td>

                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-primary btn-icon">
                            <i data-feather="check-square"></i>
                        </a>
                        <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger btn-icon">
                            <i data-feather="box"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
             </table>


            </div>
        </div>
    </div>
    <div class="col-lg-4">
    <div class="card">
        <div class="card-header">
            <h2>Add category</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                <label for="" class="form-label">Category name</label>
                <input type="text" name="category_name" class="form-control">
                @error('category_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
                <div class="mb-3">
                <label for="" class="form-label">photo</label>
                <input type="file" name="category_photo" class="form-control">
                @error('category_photo')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
                <div class="mb-3">
               <button type="submit" class="btn btn-primary">Add category</button>
            </div>
            </form>
        </div>
       </div>
    </div>
</div>

@endsection
@section('footer_script')
<script>
    $("#chkSelectAll").on('click', function(){
     this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
})
</script>
@endsection
