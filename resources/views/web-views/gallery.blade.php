@php
$websiteSetting = \App\Models\WebsiteSetting::first();
@endphp
@php
$banner = getBanner('photo_gallery');
@endphp
@extends('web-views.layouts.app')
@section('title', $websiteSetting->name)
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>



<main>
    <section class="wptb-slider style5 p-0">
        <div class="wptb-page-heading px-0">
            <div class="wptb-item--inner" style="background-image: url('{{ $banner && $banner->banner_img ? asset('uploads/page_banners/' . $banner->banner_img) : asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg') }}');">

                <h2 class="wptb-item--title">Crest Photo Gallery</h2>
                <span style="display: inline-block; background-color: #ffffff; color: #333333; font-size: 14px; font-weight: 600; padding: 6px 12px; border-radius: 999px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                    {{ $cat_name }}
                </span>
                <p class="text-lg md:text-xl max-w-2xl drop-shadow-md color: #ffffff;">{{ $banner->title }}</p>
            </div>
        </div>
    </section>

   
    <div class="_main_acnhor my-5">
    @foreach($galleryCategories as $category)
        <a class="anchor_ad" href="{{ route('gallery', ['category' => $category->name]) }}">{{ $category->name }}</a>
        @endforeach
    </div>
    

    <section class="p-0">
        <div class="container">
            <div class="wptb-project--inner">
                <div class="wptb-heading">
                    <!-- <div class="wptb-item--inner text-center">
                            <h1 class="wptb-item--title"> Crest captures <span>All of Your</span> <br> beautiful memories</h1>
                        </div> -->
                </div>

                <div class="has-radius effect-tilt">
                    <div class="grid grid-3 gutter-30 clearfix" style="position: relative; height: 1806.95px;">
                        <div class="grid-sizer"></div>

                        @php
                        $positions = [
                        '0%' => '0px',
                        '33.33%' => '0px',
                        '66.6599%' => '0px'
                        ];
                        $index = 0;
                        @endphp

                        @foreach($galleries as $gallery)
                        @php
                        $left = array_keys($positions)[$index % 3];
                        $top = $positions[$left];
                        $index++;
                        @endphp
                        <div class="grid-item" style="position: absolute; left: {{ $left }}; top: {{ $top }}; will-change: transform; transform: perspective(1400px) rotateX(0deg) rotateY(0deg);">
                            <div class="wptb-item--inner">
                                <div class="wptb-item--image">
                                    <a href="{{ asset($gallery->image) }}" data-fancybox="gallery">
                                        <img src="{{ asset($gallery->image) }}" alt="img">
                                    </a>
                                </div>
                                <div class="wptb-item--holder">
                                    <div class="wptb-item--meta">
                                        <h4><a href="{{ $gallery->link }}">{{ $gallery->title }}</a></h4>
                                        <!-- <p>By {{ $gallery->author }}</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>

            @if ($galleries->hasPages())
            <div class="wptb-pagination-wrap text-center">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($galleries->onFirstPage())
                    <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                    @else
                    <li><a class="page-number previous" href="{{ $galleries->appends(['category' => request('category')])->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($galleries->appends(['category' => request('category')])->links()->elements as $element)
                    @if (is_string($element))
                    <li><span class="page-number disabled">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @php
                    $url = $url . (parse_url($url, PHP_URL_QUERY) ? '&' : '?') . 'category=' . urlencode(request('category'));
                    @endphp
                    @if ($page == $galleries->currentPage())
                    <li><span class="page-number current">{{ $page }}</span></li>
                    @else
                    <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                    @endforeach
                    @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($galleries->hasMorePages())
                    <li><a class="page-number next" href="{{ $galleries->appends(['category' => request('category')])->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                    @else
                    <li><a class="disabled page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    @endif
                </ul>
            </div>
            @endif

        </div>
    </section>

</main>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox=gallery]", {
        Toolbar: {
            display: ["zoom", "slideShow", "fullScreen", "download", "thumbs", "close"]
        }
    });
</script>
@endsection