@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Crest - Photography">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ $websiteSetting->favicon ? asset('assets/images/logo/' . $websiteSetting->favicon) : asset('assets/images/logo/logo.jpg') }}">
    <link href="{{asset('assets/web-assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <link href="{{asset('assets/web-assets/img/apple-touch-icon-72x72.png')}}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{asset('assets/web-assets/img/apple-touch-icon-114x114.png')}}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{asset('assets/web-assets/img/apple-touch-icon-144x144.png')}}" rel="apple-touch-icon" sizes="144x144">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/web-assets/css/main.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

    <style>
    .wptb-item--description {
        display: inline-block;
        position: relative;
    }

    .address-full {
        display: none;
        position: absolute;
        white-space: nowrap;
        background-color: #f5f5f5;
        padding: 5px;
        border: 1px solid #ddd;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        left: 0;
        top: 100%;
        z-index: 10;
        max-width: 300px; /* Adjust this to fit your design */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .address-short {
        display: inline-block;
        max-width: 200px; /* Limit the visible part of the address */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis; /* Truncates text with ... */
    }

    .wptb-item--description a:hover .address-full {
        display: block; /* Show full address on hover */
    }


    </style>
</head>

<body class="theme-style--light theme-style--gradient">

    @include('web-views.layouts._header')

    <div class="aside_info_wrapper" data-lenis-prevent="">
        <button class="aside_close">Close <i class="bi bi-x-lg"></i></button>
        <div class="aside_logo logo">
            <a href="{{route('home')}}" class="light_logo"><img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->footer_logo) : asset('assets/images/logo/logo.jpg') }}" alt="logo"></a>
            <a href="{{route('home')}}" class="dark_logo"><img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->footer_logo) : asset('assets/images/logo/logo.jpg') }}" alt="logo"></a>
        </div>
        <div class="aside_info_inner">
            <!-- <h6>// Instagram</h6>
            <div class="insta-logo">
                <i class="bi bi-instagram"></i> studio_Crest
            </div>
            <div class="wptb-instagram--gallery">
                <div class="wptb-item--inner d-flex align-items-center justify-content-center flex-wrap">
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{asset('assets/web-assets/images/6.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{asset('assets/web-assets/images/7.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{asset('assets/web-assets/images/8.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{asset('assets/web-assets/images/9.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{asset('assets/web-assets/images/10.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{asset('assets/web-assets/images/11.jpg')}}" alt="img">
                        </div>
                    </div>
                </div>
            </div> -->


            @php 
                $posts = \App\Helpers\InstagramPosts::fetchInstagramPosts();
                
            @endphp
            <!-- <h6>// Instagram</h6>
                <div class="insta-logo">
                    <i class="bi bi-instagram"></i> crest__photography
                </div>
                <div class="wptb-instagram--gallery">
                    <div class="wptb-item--inner d-flex align-items-center justify-content-center flex-wrap">
                        
                        @if(!empty($posts) && is_array($posts))
                            @foreach($posts as $post)
                                @if(!empty($post['image_url']))
                                    <div class="wptb-item">
                                        <div class="wptb-item--image">
                                            <img src="{{ url('/proxy-image?url=' . urlencode($post['image_url'])) }}" alt="Instagram Post">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>No posts available.</p>
                        @endif
                    </div>
                </div> -->






            @php
                $contactInfo = App\Models\ContactInfo::first();
            @endphp
            <div class="wptb-icon-box1 style2">
                <div class="wptb-item--inner flex-start">
                    <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
                    <div class="wptb-item--holder">
                        <p class="wptb-item--description"><a href="mailto:mail@crestkerala.com">{{ $contactInfo->email ?? 'N/A' }}</a></p>
                    </div>
                </div>
            </div>
            <div class="wptb-icon-box1 style2">
                <div class="wptb-item--inner flex-start">
                    <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
                    <div class="wptb-item--holder">
                        <p class="wptb-item--description">
                            <a href="{{$contactInfo->map2 ?? '#'}}">
                                <span class="address-short">{!! Str::limit($contactInfo->address2, 20) !!}...</span>
                                <span class="address-full">{!! $contactInfo->address2 ?? 'Full address goes here' !!}</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="wptb-icon-box1 style2">
                <div class="wptb-item--inner flex-start">
                    <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
                    <div class="wptb-item--holder">
                        <p class="wptb-item--description">
                            <a href="{{$contactInfo->map1 ?? '#'}}">
                                <span class="address-short">{!! Str::limit($contactInfo->address1, 20) !!}...</span>
                                <span class="address-full">{!! $contactInfo->address1 ?? 'Full address goes here' !!}</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="wptb-icon-box1 style2">
                <div class="wptb-item--inner flex-start">
                    <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
                    <div class="wptb-item--holder">
                        <p class="wptb-item--description"><a href="tel:+98765432122811">{{ $contactInfo->phone ?? 'N/A' }}</a></p>
                    </div>
                </div>
            </div>

            @php $socialLinkInstagram = App\Models\SocialLinks::where('status', 0)->where('name', 'instagram')->first(); @endphp 
            @php $socialLinkFacebook = App\Models\SocialLinks::where('status', 0)->where('name', 'facebook')->first(); @endphp 
            @php $socialLinkYoutube = App\Models\SocialLinks::where('status', 0)->where('name', 'Youtube')->first(); @endphp 
            <h6>// Follow Us</h6>
            <div class="social-box style-square">
                <ul>
                    @if($socialLinkFacebook)   <li><a href="{{$socialLinkFacebook->link}}" class="bi bi-facebook"></a></li>   @endif
                    @if($socialLinkInstagram)  <li><a href="{{$socialLinkInstagram->link}}" class="bi bi-instagram"></a></li> @endif
                    @if($socialLinkYoutube)    <li><a href="{{$socialLinkYoutube->link}}" class="bi bi-youtube"></a></li>     @endif
                </ul>
            </div>
        </div>
    </div>

    @yield('content')

    @include('web-views.layouts._footer')
    <div class="totop">
    <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>


    <script src="{{asset('assets/web-assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/swiper-gl.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/appear.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/odometer.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/tilt.jquery.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/isotope-init.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/cursor-effect.js')}}"></script>
    <script src="{{asset('assets/web-assets/js/theme.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Toastr Script -->
    {!! Toastr::message() !!}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    @stack('script')
    <script>
  const swiperCustom = new Swiper(".custom-swiper-3-slides", {
    loop: true,
    spaceBetween: 30,
    pagination: {
      el: ".custom-swiper-3-slides .swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".custom-swiper-3-slides .swiper-button-next",
      prevEl: ".custom-swiper-3-slides .swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      }
    }
  });
</script>
    <!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper('.swiper', {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true,
            autoplay: {
                delay: 3000, // 3 seconds between slides
                disableOnInteraction: false, // keeps autoplay going after swipe
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script> -->


</body>

</html>