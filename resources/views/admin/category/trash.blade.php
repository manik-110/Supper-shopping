@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Trash-category</h3>
            </div>
            <div class="card-body">
               <table class="table table-tripred">
              <tr>
                     <th>category name</th>
                    <td>category image</td>
                    <td>slug</td>
                    <td>createdat</td>
                    <td>Action</td>
                </tr>
              <tr>
                @foreach ($categories as $category )
                <tr>
                    <td>{{ $category->category_name }}</td>
                    <td> <img src="{{ asset('uploads/category/') }}/{{$category->category_photo}}" alt="">{{ $category->category_photo }}</td>
                    <td>{{ $category->category_slug }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>



                    <td>

                        <a href="{{ route('category.recovery', $category->id) }}" class="btn btn-primary btn-icon">
                            <i data-feather="edit"></i>
                        </a>
                        <a data-id="{{ $category->id }}" class="delete btn btn-danger btn-icon">
                            <i data-feather="trash"></i>
                        </a>
                    </td>
                </tr>

              @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $('.delete').on('click', function(){
        let id = $(this).data('id');
        let deleteUrl = "{{ route('category.forced.deleted', ['id' => ':id']) }}";
        deleteUrl = deleteUrl.replace(':id', id);
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
        });
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
