@php
$websiteSetting = \App\Models\WebsiteSetting::first()
@endphp

@extends('web-views.layouts.app')
@section('title', $websiteSetting->name)
@section('content')


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
                    <p class="wptb-item--description"><a href="mailto:kimocare@gmail.com">kimocare@gmail.com</a></p>
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
    <div class="aside_info_wrapper" data-lenis-prevent="">
        <button class="aside_close">Close <i class="bi bi-x-lg"></i></button>
        <div class="aside_logo logo">
            <a href="index.html" class="light_logo"><img src="images/" alt="logo"></a>
            <a href="index.html" class="dark_logo"><img src="images/" alt="logo"></a>
        </div>
        <div class="aside_info_inner">
            <h6>// Instagram</h6>
            <div class="insta-logo">
                <i class="bi bi-instagram"></i> studio_Crest
            </div>
            <div class="wptb-instagram--gallery">
                <div class="wptb-item--inner d-flex align-items-center justify-content-center flex-wrap">
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/images/6.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/mages/7.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/images/8.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/images/9.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/images/10.jpg')}}" alt="img">
                        </div>
                    </div>
                    <div class="wptb-item">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/images/11.jpg')}}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
            <div class="wptb-icon-box1 style2">
                <div class="wptb-item--inner flex-start">
                    <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
                    <div class="wptb-item--holder">
                        <p class="wptb-item--description"><a href="mailto:kimocare@gmail.com">kimocare@gmail.com</a></p>
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
            <h6>// Follow Us</h6>
            <div class="social-box style-square">
                <ul>
                    <li><a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="https://www.linkedin.com/"><i class="bi bi-linkedin"></i></a></li>
                    <li><a href="https://www.behance.com/"><i class="bi bi-behance"></i></a></li>
                    <li><a href="https://www.youtube.com/"><i class="bi bi-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
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
        <section class="wptb-slider style5 p-0">
            <div class="wptb-page-heading px-0">
                <div class="wptb-item--inner" style="background-image: url('https://img.freepik.com/free-photo/circle-cameras-film_23-2147852399.jpg');">

                    <h2 class="wptb-item--title">Wedding Photography</h2>
                </div>
            </div>
        </section>
        <section class="blog-details mt-5">
            <div class="container">
                <div class="blog-details-inner">
                    <div class="wptb-heading">
                        <div class="wptb-item--inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <h1 class="wptb-item--title mb-lg-0">Wedding Photography</h1>
                                </div>

                                <div class="col-lg-7">
                                    <p class="wptb-item--description">The talent at Crest runs wide and deep. Across many markets, geographies &amp; typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies,
                                        our team members are some of the finest.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <!-- Post Image -->
                            <figure class="block-gallery mb-4">
                                <img class="w-100" src="https://www.thephototoday.in/wp-content/uploads/2024/06/A-Symphony-of-Love-Capturing-the-Essence-of-South-Indian-Bridal-Beauty-2.jpg" alt="img">
                            </figure>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <!-- Post Image -->
                            <figure class="block-gallery mb-4">
                                <img src="https://i.pinimg.com/736x/3e/37/18/3e3718a25f257953adc25a7b42d1dee6.jpg" alt="img">
                            </figure>
                        </div>
                    </div>

                    <div class="row mr-top-90">
                        <div class="col-lg-8 col-md-8 pd-right-70">
                            <div class="post-content">
                                <div class="fulltext">
                                    <!-- Start Section -->
                                    <h4 class="widget-title mt-0">Service Steps</h4>
                                    <p>The talent at Crest runs wide and deep. Across many markets, geographies &amp; typologies, our team members are some of the finest professionals in the industry wide and deep. </p>

                                    <ul class="point-order">
                                        <li><i class="bi bi-check2-all"></i> The talent at Crest runs wide and deep. Across many markets, geographies</li>
                                        <li><i class="bi bi-check2-all"></i> Our team members are some of the finest professionals in the industry</li>
                                        <li><i class="bi bi-check2-all"></i> Organized to deliver the most specialized service possible and enriched by the</li>
                                    </ul>

                                    <p>The talent at Crest runs wide and deep. Across many markets, geographies &amp; typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies,
                                        our team members are some of the finest.</p>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 mt-5 mt-md-0">
                            <div class="wptb-counter1 mr-bottom-70 style1 wow skewIn animated" style="visibility: visible;">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder d-flex align-items-center">
                                        <div class="wptb-item--value flex-shrink-0"><span class="odometer odometer-auto-theme" data-count="350"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">3</span></span>
                                            </span>
                                            </span>
                                            </span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span>
                                            </span>
                                            </span>
                                            </span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span>
                                            </span>
                                            </span>
                                            </span>
                                        </div>
                                        </span><span class="suffix">+</span></div>
                                    <div class="wptb-item--text">Photography Session</div>
                                </div>
                            </div>
                        </div>

                        <div class="wptb-counter1 mr-bottom-70 style1 wow skewIn animated" style="visibility: visible;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--holder d-flex align-items-center">
                                    <div class="wptb-item--value"><span class="odometer odometer-auto-theme" data-count="100"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">1</span></span>
                                        </span>
                                        </span>
                                        </span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span>
                                        </span>
                                        </span>
                                        </span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span>
                                        </span>
                                        </span>
                                        </span>
                                    </div>
                                    </span><span class="suffix">%</span></div>
                                <div class="wptb-item--text">Customer Satisfaction</div>
                            </div>
                        </div>
                    </div>

                    <div class="wptb-counter1 style1 wow skewIn animated" style="visibility: visible;">
                        <div class="wptb-item--inner">
                            <div class="wptb-item--holder d-flex align-items-center">
                                <div class="wptb-item--value flex-shrink-0"><span class="odometer odometer-auto-theme" data-count="50"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span>
                                    </span>
                                    </span>
                                    </span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span>
                                    </span>
                                    </span>
                                    </span>
                                </div>
                                </span><span class="suffix">+</span></div>
                            <div class="wptb-item--text">Experienced Photographers</div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </section>
        <div class="">
            <div class="wptb-video-player1 wow zoomIn mr-bottom-70 bg-image animated animated" style="background-image: url(&quot;https://wp.missmalini.com/wp-content/uploads/2023/12/Untitled-design-2023-12-21T164430.774.png&quot;); visibility: visible;">
                <div class="wptb-item--inner">
                    <div class="wptb-item--holder">
                        <div class="wptb-item--video-button">
                            <a class="btn" data-fancybox="" href="https://youtu.be/tyBJioe8gOs?si=HaVzipIjN8zWAV1Q">
                                <span class="text-second"> <i class="bi bi-play-fill"></i> </span>
                                <span class="line-video-animation line-video-1"></span>
                                <span class="line-video-animation line-video-2"></span>
                                <span class="line-video-animation line-video-3"></span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="wptb-item-layer wptb-item-layer-one">
                    <img src="../assets/img/more/light-3.png" alt="img">
                </div>
            </div>
        </div>

        <section class="wptb-project">
            <div class="container">
                <div class="wptb-heading">
                    <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item--subtitle"> Photo Albums</h6>
                        <h1 class="wptb-item--title"> Crest captures <span>All of Your</span> <br> beautiful memories</h1>
                    </div>
                </div>

                <div class="style-masonry effect-blur">
                    <div class="grid grid-3 gutter-10 clearfix" style="position: relative; height: 1296.64px;">
                        <div class="grid-sizer"></div>
                        <div class="grid-item" style="position: absolute; left: 0%; top: 0px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://www.thephototoday.in/wp-content/uploads/2024/06/A-Symphony-of-Love-Capturing-the-Essence-of-South-Indian-Bridal-Beauty-2.jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">Bright Boho Sunshine</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item" style="position: absolute; left: 33.3294%; top: 0px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://www.candidshutters.com/maintenance/wp-content/uploads/2024/06/Best-wedding-photographers-India-Top-5-destination-wedding-photographers-Indian-weddings-2.jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">California Fall Collection 2023</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item" style="position: absolute; left: 66.6588%; top: 0px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://images.pexels.com/photos/22820942/pexels-photo-22820942.jpeg?cs=srgb&dl=pexels-asha-avinash-1235239562-22820942.jpg&fm=jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">Brown girl next door</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item" style="position: absolute; left: 33.3294%; top: 338.569px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://i.pinimg.com/736x/23/72/68/2372680876979fd7b634051233958ec2.jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">Wedding  next stage</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item" style="position: absolute; left: 0%; top: 570.08px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://i.pinimg.com/736x/fd/26/a4/fd26a42294c2d5d6a27d8f307f9db28d.jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">Jenifer in green</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item" style="position: absolute; left: 66.6588%; top: 570.08px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://www.focuzstudios.in/wp-content/uploads/2023/02/candid-wedding-photographers-in-chennai-44.jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">Sunflower Boho girl</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid-item" style="position: absolute; left: 33.3294%; top: 909.745px;">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <img src="https://www.focuzstudios.in/wp-content/uploads/2023/02/south-indian-wedding-photography-in-chennai-33.jpg" alt="img">
                                </div>

                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="project-details.html">Iceland girl</a></h4>
                                        <p>By Jonathon Willson</p>
                                    </div>
                                </div>
                            </div>
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
    