@extends('admin.layouts.app')
@section('title', 'Image Gallary')
@php use App\Utils\ViewPath; @endphp
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include(ViewPath::ADMIN_INLINE_MENU_BUSINESS)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Gallery Images</h4>
                            <form action="{{ route('admin.business-setting.imageGallaryStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="images">Image Gallery</label>
                                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Image Gallery Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Uploaded Images</h4>
                            <div class="row">
                                @foreach($images as $gallery)
                                    <div class="col-md-3 position-relative mb-3">
                                        <img src="{{ asset('assets/images/gallary/' . $gallery) }}" class="img-thumbnail" alt="Gallery Image">
                                        <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image" 
                                                data-image="{{ $gallery }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')

<script>
    $(document).on('click', '.delete-image', function () {
        let imageName = $(this).data('image');
        let button = $(this);

        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: "{{ route('admin.business-setting.deleteImage') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    image: imageName
                },
                success: function (response) {
                    if (response.success) {
                        button.closest('.col-md-3').fadeOut();
                    } else {
                        alert('Failed to delete image');
                    }
                }
            });
        }
    });
</script>
@endpush

