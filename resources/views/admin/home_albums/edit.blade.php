@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Home Gallery</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.home_albums.update') }}" method="POST" id="albumForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Title:</label>
                                    <input type="text" name="title" value="{{ $album->title }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description:</label>
                                    <textarea name="description" class="form-control">{{ $album->description }}</textarea>
                                </div>

                                <h4>Album Images</h4>
                                <div id="album-container">
                                    @foreach ($album->album as $index => $image)
                                        <div class="album-item border p-3 mb-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Image Title:</label>
                                                    <input type="text" name="album[{{ $index }}][img_title]" value="{{ $image['img_title'] }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Author:</label>
                                                    <input type="text" name="album[{{ $index }}][author]" value="{{ $image['author'] }}" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Image File:</label>
                                                    <input type="file" name="album[{{ $index }}][src]" class="form-control">
                                                    @if(isset($image['src']) && $image['src'])
                                                        <img src="{{ asset($image['src']) }}" width="80" class="mt-2">
                                                        <!-- Hidden input to retain the existing image -->
                                                        <input type="hidden" name="album[{{ $index }}][existing_src]" value="{{ $image['src'] }}">
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger mt-4 remove-image">X</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Button to Add More Images -->
                                <button type="button" class="btn btn-primary mt-2" id="addMore">Add More</button>

                                <br><br>
                                <button type="submit" class="btn btn-success">Update Album</button>
                                <a href="{{ route('admin.home_albums.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Form -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let albumContainer = document.getElementById("album-container");
        let addMoreBtn = document.getElementById("addMore");

        addMoreBtn.addEventListener("click", function() {
            let index = albumContainer.children.length;
            let newAlbumItem = `
                <div class="album-item border p-3 mb-2">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Image Title:</label>
                            <input type="text" name="album[${index}][img_title]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Author:</label>
                            <input type="text" name="album[${index}][author]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Image File:</label>
                            <input type="file" name="album[${index}][src]" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger mt-4 remove-image">X</button>
                        </div>
                    </div>
                </div>`;
            
            albumContainer.insertAdjacentHTML("beforeend", newAlbumItem);
        });

        albumContainer.addEventListener("click", function(event) {
            if (event.target.classList.contains("remove-image")) {
                event.target.closest(".album-item").remove();
            }
        });
    });
</script>

@endsection
