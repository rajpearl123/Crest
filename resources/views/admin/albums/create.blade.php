@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Add Albums</h4>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                        <div class="card-body">
                            
                        

                        <form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Title:</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                            <label>Slug:</label>
                            <select name="slug" class="form-control" required>
                                <option value="">Select Slug</option>
                                <option value="wedding" {{ old('slug', $album->slug ?? '') == 'wedding' ? 'selected' : '' }}>Wedding</option>
                                <option value="event" {{ old('slug', $album->slug ?? '') == 'event' ? 'selected' : '' }}>Event</option>
                                <option value="video_production" {{ old('slug', $album->slug ?? '') == 'video_production' ? 'selected' : '' }}>Video Production</option>
                                <option value="kids_photography" {{ old('slug', $album->slug ?? '') == 'kids_photography' ? 'selected' : '' }}>Kids Photography</option>
                                <option value="product_photography" {{ old('slug', $album->slug ?? '') == 'product_photography' ? 'selected' : '' }}>Product Photography</option>

                            </select>
                        </div>
                            <div class="mb-3">
                                <label>Upload Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Create Album</button>
                        </form>

                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
