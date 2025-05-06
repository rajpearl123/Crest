@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Edit {{$album->slug}} Albums</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('admin.albums.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Title:</label>
                                <input type="text" name="title" class="form-control" value="{{ $album->title }}" required>
                            </div>
                            <!-- <div class="mb-3">
                                <label>Slug:</label>
                                <select name="slug" class="form-control" hidden>
                                    <option value="">Select Slug</option>
                                    @foreach($slugs as $slugOption)
                                        <option value="{{ $slugOption }}" {{ old('slug', $album->slug ?? '') == $slugOption ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $slugOption)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> -->
                            
                                
                            <input type="text" name="slug" class="form-control" value="{{ $album->slug }}" hidden>
                            
                            <div class="mb-3">
                                <label>Upload New Images (optional):</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>

                            @if($album->image_url && count($album->image_url) > 0)
                                <div class="mb-3">
                                    <label>Current Images:</label><br>
                                    @foreach($album->image_url as $image)
                                        <div class="mb-2">
                                            <img src="{{ asset($image) }}" width="150" alt="Album Image">
                                            <button type="button" class="btn btn-danger btn-sm remove-image" data-id="{{ $loop->index }}" data-image="{{ basename($image) }}">&#x2716;</button>
                                            <input type="hidden" name="removed_images[]" id="removed_images_input">                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Update Album</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.remove-image').forEach(button => {
        button.addEventListener('click', function () {
            let imageName = this.getAttribute('data-image');
            let parentDiv = this.parentElement;

            console.log("Removing image:", imageName); // Debugging

            // Hide the image preview
            parentDiv.style.display = 'none';

            // Append removed image name to hidden input
            let removedImagesInput = document.querySelector("#removed_images_input");
            removedImagesInput.value += (removedImagesInput.value ? ',' : '') + imageName;
        });
    });
});


</script>
@endpush






