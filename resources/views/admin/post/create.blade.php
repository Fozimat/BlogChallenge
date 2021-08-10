@extends('layouts.app')
@section('title', 'Add Post')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Add Post</strong>
                    <a href="{{ route('post.index') }}" class="btn btn-primary float-right">Back</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}">
                                @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category" class="form-control @error('category') is-invalid @enderror">
                                    <option value="">---Select Category---</option>
                                    @forelse ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == old('category'))
                                        selected @endif>{{ $category->name }}</option>
                                    @empty
                                    <option value="">Category is empty</option>
                                    @endforelse
                                </select>
                                @error('category')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Post</label>
                            <div class="col-sm-10">
                                <textarea name="post"
                                    class="form-control @error('post') is-invalid @enderror">{{ old('post') }}</textarea>
                                @error('post')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tags</label>
                            <div class="col-sm-10">
                                <select class="form-control js-example-basic-multiple @error('tags') is-invalid
                                @enderror" id="multiple" name="tags[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ (collect(old("tags"))->contains($tag->id) ? "selected": '') }}>
                                        {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @error('tags')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" value="{{ old('image') }}">
                                @error('image')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-2">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection