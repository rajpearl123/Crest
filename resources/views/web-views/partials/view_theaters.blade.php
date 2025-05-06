@php $theaters = App\Models\Theater::where('status', '0')->get(); @endphp


<!--Pricing Tables Area Start Here-->
<div class="pricing-tables-area pad100 target-section" id="targetSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <div class="title-text mb50">
                        <h2>Our Theaters</h2>
                    </div>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
        <div class="row">
            @foreach ($theaters as $theater)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="pricing-box xs-mb30 my_individual_card">
                    <div class="icons">
                        @php 
                        $images = is_string($theater->images) ? json_decode($theater->images, true) : $theater->images; 
                        $randomImage = !empty($images) && is_array($images) ? \Illuminate\Support\Arr::random($images) : null;
                    @endphp
    
                    @if ($randomImage)
                        <img src="{{ asset('assets/images/theaters/' . $randomImage) }}" alt="Theater Image">
                    @else
                        <p>No images available</p>
                    @endif
                    </div>
                    <div class="main_content_theater">
                        <div class="d-flex justify-content-between">
                            <div class="pricing-title">{{$theater->name}}</div>
                            <div class="location_slot d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" style="cursor: pointer;">
                                    <g clip-path="url(#clip0_195_76671)">
                                        <path d="M2.66699 6.76221C2.66699 3.76393 5.05481 1.33334 8.00033 1.33334C10.9458 1.33334 13.3337 3.76393 13.3337 6.76221C13.3337 9.73699 11.6314 13.2083 8.97561 14.4496C8.3565 14.739 7.64415 14.739 7.02504 14.4496C4.36921 13.2083 2.66699 9.73699 2.66699 6.76221Z" stroke="#646464"></path>
                                        <circle cx="8" cy="6.66666" r="2" stroke="#646464"></circle>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_195_76671">
                                            <rect width="16" height="16" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p class="m-0"><a href="{{$theater->address}}">Google Location</a></p>

                            </div>
                        </div>

                        <!-- <div class="pricing-content">
                        <ul>
                            <li>{!! $theater->features !!}</li>
                        </ul>
                      </div> -->
                      <h5 class="my-3">{!! $theater->max_capacity !!}</h5>
                  
                        <div class="pricing-header">
                            <span class="amount">
                                <span class="currency"></span>{{$theater->price}}
                            </span>
                            <div class="bordered-btn">
                                <a href="{{route('theater-view', $theater->id)}}">View details</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          
            @endforeach

        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Pricing Tables Area End Here-->