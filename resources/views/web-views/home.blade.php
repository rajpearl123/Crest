@php $socialLinkInstagram = App\Models\SocialLinks::where('status', 0)->where('name', 'instagram')->first(); @endphp
@php $socialLinkFacebook = App\Models\SocialLinks::where('status', 0)->where('name', 'facebook')->first(); @endphp
@php $socialLinkTwitter = App\Models\SocialLinks::where('status', 0)->where('name', 'twitter')->first(); @endphp
@php $socialLinkPinterest = App\Models\SocialLinks::where('status', 0)->where('name', 'pinterest')->first(); @endphp
@php $socialLinkLinkdin = App\Models\SocialLinks::where('status', 0)->where('name', 'linkedin')->first(); @endphp
@php $socialLinkBehance = App\Models\SocialLinks::where('status', 0)->where('name', 'behance')->first(); @endphp
@php $websiteSetting = \App\Models\WebsiteSetting::first() @endphp


@extends('web-views.layouts.app')
@section('title', $websiteSetting->name . ' | Home')
@section('content')



    <main class="wrapper">


        <section class="wptb-slider style5 p-0">
            <div class="swiper-container wptb-swiper-slider-five swiper-fade swiper-initialized swiper-horizontal swiper-autoheight swiper-watch-progress swiper-backface-hidden"
                style="height: 489px;">
                <div class="swiper-wrapper" id="swiper-wrapper-b0e10d072eac26f11" aria-live="off"
                    style="height: 489px; transition-duration: 0ms; transition-delay: 0ms;">


                    @foreach ($banners as $key => $banner)
                        <div class="swiper-slide {{ $key == 0 ? 'swiper-slide-active' : '' }}" role="group"
                            aria-label="{{ $key + 1 }} / {{ count($banners) }}"
                            data-swiper-slide-index="{{ $key }}"
                            style="height: 489px; width: 1307px; opacity: 1; transform: translate3d(-{{ $key * 1307 }}px, 0px, 0px); transition-duration: 0ms;">
                            <div class="wptb-slider--item">
                                <div class="wptb-slider--image"
                                    style="background-image: url('{{ asset($banner->image) }}');"></div>
                                <div class="wptb-slider--inner">
                                    <div class="wptb-item--inner">
                                        <div class="container">
                                            <div class="wptb-heading banner-bg text-center">
                                                <h6 class="wptb-item--subtitle">{{ $banner->subtitle }}</h6>
                                                <h1 class="wptb-item--title">{{ $banner->title }}</h1>
                                                <div class="wptb-item--button">
                                                    <a class="btn btn-two white" href="{{ $banner->button_link_1 }}">
                                                        <span class="btn-wrap">
                                                            <span class="text-first">Book Crest</span>
                                                            <span class="text-second"><i class="bi bi-arrow-up-right"></i>
                                                                <i class="bi bi-arrow-up-right"></i></span>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-two creative" href="{{ $banner->button_link_2 }}">
                                                        <span class="btn-wrap">
                                                            <span class="text-first">Explore Now</span>
                                                            <span class="text-second"><i class="bi bi-arrow-up-right"></i>
                                                                <i class="bi bi-arrow-up-right"></i></span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
            <div class="wptb-swiper-navigation style2 d-none d-lg-flex">
                <div class="wptb-swiper-arrow swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                    aria-controls="swiper-wrapper-b0e10d072eac26f11"></div>
                <div class="wptb-swiper-arrow swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                    aria-controls="swiper-wrapper-b0e10d072eac26f11"></div>
            </div>
            <div class="wptb-bottom-pane justify-content-center d-lg-none">
                <div class="wptb-swiper-dots style2">
                    <div
                        class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                        <span class="swiper-pagination-bullet" tabindex="0" role="button"
                            aria-label="Go to slide 1"></span><span
                            class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button"
                            aria-label="Go to slide 2" aria-current="true"></span>
                        <span class="swiper-pagination-bullet" tabindex="0" role="button"
                            aria-label="Go to slide 3"></span>
                    </div>
                </div>
                <div class="wptb-swiper-navigation style3">
                    <div class="wptb-swiper-arrow swiper-button-prev" tabindex="0" role="button"
                        aria-label="Previous slide" aria-controls="swiper-wrapper-b0e10d072eac26f11"></div>
                    <div class="wptb-swiper-arrow swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                        aria-controls="swiper-wrapper-b0e10d072eac26f11"></div>
                </div>
            </div>

        </section>
        <section class="wptb-services-one pd-bottom-80 bg-image-4"
            style="background-image: url('{{ asset('assets/web-assets/images/texture-3-light.png') }}'); background-position: 50% -16%;">
            <div class="container position-relative">
                <div class="wptb-heading-two">
                    <div class="wptb-item--inner text-center">
                        <!-- <h6 class="wptb-item--subtitle">Photography</h6> -->
                        <h1 class="wptb-item--title"> Explore Crest <br> Photography <span>Services</span> </h1>
                        <div class="wptb-item--description">
                            Crest photography Agency runs wide and deep. Across many <br> markets, geographies & typologies,
                            our team members
                        </div>
                    </div>
                </div>
                <!-- Swiper Slider for Mobile -->
                <div class="swiper d-md-none">
                    <div class="swiper-wrapper">
                        @foreach ($services as $index => $step)
                            <div class="swiper-slide">
                                <div class="wptb-icon-box7 mb-0">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--icon">
                                            @if ($step->image)
                                                <img src="{{ asset($step->image) }}" alt="{{ $step->title }}">
                                            @else
                                                <img src="{{ asset('assets/web-assets/images/default-icon.svg') }}"
                                                    alt="Default Icon">
                                            @endif
                                        </div>
                                        <div class="wptb-item--holder">
                                            <h4 class="wptb-item--title"><a href="">{{ $step->title }}</a></h4>
                                            <p class="wptb-item--description">{{ $step->description }}</p>
                                            <h6 class="wptb-item--count text-outline">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- Original Grid for Desktop -->
                <div class="row d-none d-md-flex">
                    @foreach ($services as $index => $step)
                        <div class="col-md-4 pd-left-25 pd-right-25 wow fadeInLeft">
                            <div class="wptb-icon-box7 mb-0">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--icon">
                                        @if ($step->image)
                                            <img src="{{ asset($step->image) }}" alt="{{ $step->title }}">
                                        @else
                                            <img src="{{ asset('assets/web-assets/images/default-icon.svg') }}"
                                                alt="Default Icon">
                                        @endif
                                    </div>
                                    <div class="wptb-item--holder">
                                        <h4 class="wptb-item--title"><a href="">{{ $step->title }}</a></h4>
                                        <p class="wptb-item--description">{{ $step->description }}</p>
                                        <h6 class="wptb-item--count text-outline">
                                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="grid_lines">
                    <div class="grid_line"></div>
                    <div class="grid_line"></div>
                    <div class="grid_line"></div>
                    <div class="grid_line"></div>
                </div>
            </div>
        </section>
        <div class="divider-line-hr"></div>
        <section class="wptb-about-three">
            <div class="wptb-item-layer wptb-item-layer-one both-version">
                <img src="{{ asset('assets/web-assets/images/overlay-1.png') }}" alt="img">
                <img src="{{ asset('assets/web-assets/images/overlay-1-light.png') }}" alt="img">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="wptb-heading-two">
                            <div class="wptb-item--inner">
                                <!-- <h6 class="wptb-item--subtitle">{{ $section->subtitle ?? 'Default Subtitle' }}</h6> -->
                                <h1 class="wptb-item--title">{{ $section->title ?? 'Default Title' }}</h1>
                                <div class="wptb-item--description">{{ $section->description ?? 'Default Description' }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-10">
                                @foreach (json_decode($section->progress_bars ?? '[]', true) as $progress)
                                    <div class="wptb-progressbar mb-4">
                                        <div class="wptb-progressbar--inner">
                                            <div class="wptb-progress--label">{{ $progress['label'] }}</div>
                                            <div class="progress" style="height: 3px;">
                                                <div class="progress-bar bg-one" role="progressbar"
                                                    style="width: {{ $progress['value'] }}%" aria-valuemin="0"
                                                    aria-valuemax="100"><span
                                                        class="wptb-progress--value">{{ $progress['value'] }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mr-top-50 mr-bottom-50 d-inline-block w-100"></div>
                        <h4 class="widget-title"><span>//</span>{{ $features->first()->title ?? 'Why Choose Us' }}</h4>
                        <p>{{ $features->first()->description ?? 'Default description' }}</p>
                        <div class="row">
                            @foreach ($features->chunk(3) as $chunk)
                                <div class="col-md-6">
                                    <div class="wptb-list1">
                                        @foreach ($chunk as $feature)
                                            <div class="wptb--item wow skewIn" data-wow-delay="700ms">
                                                <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                                <div class="wptb-item--text">{{ $feature->feature_text }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mr-top-50 mr-bottom-50 d-inline-block w-100"></div>
                        <h4 class="widget-title"><span>//</span>Crest Operation</h4>
                        <p>{{ $section->op_desc ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod unt ut labore et dolore magna aliqua. Ut enim ad minim.' }}
                        </p>
                        <div class="row">
                            @foreach ($op_data as $index => $item)
                                <div class="col-md-6 mr-bottom-75 {{ $index % 2 == 0 ? 'pe-md-5' : 'mb-md-0 pe-md-5' }}">
                                    <div class="wptb-counter1 style1 position-relative z-index-3 wow skewIn">
                                        <div class="wptb-item--inner">
                                            <div class="wptb-item--holder d-flex align-items-center">
                                                <div class="wptb-item--value {{ $index % 2 != 0 ? 'flex-shrink-0' : '' }}"
                                                    aria-label="{{ $item['op_title'] }}: {{ $item['op_data'] }}{{ $item['suffix'] ?? '+' }}">
                                                    <span class="odometer" data-count="{{ $item['op_data'] }}"></span>
                                                    <span class="suffix">{{ $item['suffix'] ?? '+' }}</span>
                                                </div>
                                                <div class="wptb-item--text">{{ $item['op_title'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-4 offset-xl-1">
                        <div class="wptb-gallery-box">
                            <div class="swiper-container swiper-gallery-left">
                                <div class="swiper-wrapper">
                                    @foreach ($randomImages as $image)
                                        <div class="swiper-slide">
                                            <div class="wptb-slider--item">
                                                <div class="wptb-slider--image">
                                                    <img src="{{ asset($image) }}" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="swiper-container swiper-gallery-right">
                                <div class="swiper-wrapper">
                                    @foreach ($randomImages as $image)
                                        <div class="swiper-slide">
                                            <div class="wptb-slider--item">
                                                <div class="wptb-slider--image">
                                                    <img src="{{ asset($image) }}" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wptb-item-layer wptb-item-layer-two both-version">
                <img src="{{ asset('assets/web-assets/images/overlay-2.png') }}" alt="img">
                <img src="{{ asset('assets/web-assets/images/overlay-2-light.png') }}" alt="img">
            </div>
        </section>

        @php
            function getYoutubeThumbnail($url)
            {
                preg_match(
                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/',
                    $url,
                    $matches,
                );
                if (isset($matches[1])) {
                    $videoId = $matches[1];
                    // YouTube Thumbnail URLs (Fallback in order)
                    $thumbnails = [
                        "https://i.ytimg.com/vi/{$videoId}/maxresdefault.jpg", // Best quality (sometimes unavailable)
                        "https://i.ytimg.com/vi/{$videoId}/hqdefault.jpg", // High quality
                        "https://i.ytimg.com/vi/{$videoId}/mqdefault.jpg", // Medium quality
                        "https://i.ytimg.com/vi/{$videoId}/default.jpg", // Low quality
                    ];
                    return $thumbnails[0]; // Use the best available
                }
                return asset('default-thumbnail.jpg'); // Default fallback if not a YouTube link
            }
        @endphp

        <div class="">
            <div class="wptb-video-player1 wow zoomIn mr-bottom-70 bg-image animated"
                style="background-image: url('{{ $homeVideo && $homeVideo->thumbnail && $homeVideo->video_file ? asset($homeVideo->thumbnail) : ($homeVideo && $homeVideo->video_link ? getYoutubeThumbnail($homeVideo->video_link) : asset('default-thumbnail.jpg')) }}'); visibility: visible;">
                <div class="wptb-item--inner">
                    <div class="wptb-item--holder">
                        <div class="wptb-item--video-button">
                            @if ($homeVideo && ($homeVideo->video_file || $homeVideo->video_link))
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

        <section class="wptb-project pt-0">
            <div class="container">
                <div class="wptb-heading-two">
                    <div class="wptb-item--inner text-center">
                        <h6 class="wptb-item--subtitle">Crest Projects</h6>
                        <h1 class="wptb-item--title"> Explore Crest <br> Photography <span>Projects</span> </h1>
                        <div class="wptb-item--description">
                            @php
                                $halfLength = ceil(strlen($album->description) / 2);
                                $firstHalf = substr($album->description, 0, $halfLength);
                                $secondHalf = substr($album->description, $halfLength);
                            @endphp

                            {!! $firstHalf . '<br>' . $secondHalf !!}
                        </div>
                    </div>
                </div>
                <!-- Swiper for Mobile View -->
                <div class="swiper d-md-none style-masonry effect-blur">
                    <div class="swiper-wrapper">
                        @foreach ($HomeAlbum->album as $index => $album)
                            <div class="swiper-slide">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{ asset($album['src'] ?? 'assets/web-assets/images/default-icon.svg') }}"
                                            alt="img">
                                    </div>
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a>{{ $album['img_title'] }}</a></h4>
                                            <p>{{ $album['author'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Original Masonry Grid for Desktop -->
                <div class="style-masonry effect-blur d-none d-md-block">
                    <div class="grid grid-3 gutter-10 clearfix">
                        <div class="grid-sizer"></div>
                        @foreach ($HomeAlbum->album as $index => $album)
                            <div class="grid-item">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <img src="{{ asset($album['src'] ?? 'assets/web-assets/images/default-icon.svg') }}"
                                            alt="img">
                                    </div>
                                    <div class="wptb-item--holder">
                                        <div class="wptb-item--meta">
                                            <h4><a>{{ $album['img_title'] }}</a></h4>
                                            <p>{{ $album['author'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
        <section class="wptb-testimonial-one bg-image"
            style="background-image: url('{{ asset('assets/web-assets/images/bg-3.jpg') }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="swiper-container swiper-testimonial">
                            <div class="swiper-wrapper">
                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="wptb-testimonial1">
                                            <div class="wptb-item--inner">
                                                <div class="wptb-item--holder">
                                                    <div
                                                        class="d-flex align-items-center justify-content-between mr-bottom-25">
                                                        <div class="wptb-item--meta-rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }}"></i>
                                                            @endfor
                                                        </div>
                                                        <div class="wptb-item--icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="57"
                                                                height="45" viewBox="0 0 57 45" fill="none">
                                                                <path
                                                                    d="M51.5137 38.5537C56.8209 32.7938 56.2866 25.3969 56.2697 25.3125V2.8125C56.2697 2.06658 55.9734 1.35121 55.4459 0.823763C54.9185 0.296317 54.2031 0 53.4572 0H36.5822C33.48 0 30.9572 2.52281 30.9572 5.625V25.3125C30.9572 26.0584 31.2535 26.7738 31.781 27.3012C32.3084 27.8287 33.0238 28.125 33.7697 28.125H42.4266C42.3671 29.5155 41.9517 30.8674 41.22 32.0513C39.7913 34.3041 37.0997 35.8425 33.2156 36.6188L30.9572 37.0688V45H33.7697C41.5969 45 47.5678 42.8316 51.5137 38.5537ZM20.5566 38.5537C25.8666 32.7938 25.3294 25.3969 25.3125 25.3125V2.8125C25.3125 2.06658 25.0162 1.35121 24.4887 0.823763C23.9613 0.296317 23.2459 0 22.5 0H5.625C2.52281 0 0 2.52281 0 5.625V25.3125C0 26.0584 0.296316 26.7738 0.823762 27.3012C1.35121 27.8287 2.06658 28.125 2.8125 28.125H11.4694C11.41 29.5155 10.9945 30.8674 10.2628 32.0513C8.83406 34.3041 6.1425 35.8425 2.25844 36.6188L0 37.0688V45H2.8125C10.6397 45 16.6106 42.8316 20.5566 38.5537Z"
                                                                    fill="#D70006"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <p class="wptb-item--description">“{{ $testimonial->review }}”</p>
                                                    <div class="wptb-item--meta">
                                                        <div class="wptb-item--image">
                                                            <img src="{{ asset($testimonial->image) }}"
                                                                alt="{{ $testimonial->name }}">
                                                        </div>
                                                        <div class="wptb-item--meta-left">
                                                            <h4 class="wptb-item--title">{{ $testimonial->name }}</h4>
                                                            <h6 class="wptb-item--designation">{{ $testimonial->country }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="wptb-swiper-navigation style1">
                                <div class="wptb-swiper-arrow swiper-button-prev"></div>
                                <div class="wptb-swiper-arrow swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="wptb-blog-grid-one pb-0">
            <div class="container">
                <div class="wptb-heading">
                    <div class="wptb-item--inner">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h1 class="wptb-item--title mb-0">Our Photography<br>
                                    <span>Related Blog</span>
                                </h1>
                            </div>

                            <div class="col-lg-6">
                                <p class="wptb-item--description">weâ€™re deeply passionate <span>catch your lovely
                                        memories in cameras</span> and Convey your love for every moment of life as a whole.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Swiper for Mobile View -->
                <div class="swiper d-md-none wptb-blog--inner">
                    <div class="swiper-wrapper">
                        @foreach ($blogs as $blog)
                            <div class="swiper-slide">
                                <div class="wptb-blog-grid1 highlight wow fadeInLeft active">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <a href="{{ route('blogdetail', $blog->slug) }}" class="wptb-item-link">
                                                <img src="{{ asset($blog->image) }}" alt="img">
                                            </a>
                                        </div>
                                        <div class="wptb-item--holder">
                                            @if ($settings->show_author_date)
                                                <div class="wptb-item--date">
                                                    {{ \Carbon\Carbon::parse($blog->publish_date)->format('d M Y') }}</div>
                                            @endif
                                            <h4 class="wptb-item--title">
                                                <a href="{{ route('blogdetail', $blog->slug) }}">{{ $blog->title }}</a>
                                            </h4>
                                            <div class="wptb-item--meta">
                                                @if ($settings->show_author_date)
                                                    <div class="wptb-item--author">By <a
                                                            href="#">{{ $blog->author }}</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- Original Grid for Desktop -->
                <div class="wptb-blog--inner d-none d-md-block">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-4 col-sm-6">
                                <div class="wptb-blog-grid1 highlight wow fadeInLeft active">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <a href="{{ route('blogdetail', $blog->slug) }}" class="wptb-item-link">
                                                <img src="{{ asset($blog->image) }}" alt="img">
                                            </a>
                                        </div>
                                        <div class="wptb-item--holder">
                                            @if ($settings->show_author_date)
                                                <div class="wptb-item--date">
                                                    {{ \Carbon\Carbon::parse($blog->publish_date)->format('d M Y') }}</div>
                                            @endif
                                            <h4 class="wptb-item--title">
                                                <a href="{{ route('blogdetail', $blog->slug) }}">{{ $blog->title }}</a>
                                            </h4>
                                            <div class="wptb-item--meta">
                                                @if ($settings->show_author_date)
                                                    <div class="wptb-item--author">By <a
                                                            href="#">{{ $blog->author }}</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                @if ($blogs->hasPages())
                    <div class="wptb-pagination-wrap text-center">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($blogs->onFirstPage())
                                <li><a class="disabled page-number previous" href="#"><i
                                            class="bi bi-chevron-left"></i></a></li>
                            @else
                                <li><a class="page-number previous" href="{{ $blogs->previousPageUrl() }}"><i
                                            class="bi bi-chevron-left"></i></a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($blogs->links()->elements[0] as $page => $url)
                                @if ($page == $blogs->currentPage())
                                    <li><span class="page-number current">{{ $page }}</span></li>
                                @else
                                    <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($blogs->hasMorePages())
                                <li><a class="page-number next" href="{{ $blogs->nextPageUrl() }}"><i
                                            class="bi bi-chevron-right"></i></a></li>
                            @else
                                <li><a class="disabled page-number next" href="#"><i
                                            class="bi bi-chevron-right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
        </section>
        <!-- <section class="wptb-office-address pd-bottom-100 mr-top-35">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-6 px-md-5">
                            <div class="wptb-icon-box1 wow fadeInLeft">
                                <div class="wptb-item--inner flex-start">
                                    <div class="wptb-item--icon"><i class="bi bi-phone"></i></div>
                                    <div class="wptb-item--holder">
                                        <h3 class="wptb-item--title">Book Us</h3>
                                        <p class="wptb-item--description">{{ $contactInfo->phone ?? 'N/A' }}</p>
                                        <a href="{{ $contactInfo->phone ?? 'N/A' }}" class="wptb-item--link">Call Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="wptb-icon-box1 wow fadeInLeft">
                                <div class="wptb-item--inner flex-start">
                                    <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
                                    <div class="wptb-item--holder">
                                        <h3 class="wptb-item--title">Crest Photography,</h3>
                                        <p class="wptb-item--description">{!! $contactInfo->address1 ?? 'N/A' !!}</p>
                                        <a href="{{ $contactInfo->map1 }}" class="wptb-item--link">View Map</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6">
                            <div class="wptb-icon-box1 wow fadeInLeft">
                                <div class="wptb-item--inner flex-start">
                                    <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
                                    <div class="wptb-item--holder">
                                        <h3 class="wptb-item--title">Crest Photography,</h3>
                                        <p class="wptb-item--description">{!! $contactInfo->address2 ?? 'N/A' !!}</p>
                                        <a href="{{ $contactInfo->map2 }}" class="wptb-item--link">View Map</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
        <div class="divider-line-hr"></div>
        <section class="wptb-contact-form style2">
            <div class="wptb-item-layer both-version">
                <img src="{{ asset('assets/web-assets/images/texture-2.png') }}" alt="">
                <img src="{{ asset('assets/web-assets/images/texture-2-light.png') }}" alt="">
            </div>
            <div class="container">
                <div class="wptb-form--wrapper no-bg">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="wptb-heading-two pe-lg-5">
                                <div class="wptb-item--inner">
                                    <h6 class="wptb-item--subtitle"> Contact Us</h6>
                                    <h1 class="wptb-item--title"> Feel Free To Ask Us Anything <span>Contact Us</span></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form class="wptb-form" action="{{ route('contactUs-store') }}" method="POST">
                                @csrf
                                <div class="wptb-form--inner">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Name*" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="E-mail*" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="Enter Phone Number*" required>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-4">
                                            <div class="form-group">
                                                <input type="text" name="subject" class="form-control"
                                                    placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-4">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <div class="wptb-item--button">
                                                <button class="btn" type="submit">
                                                    <span class="btn-wrap">
                                                        <span class="text-first">Send Mail</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
