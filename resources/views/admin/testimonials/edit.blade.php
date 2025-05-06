@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Testimonial</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Rating (1-5 ?)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ $testimonial->rating }}" required>
                            </div>
                            <div class="form-group">
                                <label>Review</label>
                                <textarea name="review" class="form-control" rows="3" required>{{ $testimonial->review }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Current Image</label><br>
                                @if($testimonial->image)
                                    <img src="{{ asset($testimonial->image) }}" width="100">
                                @else
                                    No Image
                                @endif
                            </div>
                            <div class="form-group">
                                <label>New Image (Optional)</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="{{ $testimonial->country }}" required>
                            </div>
                            <button type="submit" class="btn btn-success">Update Testimonial</button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


