@extends('admin.layouts.app')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Home Video</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.video.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label">Upload Video:</label>
                                    <input type="file" name="video_file" class="form-control" accept="video/*" id="videoFile">
                                    <!-- Thumbnail input box, initially hidden -->
                                    <div id="thumbnailSection" style="display: none;">
                                        <label class="form-label mt-2">Upload Thumbnail:</label>
                                        <input type="file" name="thumbnail" class="form-control" accept="image/*" id="thumbnailInput">
                                    </div>
                                </div>
                            
                                <div class="text-center my-2">OR</div>
                            
                                <div class="mb-3">
                                    <label class="form-label">Enter Video Link:</label>
                                    <input type="url" name="video_link" value="{{ $video->video_link ?? '' }}" class="form-control" id="videoLink">
                                </div>
                            
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning">Update Video</button>
                                </div>
                            </form>

                            @if($video)
                                <div class="mt-4">
                                    @if($video->video_file)
                                        <p><strong>Current Video File:</strong> <a href="{{ asset($video->video_file) }}" target="_blank" class="text-decoration-none">View</a></p>
                                    @elseif($video->video_link)
                                        <p><strong>Current Video Link:</strong> <a href="{{ $video->video_link }}" target="_blank" class="text-decoration-none">{{ $video->video_link }}</a></p>
                                    @endif
                                </div>
                            @endif  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const videoFileInput = document.getElementById('videoFile');
        const thumbnailSection = document.getElementById('thumbnailSection');
        const videoLinkInput = document.getElementById('videoLink');

        // Function to toggle thumbnail section visibility
        function toggleThumbnailSection() {
            if (videoFileInput.files.length > 0) {
                thumbnailSection.style.display = 'block';
            } else {
                thumbnailSection.style.display = 'none';
                // Clear thumbnail input when hidden
                document.getElementById('thumbnailInput').value = '';
            }
        }

        // Event listener for video file input
        videoFileInput.addEventListener('change', toggleThumbnailSection);

        // Event listener for video link input to hide thumbnail if link is used
        videoLinkInput.addEventListener('input', function () {
            if (videoLinkInput.value.trim() !== '') {
                thumbnailSection.style.display = 'none';
                document.getElementById('thumbnailInput').value = '';
                videoFileInput.value = ''; // Clear video file input
            }
        });

        // Initialize on page load
        toggleThumbnailSection();
    });
</script>
