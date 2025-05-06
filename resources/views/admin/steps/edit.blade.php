@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Service</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.steps.update', $step->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $step->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @if($step->image)
                <img src="{{ asset($step->image) }}" width="50" class="mt-2">
            @endif
        </div>

        
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $step->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


