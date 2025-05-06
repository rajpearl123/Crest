@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp
<!doctype html>
<html lang="en">

    
<head>
        
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">        
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- App favicon -->
        <link rel="shortcut icon" 
        href="{{ $websiteSetting->favicon ? asset('assets/images/logo/' . $websiteSetting->favicon) : asset('assets/images/logo/default-favicon.ico') }}" />
        <!-- Bootstrap Css -->
        <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Icons Css -->
        <link href="{{url('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{url('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- App js -->
        <script src="{{url('assets/js/plugin.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{url('assets/libs/tui-time-picker/tui-time-picker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/libs/tui-date-picker/tui-date-picker.min.css')}}">
        <link href="{{url('assets/libs/tui-calendar/tui-calendar.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit@3.24.3/build/jodit.min.css">
        <!-- Select2 CSS -->
        <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    </head>

    <body data-bs-theme="light" data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('admin.layouts._header')
            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layouts._sidebar')
            <!-- Left Sidebar End -->

            <!-- =============================Main Content================================= -->
            @yield('content')

            <!-- Footer Start -->
            @include('admin.layouts._footer')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jodit@3.24.3/build/jodit.min.js"></script>
        <script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
        <!-- <script src="{{asset('assets/libs/jquery-ui-dist/jquery-ui.min.js')}}"></script>-->
        <script src="{{asset('assets/libs/fullcalendar/index.global.min.js')}}"></script>
        <!-- <script src="{{asset('assets/js/locales-all.global.min.js')}}"></script> -->
        <script src="{{asset('assets/js/pages/calendars-full.init.js')}}"></script> 

        <!-- apexcharts -->
        <script src="{{url('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- dashboard blog init -->
        <script src="{{url('assets/js/pages/dashboard-blog.init.js')}}"></script>

        <script src="{{url('assets/js/app.js')}}"></script>
        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        
        <!-- Your Calendar Initialization -->
        <script src="{{ url('assets/js/pages/calendar.init.js') }}"></script>
        <!-- Select2 JS -->
        <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
        <script>
            $(document).ready(function() {
                $('#permission_id').select2({
                    placeholder: "Select Permissions",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>

        <!-- Toastr Script -->
        {!! Toastr::message() !!}
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script>
            $(document).ready(function() {
                
                // Initialize Summernote for textareas with the .summernote class
                $('.summernote').summernote({                   
                    height: 200, // Adjust the height as needed
                    
                    // Add more configurations as needed
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if ($errors->any())
                let errorMessages = "";
                @foreach ($errors->all() as $error)
                    errorMessages += "{{ $error }}\n";
                @endforeach
        
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error!',
                    text: errorMessages,
                });
            @endif
        </script>
        @stack('js')
    </body>
</html>