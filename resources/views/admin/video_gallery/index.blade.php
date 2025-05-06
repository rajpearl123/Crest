@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Video Gallery Management</h4>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('admin.video-gallery.index') }}" class="mb-4">
                                <div class="row" style="min-height: 120px;">
                                    <!-- Title Filter -->
                                    <div class="col-12 col-md-3 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ request('title') }}" placeholder="Search by title">
                                    </div>
                                    <style>
                                        #status{
                                            display: block !important;
                                        }
                                    </style>

                                    <!-- Status Filter -->
                                    <div class="col-12 col-md-3 mb-3" style="display: block !important;">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">All</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <!-- Date Range Filter -->
                                    <div class="col-12 col-md-3 mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-12 col-md-3 mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.video-gallery.index') }}" class="btn btn-secondary">Clear</a>
                                </div>
                            </form>

                            <!-- Video Table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Video URL</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $video)
                                        <tr>
                                            <td>{{ $video->id }}</td>
                                            <td>{{ $video->title }}</td>
                                            <td>{{ $video->video_url }}</td>
                                            <td>{{ $video->active ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $video->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('admin.video-gallery.edit', $video->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.video-gallery.destroy', $video->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                @if($video->video_url)
                                                    <button class="btn btn-info btn-sm view-video" data-video="{{ $video->video_url }}" data-title="{{ $video->title }}">View Video</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="wptb-pagination-wrap text-center">
                                {{ $videos->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Video Gallery -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Video Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <iframe id="galleryVideo" width="100%" height="500" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div class="mt-3">
                    <button class="btn btn-secondary me-2" id="prevVideo" disabled><i class="fas fa-arrow-left"></i> Previous</button>
                    <button class="btn btn-secondary" id="nextVideo" disabled><i class="fas fa-arrow-right"></i> Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-lg {
        max-width: 900px;
    }
    #galleryVideo {
        transition: opacity 0.3s ease;
        max-height: 500px;
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
            const videoButtons = document.querySelectorAll('.view-video');
            const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
            const galleryVideo = document.getElementById('galleryVideo');
            const prevButton = document.getElementById('prevVideo');
            const nextButton = document.getElementById('nextVideo');
            const modalTitle = document.getElementById('videoModalLabel');

            let currentVideos = [];
            let currentTitles = [];
            let currentIndex = 0;

            // Collect all video data
            videoButtons.forEach(button => {
                currentVideos.push(button.dataset.video);
                currentTitles.push(button.dataset.title);
            });

            function getYouTubeEmbedUrl(url) {
                // Extract video ID from various YouTube URL formats
                const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
                const match = url.match(regex);
                return match ? `https://www.youtube.com/embed/${match[1]}` : url;
            }

            function updateVideo() {
                const embedUrl = getYouTubeEmbedUrl(currentVideos[currentIndex]);
                galleryVideo.src = embedUrl;
                galleryVideo.style.opacity = '0';
                setTimeout(() => { galleryVideo.style.opacity = '1'; }, 50);
                modalTitle.textContent = currentTitles[currentIndex] + ' Video';
                prevButton.disabled = currentIndex === 0;
                nextButton.disabled = currentIndex === currentVideos.length - 1;
            }

            videoButtons.forEach((button, index) => {
                button.addEventListener('click', function () {
                    currentIndex = index;
                    if (currentVideos.length > 0) {
                        updateVideo();
                        videoModal.show();
                    }
                });
            });

            prevButton.addEventListener('click', function () {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateVideo();
                }
            });

            nextButton.addEventListener('click', function () {
                if (currentIndex < currentVideos.length - 1) {
                    currentIndex++;
                    updateVideo();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function (e) {
                if (videoModal._isShown) {
                    if (e.key === 'ArrowLeft' && currentIndex > 0) {
                        currentIndex--;
                        updateVideo();
                    } else if (e.key === 'ArrowRight' && currentIndex < currentVideos.length - 1) {
                        currentIndex++;
                        updateVideo();
                    }
                }
            });

            // Clear iframe src when modal is closed to stop video playback
            videoModal._element.addEventListener('hidden.bs.modal', function () {
                galleryVideo.src = '';
            });
        });
    </script>


@endsection