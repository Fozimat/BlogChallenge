@extends('layouts.app')
@section('title', 'Post List')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Post</strong></div>

                <div class="card-body">
                    <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Add Post</a>

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
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Image</th>
                                <th scope="col" width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $key => $post)
                            <tr>
                                <td>{{ $posts->firstItem() + $key }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @foreach ($post->tags as $tag)
                                    <a href="#" class="badge badge-info">#{{ $tag->name }}</a>
                                    @endforeach
                                </td>
                                <td><img width="100px" height="100px" src="{{ asset('storage/posts/'.$post->image) }}"
                                        alt=""></td>
                                <td>
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-info">show</a> |
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">edit</a> |
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger show-confirm">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6"><strong>Post Not Found</strong></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $posts->links() }}
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