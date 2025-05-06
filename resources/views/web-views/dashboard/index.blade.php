@extends('web-views.layouts.app')
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp
@php use App\Utils\ViewPath; @endphp

@section('title', Auth::user()->name)
@section('content')

<div class="container mt-5">
    <div class="row">
        @include(ViewPath::USER_PROFILE_SIDEBAR)
        <div class="col-12 col-lg-8">

            <div class="user-dashboard">
                <div class="user-dashboard-info">
                    <div class="dashboard-title mb-4">
                        <h6 class="title">Profile Info</h6>
                    </div>
                    <div class="profile-form">
                        <div class="card text-center p-4">
                            <div class="position-relative mx-auto mb-3 profile-image" style="width: 120px;">
                                <div class="position-relative mx-auto mb-3" style="width: 120px;">
                                    <!-- Profile Image -->
                                    <img id="blah" class="rounded-circle border" alt="Profile Image"
                                        src="{{ filter_var(Auth::user()->image, FILTER_VALIDATE_URL) ? Auth::user()->image : asset('assets/images/user/' . Auth::user()->image) }}"
                                        style="width: 120px; height: 120px; object-fit: cover;">

                                    <!-- Upload Icon -->
                                    <label class="position-absolute upload-image-btn">
                                        <i class="fa-solid fa-camera"></i>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 18 18" fill="white">
                                                    <path d="M7.3125 9.75C7.3125 9.30245 7.49029 8.87323 7.80676 8.55676C8.12323 8.24029 8.55245 8.0625 9 8.0625C9.44755 8.0625 9.87678 8.24029 10.1932 8.55676C10.5097 8.87323 10.6875 9.30245 10.6875 9.75C10.6875 10.1976 10.5097 10.6268 10.1932 10.9432C9.87678 11.2597 9.44755 11.4375 9 11.4375C8.55245 11.4375 8.12323 11.2597 7.80676 10.9432C7.49029 10.6268 7.3125 10.1976 7.3125 9.75Z"/>
                                                </svg> -->
                                        <input id="files" name="image" hidden type="file" accept="image/*">
                                    </label>
                                </div>
                            </div>
                            <form action="{{ route('updateProfileDetails') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group dashboard-form-field">
                                            <label for="name">Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group dashboard-form-field">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group dashboard-form-field">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#files').change(function(e) {
                let file = e.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);

                    // Upload Image via AJAX
                    let formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}'); // CSRF Token

                    $.ajax({
                        url: "{{ route('update-profile-image') }}", // Adjust Route Name
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status === "success") {
                                alert("Profile updated successfully!");
                                $(".profile-image").load(location.href + " .profile-image");
                            } else {
                                alert("Error updating profile.");
                            }
                        },
                        error: function() {
                            alert("Something went wrong!");
                        }
                    });
                }
            });
        });
    </script>