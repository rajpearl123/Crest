@php
$websiteSetting = \App\Models\WebsiteSetting::first();
$banner = getBanner('video_gallery');
@endphp

@extends('web-views.layouts.app')
@section('title', $websiteSetting->name)
@section('content')
<style>
    .wptb-item--meta h5 {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits text to 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis; /* Adds ellipsis (...) for overflow text */
        height: 3em; /* Adjust based on font-size to ensure 2 lines */
        line-height: 1.5em; /* Adjust based on font size */
        margin: 0;
        text-align: center;
    }
    /* Fallback for older browsers */
    .wptb-item--meta h5 {
        max-height: 3em;
        overflow: hidden;
    }
    /* Responsive adjustment for smaller screens */
    @media (max-width: 768px) {
        .wptb-item--meta h5 {
            font-size: 14px; /* Adjust font size for mobile */
            line-height: 1.4em;
            height: 2.8em;
        }
    }
</style>
<section class="wptb-slider style5 p-0">
   <div class="wptb-page-heading px-0">
   <div class="wptb-item--inner" style="background-image: url('{{ $banner && $banner->banner_img ? asset('uploads/page_banners/' . $banner->banner_img) : asset('assets/web-assets/images/circle-cameras-film_23-2147852399.jpg') }}');">
      
   <h2 class="wptb-item--title">Crest Video Gallery</h2>
   <p class="text-lg md:text-xl max-w-2xl drop-shadow-md">{{ $banner->title }}</p>

      </div>
   </div>
</section>
<div class="container mt-5">
   <div class="wptb-heading">
   </div>
   <div class="row">
      <div class="row">
         @foreach($galleries as $gallery)
         @php
         // Check if it's a shortened YouTube URL like https://youtu.be/{VIDEO_ID}
         preg_match('/(?:https?:\/\/(?:www\.)?youtu\.be\/)([a-zA-Z0-9_-]{11})/', $gallery->video_url, $matches);
         $videoId = $matches[1] ?? null;
         @endphp
         @if($videoId)
         <div class="col-md-4 mb-4 video-page">
            <div class="video" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="https://www.youtube.com/embed/{{ $videoId }}">
               <button type="button" class="btn btn-play">
               <i class="fas fa-play"></i>
               </button>
               <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" class="img-fluid rounded">
            </div>
            
            <div class="wptb-item--meta mt-3">
               <h5 class="text-center"><a href="">{{ $gallery->title }}</a></h5>
            </div>
         </div>
         @endif
         @endforeach
      </div>
   </div>

   @if ($galleries->hasPages())
                <div class="wptb-pagination-wrap text-center">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($galleries->onFirstPage())
                            <li><a class="disabled page-number previous" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        @else
                            <li><a class="page-number previous" href="{{ $galleries->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($galleries->links()->elements[0] as $page => $url)
                            @if ($page == $galleries->currentPage())
                                <li><span class="page-number current">{{ $page }}</span></li>
                            @else
                                <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($galleries->hasMorePages())
                            <li><a class="page-number next" href="{{ $galleries->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                        @else
                            <li><a class="disabled page-number next" href="#"><i class="bi bi-chevron-right"></i></a></li>
                        @endif
                    </ul>
                </div>
                 @endif
</div>
<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title text-white" id="videoModalLabel">Video Player</h5>
            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="ratio ratio-16x9">
               <iframe id="videoFrame" src="" frameborder="0" allowfullscreen></iframe>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   document.addEventListener("DOMContentLoaded", function() {
       var videoModal = document.getElementById("videoModal");
       var videoFrame = document.getElementById("videoFrame");
   
       videoModal.addEventListener("show.bs.modal", function(event) {
           var button = event.relatedTarget;
           var videoSrc = button.getAttribute("data-video");
           videoFrame.src = videoSrc + "?autoplay=1";
       });
   
       videoModal.addEventListener("hidden.bs.modal", function() {
           videoFrame.src = "";
       });
   });
</script>
@endsection