@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Gallery Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.video-gallery.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="video_url">Video URL</label>
                <input type="url" class="form-control" id="video_url" name="video_url" value="{{ $video->video_url }}" required>
            </div>
            <div class="form-group">
                <label for="video_url">Video Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
            </div>
            <div class="form-group">
                <label for="active">Status</label>
                <select class="form-control" id="active" name="active" required>
                    <option value="yes" {{ $video->active == 'yes' ? 'selected' : '' }}>Active</option>
                    <option value="no" {{ $video->active == 'no' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Update</button>
        </form>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


