@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Page Banner Management</h4>
                        </div>
                        <div class="card-body">
                            <!-- Button to trigger modal -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bannerModal">
                                    View Banners
                                </button>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Page Name</th>
                                        <th>Title</th>
                                        <th>Banner Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>{{ $banner->page_name }}</td>
                                            <td>{{ $banner->title ?? 'N/A' }}</td>
                                            <td>
                                                @if($banner->banner_img)
                                                    <img src="{{ asset('uploads/page_banners/' . $banner->banner_img) }}" width="100">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.page_banner.edit', $banner->id) }}" class="btn btn-primary">Edit</a>
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

<!-- Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" aria-labelledby="bannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bannerModalLabel">Banner Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 id="bannerPageName"></h4>
                <img id="bannerImage" src="" alt="Banner Image" style="max-width: 100%; max-height: 400px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="prevBanner">Previous</button>
                <button type="button" class="btn btn-primary" id="nextBanner">Next</button>
            </div>
        </div>
    </div>
</div>

    <script>
        // Pass banners data from PHP to JavaScript
        const banners = @json($banners);
        let currentBannerIndex = 0;

        // Function to update modal content
        function updateModal() {
            if (banners.length === 0) {
                document.getElementById('bannerPageName').textContent = 'No banners available';
                document.getElementById('bannerImage').style.display = 'none';
                return;
            }

            const banner = banners[currentBannerIndex];
            document.getElementById('bannerPageName').textContent = banner.page_name;
            document.getElementById('bannerImage').src = banner.banner_img 
                ? `/crest/public/uploads/page_banners/${banner.banner_img}` 
                : '';
            document.getElementById('bannerImage').style.display = banner.banner_img ? 'block' : 'none';
        }

        // Event listener for modal show
        document.getElementById('bannerModal').addEventListener('show.bs.modal', function () {
            currentBannerIndex = 0;
            updateModal();
        });

        // Previous button
        document.getElementById('prevBanner').addEventListener('click', function () {
            if (banners.length > 0) {
                currentBannerIndex = (currentBannerIndex - 1 + banners.length) % banners.length;
                updateModal();
            }
        });

        // Next button
        document.getElementById('nextBanner').addEventListener('click', function () {
            if (banners.length > 0) {
                currentBannerIndex = (currentBannerIndex + 1) % banners.length;
                updateModal();
            }
        });
    </script>

@endsection