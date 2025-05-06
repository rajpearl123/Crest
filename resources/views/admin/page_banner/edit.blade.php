@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit {{$banner->page_name}} Banner</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.page_banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Page Name -->
        <div class="mb-3">
            <label class="form-label">Page Name</label>
            <input type="text"  value="{{ $banner->page_name }}" class="form-control" required disabled>
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ $banner->title }}" class="form-control">
        </div>

        <!-- Current Banner Image -->
        <div class="mb-3">
            <label class="form-label">Current Banner Image</label><br>
            @if($banner->banner_img)
                <img src="{{ asset('uploads/page_banners/' . $banner->banner_img) }}" width="200" class="mb-2">
            @else
                <p>No image uploaded</p>
            @endif
        </div>

        <!-- Upload New Banner Image -->
        <div class="mb-3">
            <label class="form-label">Upload New Banner Image</label>
            <input type="file" name="banner_img" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Banner</button>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Back</a>
    </form>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


