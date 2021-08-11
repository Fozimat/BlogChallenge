@extends('layouts.app')
@section('title', 'Tag List')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Tag</strong></div>

                <div class="card-body">
                    <a href="{{ route('tag.create') }}" class="btn btn-primary mb-3">Add Tag</a>

                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tags as $key => $tag)
                            <tr>
                                <td>{{ $tags->firstItem() + $key }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-success">edit</a> |
                                    <form action="{{ route('tag.destroy', $tag->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger show-confirm">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="3"><strong>Tag Not Found</strong></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script>
    $('.show-confirm').click(function(e) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })
</script>
@endpush