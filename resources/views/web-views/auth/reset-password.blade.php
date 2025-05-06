@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from ithemeslab.com/sitetemplate/eventex/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Feb 2025 06:49:02 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="author" content="iThemesLab">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ $websiteSetting->favicon ? asset('assets/images/logo/' . $websiteSetting->favicon) : asset('assets/images/logo/logo.jpg') }}">
    <link rel="apple-touch-icon" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">

    <!--All Css Here-->

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/bootstrap.min.css')}}">
    <!--Font-Awesome Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/font-awesome.min.css')}}">
    <!--Flaticon Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/flaticon.css')}}">
    <!--Owl-Carousel Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/owl.carousel.min.css')}}">
    <!--Owl Theme Default-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/owl.theme.default.min.css')}}">
    <!--Animate Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/animate.css')}}">
    <!--Jquery Ui Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/jquery-ui.min.css')}}">
    <!--Lightbox Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/vendor/lightbox.css')}}">
    <!--Style Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/style.css')}}">
    <!--Responsive Css-->
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/responsive.css')}}">
    <!--Modernizr Css-->
    <script src="{{asset('assets/web-assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
       
    </style>

</head>

<body>
    <!--Preloder-->
    {{-- <div class='loader'>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--text'></div>
    </div> --}}

    <!--Main Container Start Here-->
    <div class="main-container">
        <div class="about-us-area pad-head bg-about">
            <section class="user_registration">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="_main_register registration-form">
                                <form action="{{ route('resetPassword') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" >New Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" >Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn= submit-btn">Reset Password</button>

                                    </div>
                                </form>

                            </div>
                        </div>
                        <!-- <div class="col-md-6">

                        </div> -->
                    </div>
                </div>
            </section>
        </div>
    </div>


    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlUJtsIi_FRurx0i2WUGoxf_KaNoHmc4o"></script>
    <script src="{{asset('assets/web-assets/js/vendor/map.js')}}"></script>
    <!-- jquery latest version -->
    {{-- <script src="{{asset('assets/web-assets/js/vendor/jquery-3.2.1.min.js')}}"></script> --}}
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--Migrate Js-->
    <script src="{{asset('assets/web-assets/js/vendor/jquery-migrate.js')}}"></script>
    <!--Popper Js-->
    <script src="{{asset('assets/web-assets/js/vendor/popper-1.12.9.min.js')}}"></script>
    <!--Bootstrap Js-->
    <script src="{{asset('assets/web-assets/js/vendor/bootstrap.min.js')}}"></script>
    <!--Owl-Carousel Js-->
    <script src="{{asset('assets/web-assets/js/vendor/owl.carousel.min.js')}}"></script>
    <!--Counter-Up Js-->
    <script src="{{asset('assets/web-assets/js/vendor/jquery.counterup.min.js')}}"></script>
    <!--Waypoints Js-->
    <script src="{{asset('assets/web-assets/js/vendor/waypoints-jquery.js')}}"></script>
    <!--Lightbox Js-->
    <script src="{{asset('assets/web-assets/js/vendor/lightbox.js')}}"></script>
    <!--Appear Js-->
    <script src="{{asset('assets/web-assets/js/vendor/jquery.appear.js')}}"></script>
    <!--Jquery Ui Js-->
    <script src="{{asset('assets/web-assets/js/vendor/jquery-ui.min.js')}}"></script>
    <!--Wow Js-->
    <script src="{{asset('assets/web-assets/js/vendor/wow.min.js')}}"></script>
    <!--Plugins Js-->
    <script src="{{asset('assets/web-assets/js/vendor/plugins.js')}}"></script>

    <!-- template main js file -->
    <script src="{{asset('assets/web-assets/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Toastr Script -->
    {!! Toastr::message() !!}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    @stack('script')
</body>

</html>