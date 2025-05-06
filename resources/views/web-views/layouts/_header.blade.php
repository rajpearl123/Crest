<header class="header">
        <div class="header-inner">
            <div class="container-fluid pe-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="header_left_part d-flex align-items-center">
                        <div class="logo">
                            <a href="{{route('home')}}" class="light_logo"><img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->header_logo) : asset('assets/images/logo/logo.jpg') }}" alt="logo"></a>
                            <a href="{{route('home')}}" class="dark_logo"><img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->header_logo) : asset('assets/images/logo/logo.jpg') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="header_center_part d-none d-xl-block">
                        <div class="mainnav">
                            <ul class="main-menu">
                                <li class="menu-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="menu-item"><a href="{{route('aboutUs')}}">About Us</a></li>
                                <li class="menu-item menu-item-has-children">
                                    <a href="#">Services</a>
                                   <ul class="sub-menu" data-lenis-prevent="">
                                        <li class="menu-item"><a href="{{ route('services', ['slug' => 'wedding']) }}">Wedding</a></li>
                                        <li class="menu-item"><a href="{{ route('services', ['slug' => 'event']) }}">Events</a></li>
                                        <li class="menu-item"><a href="{{ route('services', ['slug' => 'video_production']) }}">Video Production</a></li>
                                        <li class="menu-item"><a href="{{ route('services', ['slug' => 'kids_photography']) }}">Kids Photography</a></li>
                                        <li class="menu-item"><a href="{{ route('services', ['slug' => 'product_photography']) }}">Product Photography</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children">
                                    <a href="#">Gallery</a>
                                    <ul class="sub-menu" data-lenis-prevent="">
                                        <!-- <li class="menu-item"><a href="{{route('gallery')}}">Photo Gallery</a></li> -->
                                        <li class="menu-item menu-item">
                                            <a href="{{ route('gallery') }}">Photo Gallery</a>
                                            <!-- <ul class="sub-menu" data-lenis-prevent="">
                                                @foreach($galleryCategories as $category)
                                                    <li class="menu-item">
                                                        <a href="{{ route('gallery', ['category' => $category->name]) }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul> -->
                                        </li>

                                        <li class="menu-item"><a href="{{route('videos')}}">Video Gallery</a></li>
                                    </ul>
                                </li>
                                <!-- <li class="menu-item"><a href="{{route('gallery')}}">Gallery</a></li> -->
                                <li class="menu-item"><a href="{{route('blogs')}}">Blogs</a></li>

                                <li class="menu-item menu-item-has-children">
                                    <a href="#">Packages</a>
                                   <ul class="sub-menu" data-lenis-prevent="">
                                        <li class="menu-item"><a href="{{ route('package.index') }}">Photography Packages</a></li>
                                        <li class="menu-item"><a href="{{ route('package.videoPackage') }}">Videography Packages</a></li>
                                        <li class="menu-item"><a href="{{ route('package.offerPackage') }}">Offers Packages</a></li>
                                        
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="{{route('contactUs')}}">Contact Us</a></li>
                                {{-- <li class="menu-item"><a href="{{route('package.index')}}">Packages</a></li> --}}

                                

                            </ul>
                        </div>
                    </div>
                    <div class="header_right_part d-flex align-items-center">
                        <div class="aside_open wptb-element">
                            <div class="aside-open--inner">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="header_search wptb-element">
                            <!-- <a href="#" class="modal_search_icon" data-bs-toggle="modal" data-bs-target="#modalSearch"><i class="bi bi-search"></i></a> -->
                        </div>
                        <button type="button" class="mr_menu_toggle wptb-element d-xl-none">
                     <i class="bi bi-list"></i>
                     </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mr_menu" data-lenis-prevent="">
        <button type="button" class="mr_menu_close"><i class="bi bi-x-lg"></i></button>
        <div class="logo"></div>
        <h6>Menu</h6>
        <div class="mr_navmenu"></div>
        <h6>Contact Us</h6>
        <div class="wptb-icon-box1 style2">
            <div class="wptb-item--inner flex-start">
                <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
                <div class="wptb-item--holder">
                    <p class="wptb-item--description"><a href="mailto:mail@crestkerala.com">mail@crestkerala.com</a></p>
                </div>
            </div>
        </div>
        <div class="wptb-icon-box1 style2">
            <div class="wptb-item--inner flex-start">
                <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
                <div class="wptb-item--holder">
                    <p class="wptb-item--description"><a href="contact-1.html">28 Street, New York, USA</a></p>
                </div>
            </div>
        </div>
        <div class="wptb-icon-box1 style2">
            <div class="wptb-item--inner flex-start">
                <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
                <div class="wptb-item--holder">
                    <p class="wptb-item--description"><a href="tel:+98765432122811">(+987) 654 321 228 11</a></p>
                </div>
            </div>
        </div>
        <h6>Find Our Page</h6>
        <div class="social-box">
            <ul>
                <li><a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a></li>
                <li><a href="https://www.linkedin.com/"><i class="bi bi-linkedin"></i></a></li>
                <li><a href="https://www.behance.com/"><i class="bi bi-behance"></i></a></li>
                <li><a href="https://www.youtube.com/"><i class="bi bi-youtube"></i></a></li>
            </ul>
        </div>
    </div>