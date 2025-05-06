@extends('admin.layouts.app')

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Home Video Management</h4>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Thumbnail</th>
                                            <th>Video File</th>
                                            <th>Video Link</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if($video && $video->thumbnail && $video->video_file)
                                                    <img src="{{ asset($video->thumbnail) }}" alt="Thumbnail" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($video && $video->video_file)
                                                    <a href="{{ asset($video->video_file) }}" target="_blank" class="btn btn-sm btn-primary">View Video</a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($video && $video->video_link)
                                                    <!-- Button to trigger the modal -->
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#videoModal" data-video-link="{{ $video->video_link }}">
                                                        Watch Video
                                                    </button>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.video.edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for YouTube Video -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Watch Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <iframe id="youtubeVideo" src="" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    // JavaScript to handle video link in the modal
    document.addEventListener('DOMContentLoaded', function () {
        const videoModal = document.getElementById('videoModal');
        videoModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const videoLink = button.getAttribute('data-video-link'); // Get the video link
            const youtubeIframe = document.getElementById('youtubeVideo');

            // Convert YouTube link to embed format
            let embedLink = videoLink;
            if (videoLink.includes('youtube.com') || videoLink.includes('youtu.be')) {
                const videoId = videoLink.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/)?.[1];
                if (videoId) {
                    embedLink = `https://www.youtube.com/embed/${videoId}`;
                }
            }

            // Set the iframe src to the YouTube embed link
            youtubeIframe.src = embedLink;
        });

        // Clear iframe src when modal is hidden to stop video playback
        videoModal.addEventListener('hidden.bs.modal', function () {
            const youtubeIframe = document.getElementById('youtubeVideo');
            youtubeIframe.src = '';
        });
    });
</script>
