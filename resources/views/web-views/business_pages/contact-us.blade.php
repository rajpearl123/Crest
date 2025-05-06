@php
 $websiteSetting = \App\Models\WebsiteSetting::first();
@endphp
@extends('web-views.layouts.app')
@section('title', $websiteSetting->name . " | Contact Us")
@section('content')
@php
    $banner = getBanner('contact_us');
@endphp

@php $socialLinkInstagram = App\Models\SocialLinks::where('status', 0)->where('name', 'instagram')->first(); @endphp 
@php $socialLinkFacebook = App\Models\SocialLinks::where('status', 0)->where('name', 'facebook')->first(); @endphp 
@php $socialLinkTwitter = App\Models\SocialLinks::where('status', 0)->where('name', 'twitter')->first(); @endphp 
@php $socialLinkPinterest = App\Models\SocialLinks::where('status', 0)->where('name', 'pinterest')->first(); @endphp 
@php $socialLinkLinkdin = App\Models\SocialLinks::where('status', 0)->where('name', 'linkedin')->first(); @endphp 
@php $socialLinkYoutube = App\Models\SocialLinks::where('status', 0)->where('name', 'Youtube')->first(); @endphp 
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp


    <div class="search-modal">
        <div class="modal fade" id="modalSearch">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="search_overlay">
                        <form class="credential-form" method="post">
                            <div class="form-group">
                                <input type="text" name="search" class="keyword form-control" placeholder="Search Here">
                            </div>
                            <button type="submit" class="btn-search">
                        <span class="text-first"> <i class="bi bi-arrow-right"></i> </span>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        <section class="wptb-slider style5 p-0">
            <div class="wptb-page-heading px-0">
                <div class="wptb-item--inner" style="background-image: url('{{ $banner && $banner->banner_img ? asset('uploads/page_banners/' . $banner->banner_img) : asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg') }}');">

                    <h2 class="wptb-item--title">Contact Us</h2>
                </div>
            </div>
        </section>

        <section class="contact-section my-4">
            <div class="container">
                <div class="row">
                    <!-- Contact Form -->
                    <div class="col-md-7 my-4">
                        <div class="contact-info p-4">
                            <h4 class="fw-bold">Send Us a Message</h4>
                            <form action="{{ route('contactUs-store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="number" name="phone" class="form-control" placeholder="Enter your mobile number" pattern="[0-9]{10}" required>
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Enter your subject">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="4" name="message" placeholder="Write your message here"></textarea>
                                </div>

                                <button type="submit" class="btn btn-custom w-100">Send Message</button>
                            </form>

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                    </div>
                    <!-- Contact Information -->
                    <div class="col-md-5 my-4">
                        <div class="contact-info p-4">
                            <h4 class="fw-bold">Contact Details</h4>
                            <p class="text-muted">Get in Touch with Us</p>
                            <div class="d-flex align-items-center gap-1 mb-3">
                                <i class="fas fa-map-marker-alt"></i>
                                <p class="mb-0">{!! $contactInfo->address2 ?? 'N/A' !!}</p>
                            </div>
                            <div class="d-flex align-items-center gap-1 mb-3">
                                <i class="fas fa-map-marker-alt"></i>
                                <p class="mb-0">{!! $contactInfo->address1 ?? 'N/A' !!}</p>
                            </div>
                            <div class="d-flex align-items-center gap-1 mb-3">
                                <i class="fas fa-phone-alt"></i>
                                <p class="mb-0">{{ $contactInfo->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="d-flex align-items-center gap-1 mb-3">
                                <i class="fas fa-envelope"></i>
                                <p class="mb-0">{{ $contactInfo->email ?? 'N/A' }}</p>
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
                        
                        <div class="mt-4">
                            <iframe src="{{$contactInfo->map2}}"
                                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>


    <div class="totop">
        <a href="#"><i class="bi bi-chevron-up"></i></a>
    </div>
   @endsection