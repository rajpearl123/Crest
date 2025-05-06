@php
$websiteSetting = \App\Models\WebsiteSetting::first()
@endphp

@extends('web-views.layouts.app')
@section('title', $websiteSetting->name)
@section('content')




    <main>
        <section class="wptb-slider style5 p-0">
            <div class="wptb-page-heading px-0">
            <div class="wptb-item--inner" style="background-image: url('{{ $banner && $banner->banner_img ? asset('uploads/page_banners/' . $banner->banner_img) : asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg') }}');">

                    <h2 class="wptb-item--title">{{$title}}</h2>
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
                                    <h1 class="wptb-item--title mb-lg-0">{{$title}}</h1>
                                </div>

                                <div class="col-lg-7">
                                    <p class="wptb-item--description">The talent at Crest runs wide and deep. Across many markets, geographies &amp; typologies, our team members are some of the finest professionals in the industry wide and deep. Across many markets, geographies and typologies,
                                        our team members are some of the finest.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        // Ensure there are images available
                        $randomImages = [];
                        if (!empty($album->image_url) && is_array($album->image_url)) {
                            // Get random images
                            $randomImages = collect($album->image_url)->shuffle()->take(2);
                        }
                    @endphp

                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <!-- Post Image -->
                            <figure class="block-gallery mb-4">
                                <img class="w-100" src="{{ !empty($randomImages[0]) ? asset($randomImages[0]) : 'https://via.placeholder.com/800' }}" alt="img">
                            </figure>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <!-- Post Image -->
                            <figure class="block-gallery mb-4">
                                <img src="{{ !empty($randomImages[1]) ? asset($randomImages[1]) : 'https://via.placeholder.com/400' }}" alt="img">
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


        @php
            function getYoutubeThumbnail($url) {
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches);
                if (isset($matches[1])) {
                    $videoId = $matches[1];
                    // YouTube Thumbnail URLs (Fallback in order)
                    $thumbnails = [
                        "https://i.ytimg.com/vi/{$videoId}/maxresdefault.jpg", // Best quality (sometimes unavailable)
                        "https://i.ytimg.com/vi/{$videoId}/hqdefault.jpg",    // High quality
                        "https://i.ytimg.com/vi/{$videoId}/mqdefault.jpg",    // Medium quality
                        "https://i.ytimg.com/vi/{$videoId}/default.jpg"      // Low quality
                    ];
                    return $thumbnails[0]; // Use the best available
                }
                return asset('default-thumbnail.jpg'); // Default fallback if not a YouTube link
            }
        @endphp

        <div class="">
            <div class="wptb-video-player1 wow zoomIn mr-bottom-70 bg-image animated"
                style="background-image: url('{{ $homeVideo && $homeVideo->video_link ? getYoutubeThumbnail($homeVideo->video_link) : asset('default-thumbnail.jpg') }}'); visibility: visible;">
                <div class="wptb-item--inner">
                    <div class="wptb-item--holder">
                        <div class="wptb-item--video-button">
                            @if($homeVideo && ($homeVideo->video_file || $homeVideo->video_link))
                                <a class="btn" data-fancybox="" 
                                href="{{ $homeVideo->video_file ? asset($homeVideo->video_file) : $homeVideo->video_link }}">
                                    <span class="text-second"> <i class="bi bi-play-fill"></i> </span>
                                    <span class="line-video-animation line-video-1"></span>
                                    <span class="line-video-animation line-video-2"></span>
                                    <span class="line-video-animation line-video-3"></span>
                                </a>
                            @else
                                <p class="text-white text-center">No video available</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="wptb-item-layer wptb-item-layer-one">
                    <img src="{{ asset('assets/web-assets/assets/img/more/light-3.png') }}" alt="img">
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
                        <div class="grid grid-3 gutter-10 clearfix" style="position: relative;">
                            <div class="grid-sizer"></div>

                            @php
                                $positions = [
                                    ['left' => '0%', 'top' => '0px'],
                                    ['left' => '33.3294%', 'top' => '0px'],
                                    ['left' => '66.6588%', 'top' => '0px'],
                                    ['left' => '33.3294%', 'top' => '338.569px'],
                                    ['left' => '0%', 'top' => '570.08px'],
                                    ['left' => '66.6588%', 'top' => '570.08px'],
                                    ['left' => '33.3294%', 'top' => '909.745px']
                                ];
                            @endphp

                            @if(!empty($album->image_url) && is_array($album->image_url))
                                @foreach($album->image_url as $index => $image)
                                    @php
                                        $pos = $positions[$index % count($positions)];
                                    @endphp

                                    <div class="grid-item" style="position: absolute; left: {{ $pos['left'] }}; top: {{ $pos['top'] }};">
                                        <div class="wptb-item--inner">
                                            <div class="wptb-item--image">
                                                <img src="{{ asset($image) }}" alt="{{ $album->title }}">
                                            </div>

                                            <div class="wptb-item--holder">
                                                <div class="wptb-item--meta">
                                                    <h4><a href="project-details.html">{{ $album->title }}</a></h4>
                                                    <p>By Jonathon Willson</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p style="text-align: center;">No Images Available</p>
                            @endif
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
    