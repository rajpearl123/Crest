@php
$websiteSetting = \App\Models\WebsiteSetting::first();
$banner = getBanner('blogs');
@endphp
@extends('web-views.layouts.app')
@section('title', $websiteSetting->name . " | Blogs")
@section('content')
<style>
    .wptb-blog-grid-one .recent_img {
        width: 100% !important;
        max-width: 100px !important;
        height: 80px !important;
        object-fit: cover;
    }

    @media (max-width: 767px) {
        .wptb-blog-grid-one .row {
            display: flex;
            flex-direction: column;
        }

        .wptb-blog-grid-one .col-lg-4.col-md-5 {
            order: -1;
        }

        .wptb-blog-grid-one .col-lg-8.col-md-7 {
            order: 0;
        }

    }
</style>
<main>
    <section class="wptb-slider style5 p-0">
        <div class="wptb-page-heading px-0">
            <div class="wptb-item--inner" style="background-image: url('{{ $banner && $banner->banner_img ? asset('uploads/page_banners/' . $banner->banner_img) : asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg') }}');">
                <h2 class="wptb-item--title">
                    Blogs{{ $category ? ' - ' . ucfirst($category) : '' }}
                </h2>
            </div>
        </div>
    </section>

    <section class="wptb-blog-grid-one">
        <div class="container">
            <div class="row">
                <!-- Categories Sidebar -->
                <div class="col-lg-4 col-md-5 order-first order-md-last">
                    <div class="p-6 my-4 bg-white shadow-md rounded-lg">
                        <h3 class="text-xl font-bold text-slate-800 mb-4">
                            <i class="bi bi-folder-fill text-blue-500 mr-2"></i>Blog Categories
                        </h3>
                        <div class="flex flex-col gap-2">
                            @foreach ($categories as $cat)
                            @php
                            $isActive = request()->route('category') === $cat->name;
                            $baseStyles = 'padding: 10px 20px; font-size: 14px; font-weight: 500; border-radius: 6px; border: 1px solid;';
                            $activeStyle = 'background-color: #2563EB; color: white; border-color: #2563EB;';
                            $defaultStyle = 'background-color: #F1F5F9; color: #1E293B; border-color: #CBD5E1;';
                            @endphp
                            <a href="{{ route('blogs', $cat->name) }}"
                                class="transition-all duration-200 ease-in-out"
                                style="{{ $baseStyles }}{{ $isActive ? $activeStyle : $defaultStyle }}"
                                onmouseover="this.style.backgroundColor='{{ $isActive ? '#1E40AF' : '#DBEAFE' }}'; this.style.color='{{ $isActive ? 'white' : '#1E3A8A' }}'; this.style.borderColor='{{ $isActive ? '#1E40AF' : '#93C5FD' }}'"
                                onmouseout="this.style.backgroundColor='{{ $isActive ? '#2563EB' : '#F1F5F9' }}'; this.style.color='{{ $isActive ? 'white' : '#1E293B' }}'; this.style.borderColor='{{ $isActive ? '#2563EB' : '#CBD5E1' }}'">
                                {{ ucfirst($cat->name) }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar">
                        <div class="widget widget_block">
                            <div class="wp-block-group__inner-container">
                                <h2 class="widget-title">Recent Posts</h2>
                                <ul class="wp-block-latest-posts__list wp-block-latest-posts">
                                    @foreach ($recentBlogs as $recent)
                                    <li>
                                        <div class="latest-posts-content d-flex align-items-center gap-3">
                                            <img src="{{ asset($recent->image) }}" alt="" srcset="" class="recent_img">
                                            <h5><a href="{{ route('blogdetail', $recent->slug) }}">{{ $recent->title }}</a></h5>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Blog Content -->
                <div class="col-lg-8 col-md-7 order-last order-md-first">
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-lg-6 col-sm-6">
                            <div class="wptb-blog-grid1 wow fadeInLeft">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--image">
                                        <a href="{{ route('blogdetail', $blog->slug) }}" class="wptb-item-link">
                                            <img src="{{ asset($blog->image) }}" alt="img">
                                        </a>
                                    </div>
                                    <div class="wptb-item--holder">
                                        @if($settings->show_author_date)
                                        <div class="wptb-item--date">{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M Y') }}</div>
                                        @endif
                                        <h4 class="wptb-item--title">
                                            <a href="{{ route('blogdetail', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h4>
                                        <div class="wptb-item--meta">
                                            @if($settings->show_author_date)
                                            < fertility class="wptb-item--author">By <a href="#">{{ $blog->author }}</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($blogs->hasPages())
                <div class="wptb-pagination-wrap text-center">
                    <ul class="pagination">
                        @if ($blogs->onFirstPage())
                        <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        @else
                        <li><a class="page-number previous" href="{{ $blogs->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                        @endif
                        @foreach ($blogs->links()->elements[0] as $page => $url)
                        @if ($page == $blogs->currentPage())
                        <li><span class="page-number current">{{ $page }}</span></li>
                        @else
                        <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                        @endforeach
                        @if ($blogs->hasMorePages())
                        <li><a class="page-number next" href="{{ $blogs->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                        @else
                        <li><a class="disabled page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>
        </div>
    </section>
</main>
@endsection