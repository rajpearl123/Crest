@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">List All Albums</h4>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <form method="GET" action="{{ route('admin.albums.index') }}">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </form>
                            </div>

                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($albums as $album)
                                        <tr>
                                            <td>{{ $album->title }}</td>
                                            <td>{{ $album->slug }}</td>
                                            <td>
                                                @if($album->image_url && is_array($album->image_url))
                                                    @foreach($album->image_url as $image)
                                                        <img src="{{ asset($image) }}" alt="{{ $album->title }}" width="100">
                                                    @endforeach
                                                @else
                                                    <p>No images available</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                @if($album->image_url && is_array($album->image_url))
                                                    <button class="btn btn-info btn-sm view-gallery" data-images="{{ json_encode($album->image_url) }}" data-title="{{ $album->title }}">View Gallery</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Gallery -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Album Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="galleryImage" src="" alt="Gallery Image" class="img-fluid" style="max-height: 500px;">
                <div class="mt-3">
                    <button class="btn btn-secondary me-2" id="prevImage" disabled><i class="fas fa-arrow-left"></i> Previous</button>
                    <button class="btn btn-secondary" id="nextImage" disabled><i class="fas fa-arrow-right"></i> Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-lg {
        max-width: 900px;
    }
    #galleryImage {
        transition: opacity 0.3s ease;
    }
    .modal-body {
        position: relative;
    }
    .btn-secondary:disabled {
        opacity: 0.5;
    }
</style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const galleryButtons = document.querySelectorAll('.view-gallery');
            const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));
            const galleryImage = document.getElementById('galleryImage');
            const prevButton = document.getElementById('prevImage');
            const nextButton = document.getElementById('nextImage');
            const modalTitle = document.getElementById('galleryModalLabel');

            let currentImages = [];
            let currentIndex = 0;

            function updateImage() {
                galleryImage.src = '{{ asset('') }}' + currentImages[currentIndex];
                galleryImage.style.opacity = '0';
                setTimeout(() => { galleryImage.style.opacity = '1'; }, 50);
                prevButton.disabled = currentIndex === 0;
                nextButton.disabled = currentIndex === currentImages.length - 1;
            }

            galleryButtons.forEach(button => {
                button.addEventListener('click', function () {
                    currentImages = JSON.parse(this.dataset.images);
                    currentIndex = 0;
                    modalTitle.textContent = this.dataset.title + ' Gallery';
                    if (currentImages.length > 0) {
                        updateImage();
                        galleryModal.show();
                    }
                });
            });

            prevButton.addEventListener('click', function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateImage();
                }
            });

            nextButton.addEventListener('click', function () {
                if (currentIndex < currentImages.length - 1) {
                    currentIndex++;
                    updateImage();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function (e) {
                if (galleryModal._isShown) {
                    if (e.key === 'ArrowLeft' && currentIndex > 0) {
                        currentIndex--;
                        updateImage();
                    } else if (e.key === 'ArrowRight' && currentIndex < currentImages.length - 1) {
                        currentIndex++;
                        updateImage();
                    }
                }
            });
        });
    </script>

@endsection