@extends('admin.layouts.app')

@section('content')
<div class="main-content" style="min-height: 641px;">
    <section class="section">
        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Update Admin Profile</h4>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Profile Image -->
                                <div class="col-md-4 text-center">
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold">Profile Image</label>
                                        <div class="position-relative mb-3">
                                            <img src="{{ $admin->profile ? asset('assets/images/admin/' . $admin->profile) : asset('assets/images/default-avatar.png') }}"
                                                class="rounded-circle img-preview"
                                                style="width: 150px; height: 150px; object-fit: cover; transition: all 0.3s;"
                                                alt="Profile Image">
                                            <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-circle bg-dark bg-opacity-50"
                                                style="opacity: 0; transition: opacity 0.3s;">
                                                <span class="text-white">Change</span>
                                            </div>
                                        </div>
                                        <input type="file" name="image" accept="image/*"
                                            class="form-control @error('image') is-invalid @enderror"
                                            id="profileImage">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Other Fields -->
                                <div class="col-md-8">
                                    <!-- Name -->
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name" value="{{ $admin->name }}" placeholder="Name">
                                        <label for="name"><i class="bi bi-person me-2"></i>Name</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" value="{{ $admin->email }}" placeholder="Email">
                                                <label for="email"><i class="bi bi-envelope me-2"></i>Email</label>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Mobile -->
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="tel" name="mobile"
                                                    class="form-control @error('mobile') is-invalid @enderror"
                                                    id="mobile" value="{{ $admin->mobile }}" placeholder="Mobile">
                                                <label for="mobile"><i class="bi bi-phone me-2"></i>Mobile</label>
                                                @error('mobile')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- New Password -->
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" placeholder="New Password">
                                                <label for="password"><i class="bi bi-lock me-2"></i>New Password (Optional)</label>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control" id="password_confirmation"
                                                    placeholder="Confirm Password">
                                                <label for="password_confirmation"><i class="bi bi-lock me-2"></i>Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right bg-white border-0 pt-4">
                                <button type="reset" class="btn btn-outline-secondary me-2">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    .rounded-circle:hover + .overlay, .overlay:hover {
        opacity: 1 !important;
    }
    .card {
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #00b7ff);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #0096d6);
    }
</style>
@endpush

@push('script')
<script>
    // Preview image before upload
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.querySelector('.img-preview');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (!file.type.startsWith('image/')) {
                alert('Please upload a valid image file.');
                imageInput.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush