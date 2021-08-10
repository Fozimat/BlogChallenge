@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            @forelse ($posts as $post)
            <div class="col-md-3 d-flex">
                <div class="card mb-3" style="width: 18rem;">
                    <img class="card-img-top" style="width: 100%; height: 15vw; object-fit: cover;"
                        src="{{ asset('storage/posts/'.$post->image) }}">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('show.post', $post->id) }}">{{ $post->title }}</a></h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $post->category->name }}</h6>
                        <p class="card-text">{{ $post->post }}</p>
                        @foreach ($post->tags as $tag)
                        <a href="{{ route('show.tag', $tag->name) }}" class="badge badge-info">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            @empty

            <div class="card">
                <div class="card-header">
                    Post
                </div>
                <div class="card-body">
                    <h5 class="card-title">Post is empty</h5>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
</div>
@endsection