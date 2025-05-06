@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Update Banner</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Current Image</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($banner->image) }}" alt="Banner Image" class="img-thumbnail" width="120">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">New Image (optional)</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Update Banner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
