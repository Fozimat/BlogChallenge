@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Edit Category</strong>
                    <a href="{{ route('category.index') }}" class="btn btn-primary float-right">Back</a>
                </div>

                <div class="card-body">

                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $category->name }}">
                                @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-2">
                                <button type="submit" class="btn btn-success">Edit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection