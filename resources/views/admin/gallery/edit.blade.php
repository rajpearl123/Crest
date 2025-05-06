@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Gallery Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Title:</label>
                                    <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                                </div>
                                <!-- <div class="mb-3">
                                    <label>Author:</label>
                                    <input type="text" name="author" class="form-control" value="{{ $gallery->author }}">
                                </div> -->
                                <div class="mb-3">
                                    <label>Current Image:</label>
                                    <br>
                                    <img src="{{ asset($gallery->image) }}" width="150">
                                </div>
                                <div class="mb-3">
                                    <label>New Image (optional):</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="mb-3">
    <label for="gallery_category_id" class="form-label">Category:</label>
    <select name="gallery_category_id" id="gallery_category_id" class="form-control" required>
        <option value="" disabled selected>Select a category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                {{ isset($gallery) && $gallery->gallery_category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

                                <!-- <div class="mb-3">
                                    <label>Link:</label>
                                    <input type="url" name="link" class="form-control" value="{{ $gallery->link }}">
                                </div> -->
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


