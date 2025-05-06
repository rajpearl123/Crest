@php $socialLinkInstagram = App\Models\SocialLinks::where('status', 0)->where('name', 'instagram')->first(); @endphp 
@php $socialLinkFacebook = App\Models\SocialLinks::where('status', 0)->where('name', 'facebook')->first(); @endphp 
@php $socialLinkTwitter = App\Models\SocialLinks::where('status', 0)->where('name', 'twitter')->first(); @endphp 
@php $socialLinkPinterest = App\Models\SocialLinks::where('status', 0)->where('name', 'pinterest')->first(); @endphp 
@php $socialLinkLinkdin = App\Models\SocialLinks::where('status', 0)->where('name', 'linkedin')->first(); @endphp 
@php $socialLinkYoutube = App\Models\SocialLinks::where('status', 0)->where('name', 'Youtube')->first(); @endphp 
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp

 <!--Footer Area Start Here-->
 <footer class="footer style1">
        <div class="footer-top">
            <div class="container">
                <div class="footer--inner">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-5 mb-md-0">
                            <div class="footer-widget">
                                <div class="footer-nav">
                                    <ul>
                                        <li class="menu-item"><a href="{{route('aboutUs')}}">About Us</a></li>
                                        <!-- <li class="menu-item"><a href="team-1.html">Our Team</a></li> -->
                                        <!-- <li class="menu-item"><a href="packages.html">Packages</a></li> -->
                                        <li class="menu-item"><a href="{{route('gallery')}}">Gallery</a></li>
                                        <li class="menu-item"><a href="{{ route('services', ['slug' => 'wedding']) }}">Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-5 mb-md-0 order-1 order-md-0">
                            <div class="footer-widget text-center">
                                <div class="logo mr-bottom-55">
                                    <a href="index.html" class=""><img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->footer_logo) : asset('assets/images/logo/logo.jpg') }}" alt="logo"></a>
                                </div>
                                <h6 class="widget-title">Sign up for all the latest <br> news and offers </h6>
                                <form class="newsletter-form" action="{{ route('subscribe') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required="">
                                    </div>
                                    <button type="submit" class="btn btn-two">
                                        <span class="btn-wrap">
                                        <span class="text-first">Subscribe</span>
                                        <span class="text-second"><i class="bi bi-arrow-up-right"></i> <i class="bi bi-arrow-up-right"></i></span>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-5 mb-md-0">
                            <div class="footer-widget text-md-end">
                                <div class="footer-nav">
                                    <ul>
                                        <!-- <li class="menu-item"><a href="#">Booking</a></li> -->
                                        <!-- <li class="menu-item"><a href="shop.html">Products</a></li> -->
                                        <li class="menu-item"><a href="{{route('blogs')}}">Recent Posts</a></li>
                                        <!-- <li class="menu-item"><a href="blog-grid.html">Latest News</a></li> -->
                                        <li class="menu-item"><a href="{{route('contactUs')}}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-inner">
                    <div class="copyright">
                        <p>
                            <a href="https://themeforest.net/user/wpthemebooster"></a>{{ $websiteSetting->copyright}}
                        </p>
                    </div>
                    <div class="social-box style-oval">
                        <ul>
                            @if($socialLinkFacebook)
                            <li>
                                <a href="{{$socialLinkFacebook->link}}" class="bi bi-facebook"></a>
                            </li>
                            @endif
                            
                            @if($socialLinkInstagram)
                            <li>
                                <a href="{{$socialLinkInstagram->link}}" class="bi bi-instagram"></a>
                            </li>
                            @endif

                            @if($socialLinkLinkdin)
                            <li>
                                <a href="{{$socialLinkLinkdin->link}}" class="bi bi-linkedin"></a>
                            </li>
                            @endif

                            @if($socialLinkYoutube)
                            <li>
                                <a href="{{$socialLinkYoutube->link}}" class="bi bi-youtube"></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>