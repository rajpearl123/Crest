@php
    $websiteSetting = \App\Models\WebsiteSetting::first();
    $banner = getBanner('about');
@endphp

@extends('web-views.layouts.app')
@section('title', $websiteSetting->name . " | About us")
@section('content')

<section class="wptb-slider style5 p-0">
    <div class="wptb-page-heading px-0">
        <div class="wptb-item--inner" style="background-image: url('{{ $banner && $banner->banner_img ? asset('uploads/page_banners/' . $banner->banner_img) : asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg') }}'); background-size: cover;">
            <h2 class="wptb-item--title">About Us</h2>
        </div>
    </div>
</section>

<section class="wptb-about-one bg-image-2" style="background-image: url('{{asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg')}}'); background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <!-- About Section -->
                <div class="wptb-heading-two">
                    <div class="wptb-item--inner">
                        <!-- <h6 class="wptb-item--subtitle">{{ $section->subtitle ?? 'Default Subtitle' }}</h6> -->
                        <h1 class="wptb-item--title">{{ $section->title ?? 'Default Title' }}</h1>
                        <div class="wptb-item--description">{{ $section->description ?? 'Default Description' }}</div>
                    </div>
                </div>

                <!-- Operations Section -->
                <div class="mr-top-50 mr-bottom-50 d-inline-block w-100"></div>
                <h3 class="widget-title">Crest Operation</h4>
                <p>{{ $section->op_desc }}</p>
                @php
                    $op_data = json_decode($section->operation_data, true);
                @endphp
                <div class="row">
                    @foreach ($op_data as $item)
                        <div class="col-md-6 mr-bottom-75 pe-md-5">
                            <div class="wptb-counter1 style1 position-relative z-index-3 wow skewIn" style="visibility: hidden; animation-name: none;">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--holder d-flex align-items-center">
                                        <div class="wptb-item--value">
                                            <div class="odometer odometer-auto-theme" data-count="{{ $item['op_data'] }}">
                                                <div class="odometer-inside">
                                                    <span class="odometer-digit">
                                                        <span class="odometer-digit-spacer">8</span>
                                                        <span class="odometer-digit-inner">
                                                            <span class="odometer-ribbon">
                                                                <span class="odometer-ribbon-inner">
                                                                    <span class="odometer-value">0</span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="suffix">+</span>
                                        </div>
                                        <div class="wptb-item--text">{{ $item['op_title'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Features Section -->
                <div class="mr-top-50 mr-bottom-50 d-inline-block w-100"></div>
                <h4 class="widget-title">{{ $features->first()->title ?? 'Why Choose Us' }}</h4>
                <i><p>{{ $features->first()->description ?? 'Default description' }}</p></i>
                <div class="row">
                    @foreach($features->chunk(3) as $chunk)
                        <div class="col-md-6">
                            <div class="wptb-list1">
                                @foreach($chunk as $feature)
                                <div class="wptb--item wow skewIn animated" data-wow-delay="700ms" style="visibility: visible; animation-delay: 700ms;">
                                    <div class="wptb-item--icon"><i class="bi bi-check"></i></div>
                                    <div class="wptb-item--text">{{ $feature->feature_text }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-4 offset-xl-1">
                        <div class="wptb-gallery-box">
                            <div class="swiper-container swiper-gallery-left">
                                <div class="swiper-wrapper">
                                    @foreach($randomImages as $image)
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
                                    @foreach($randomImages as $image)
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
</section>

<section class="wptb-faq-one bg-image pb-0" style="background-image: url('{{ asset('assets/web-assets/images/bg-8.jpg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="wptb-heading">
                    <div class="wptb-item--inner">
                        <h1 class="wptb-item--title mb-lg-0">Why Choose Us</h1>
                    </div>
                </div>

                <div class="wptb-accordion wptb-accordion2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    @foreach($items as $item)
                    <div class="wptb--item {{ $loop->first ? 'active' : '' }}">
                        <h6 class="wptb-item-title">
                            <span>{{ $item->title }}</span> 
                            <i class="plus bi bi-plus"></i> 
                            <i class="minus bi bi-dash"></i>
                        </h6>
                        <div class="wptb-item--content">
                            {{ $item->content }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="wptb-agency-experience--item text-white">
                    <span>15+</span> Years Experience
                </div>
            </div>

            <div class="col-lg-6">
                <div class="wptb-image-single wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wptb-item--inner">
                        <div class="wptb-item--image">
                            <img src="{{ asset('assets/web-assets/images/3.png') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wptb-progress-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h4 class="widget-title mb-4">Our Achievements</h4>
                <div class="row">
                    <div class="col-xl-10">
                        @foreach(json_decode($section->progress_bars ?? '[]', true) as $progress)
                            <div class="wptb-progressbar mb-4">
                                <div class="wptb-progressbar--inner">
                                    <div class="wptb-progress--label">{{ $progress['label'] }}</div>
                                    <div class="progress" style="height: 3px;">
                                        <div class="progress-bar bg-one" role="progressbar" style="width: {{ $progress['value'] }}%" aria-valuemin="0" aria-valuemax="100"><span class="wptb-progress--value">{{ $progress['value'] }}%</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection