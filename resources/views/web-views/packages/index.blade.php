@extends('web-views.layouts.app')
@section('content')
    <section class="wptb-pricing">
        <div class="container">
            <div class="wptb-pricing--inner">
                <div>

                </div>
                <div class="d-flex justify-content-end mt-5">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#weddingModal">
                        Customize Your Wedding Package
                    </button>
                </div>
                <div class="wptb-heading">
                    <div class="wptb-item--inner text-center">
                        <h1 class="wptb-item--title">Package Details</h1>
                        {{-- <p class="wptb-item--description">Please confirm that you would like to request the following
                            appointment:</p> --}}
                    </div>
                </div>
                <div class="swiper custom-swiper-3-slides">
                    <div class="swiper-wrapper">
                        @foreach ($packages as $package)
                            @if ($package->type === 'photography')
                                <div class="swiper-slide">
                                    <div class="wptb-packages1 highlight active">
                                        <h6 class="wptb-item--tag">Most Popular</h6>
                                        <div class="wptb-item--inner">
                                            <div class="wptb-item--holder">
                                                <h6 class="wptb-item--subtitle">{{ $package->name }}</h6>
                                                <h4 class="wptb-item--title">
                                                    ${{ $package->price ?? 'XX' }}<sub>/session</sub></h4>

                                                <div class="wptb-list1">
                                                    @if ($package->features)
                                                        @foreach (json_decode($package->features, true) as $feature)
                                                            <div class="wptb--item">
                                                                <div class="wptb-item--icon">✔</div>
                                                                <div class="wptb-item--text">{{ $feature }}</div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                                <div class="wptb-item--button my-3">
                                                    <a class="btn btn-danger w-100 book-btn" data-bs-toggle="modal"
                                                        data-bs-target="#appointmentModal" data-type="{{ $package->type }}">
                                                        <div class="btn-wrap">
                                                            <div class="btn-wrap">
                                                                <span class="text-first">Book Appointment</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- Optional navigation -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- Appointment Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Book Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('appointment.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="type" value="{{ $package->type }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number*</label>
                            <input type="text" class="form-control" name="contact" required>
                        </div>

                        <div class="mb-3">
                           <label for="contact" class="form-label">Email*</label>
                           <input type="text" class="form-control" name="email" required>
                       </div>

                        <div class="mb-3">
                            <label for="wedding_date" class="form-label">Wedding Date*</label>
                            <input type="date" class="form-control" name="wedding_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="wedding_venue" class="form-label">Wedding Venue*</label>
                            <input type="text" class="form-control" name="wedding_venue" required>
                        </div>

                        <div class="mb-3">
                            <label for="package_id" class="form-label">Select Package*</label>
                            <select name="package_id" id="packageSelect" class="form-control" required>
                              @foreach ($packages as $package)
                                  <option value="{{ $package->id }}">
                                      {{ $package->name }} - ${{ $package->price ?? 'XX' }}
                                  </option>
                              @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="weddingModal" tabindex="-1" aria-labelledby="weddingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="weddingModalLabel">Customize Your Wedding Package</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <form action="{{ route('package.custom-packages') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name of the Bride and Groom</label>
                            <input type="text" class="form-control @error('names') is-invalid @enderror"
                                id="names" name="name" value="{{ old('name') }}" placeholder="Enter names"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Enter email"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control @error('contact') is-invalid @enderror"
                                id="contact" name="contact" value="{{ old('contact') }}"
                                placeholder="Enter contact number">
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Choose Your Package</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('package') is-invalid @enderror" type="radio"
                                    name="package" id="singleSide" value="Single Side"
                                    {{ old('package') == 'Single Side' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="singleSide">Single Side</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('package') is-invalid @enderror" type="radio"
                                    name="package" id="brideGroom" value="Bride & Groom"
                                    {{ old('package') == 'Bride & Groom' ? 'checked' : '' }}>
                                <label class="form-check-label" for="brideGroom">Bride & Groom</label>
                            </div>
                            @error('package')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Choose the Event</label><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="wedding"
                                            value="Wedding"
                                            {{ is_array(old('event')) && in_array('Wedding', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="wedding">Wedding</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="reception"
                                            value="Reception"
                                            {{ is_array(old('event')) && in_array('Reception', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="reception">Reception</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="haldi"
                                            value="Haldi"
                                            {{ is_array(old('event')) && in_array('Haldi', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="haldi">Haldi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="sangeeth"
                                            value="Sangeeth"
                                            {{ is_array(old('event')) && in_array('Sangeeth', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sangeeth">Sangeeth</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="brideToBe"
                                            value="Bride to Be"
                                            {{ is_array(old('event')) && in_array('Bride to Be', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="brideToBe">Bride to Be</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="engagement"
                                            value="Engagement"
                                            {{ is_array(old('event')) && in_array('Engagement', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="engagement">Engagement</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="event[]" id="other"
                                            value="Other"
                                            {{ is_array(old('event')) && in_array('Other', old('event')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                            @error('event')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_datetime" class="form-label">Date & Time of the Event</label>
                            <input type="datetime-local"
                                class="form-control @error('event_datetime') is-invalid @enderror" id="dateTime"
                                name="event_datetime" value="{{ old('event_datetime') }}" required>
                            @error('dateTime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="venue" class="form-label">Venue of the Event</label>
                            <input type="text" class="form-control @error('venue') is-invalid @enderror"
                                id="venue" name="venue" value="{{ old('venue') }}" placeholder="Enter venue"
                                required>
                            @error('venue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirement Details</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements" name="requirements"
                                rows="4" placeholder="Describe your needs...">{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mt-4">Photography</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="photography[]"
                                        id="candidPhoto" value="Candid Photography"
                                        {{ is_array(old('photography')) && in_array('Candid Photography', old('photography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="candidPhoto">Candid Photography</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="photography[]"
                                        id="traditionalPhoto" value="Traditional Photography"
                                        {{ is_array(old('photography')) && in_array('Traditional Photography', old('photography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="traditionalPhoto">Traditional Photography</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="photography[]" id="photoAlbum"
                                        value="Photo Album"
                                        {{ is_array(old('photography')) && in_array('Photo Album', old('photography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photoAlbum">Photo Album</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="photography[]" id="photoFrame"
                                        value="Photo Frame Lamination"
                                        {{ is_array(old('photography')) && in_array('Photo Frame Lamination', old('photography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photoFrame">Photo Frame Lamination</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="photography[]"
                                        id="preWeddingShoot" value="Pre Wedding Shoot"
                                        {{ is_array(old('photography')) && in_array('Pre Wedding Shoot', old('photography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="preWeddingShoot">Pre Wedding Shoot</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="photography[]"
                                        id="postWeddingShoot" value="Post Wedding Shoot"
                                        {{ is_array(old('photography')) && in_array('Post Wedding Shoot', old('photography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="postWeddingShoot">Post Wedding Shoot</label>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Videography</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]"
                                        id="candidVideo" value="Candid Videography"
                                        {{ is_array(old('videography')) && in_array('Candid Videography', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="candidVideo">Candid Videography</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]"
                                        id="traditionalVideo" value="Traditional Videography"
                                        {{ is_array(old('videography')) && in_array('Traditional Videography', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="traditionalVideo">Traditional Videography</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]" id="droneVideo"
                                        value="Drone/Helicam Video"
                                        {{ is_array(old('videography')) && in_array('Drone/Helicam Video', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="droneVideo">Drone/Helicam Video</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]" id="video4k"
                                        value="4K Quality Video"
                                        {{ is_array(old('videography')) && in_array('4K Quality Video', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="video4k">4K Quality Video</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]" id="videoHD"
                                        value="HD Quality Video"
                                        {{ is_array(old('videography')) && in_array('HD Quality Video', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="videoHD">HD Quality Video</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]" id="preVideo"
                                        value="Pre Wedding Video"
                                        {{ is_array(old('videography')) && in_array('Pre Wedding Video', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="preVideo">Pre Wedding Video</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]" id="postVideo"
                                        value="Post Wedding Video"
                                        {{ is_array(old('videography')) && in_array('Post Wedding Video', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="postVideo">Post Wedding Video</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="videography[]"
                                        id="weddingReels" value="Wedding Reels"
                                        {{ is_array(old('videography')) && in_array('Wedding Reels', old('videography')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="weddingReels">Wedding Reels</label>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Extras</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="livePrint"
                                        value="Live Printing"
                                        {{ is_array(old('extras')) && in_array('Live Printing', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="livePrint">Live Printing</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="minibook1"
                                        value="Minibook"
                                        {{ is_array(old('extras')) && in_array('Minibook', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="minibook1">Minibook</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="weddingStory"
                                        value="Wedding Story Book"
                                        {{ is_array(old('extras')) && in_array('Wedding Story Book', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="weddingStory">Wedding Story Book</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="faceRec"
                                        value="Face Recognized Photo Sharing"
                                        {{ is_array(old('extras')) && in_array('Face Recognized Photo Sharing', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="faceRec">Face Recognized Photo Sharing</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="photoMug"
                                        value="Photo Printed Mug"
                                        {{ is_array(old('extras')) && in_array('Photo Printed Mug', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photoMug">Photo Printed Mug</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="photoKeychain"
                                        value="Photo Printed Keychain"
                                        {{ is_array(old('extras')) && in_array('Photo Printed Keychain', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="photoKeychain">Photo Printed Keychain</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="ledWall"
                                        value="LED Wall"
                                        {{ is_array(old('extras')) && in_array('LED Wall', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ledWall">LED Wall</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="ytLive"
                                        value="YouTube Live Streaming"
                                        {{ is_array(old('extras')) && in_array('YouTube Live Streaming', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ytLive">YouTube Live Streaming</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="extras[]" id="minibook2"
                                        value="Minibook"
                                        {{ is_array(old('extras')) && in_array('Minibook', old('extras')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="minibook2">Minibook</label>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Budget</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget1"
                                        value="30000" {{ old('budget') == '30000' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget1">Below 30K</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget2"
                                        value="40000" {{ old('budget') == '40000' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget2">30K to 50K</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget3"
                                        value="65000" {{ old('budget') == '65000' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget3">50K to 80K</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget4"
                                        value="90000" {{ old('budget') == '90000' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget4">80K to 100K</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget5"
                                        value="125000" {{ old('budget') == '125000' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget5">100K to 150K</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget6"
                                        value="200000" {{ old('budget') == '200000' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget6">150K to 250K</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="budget" id="budget7"
                                        value="0" {{ old('budget') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="budget7">No Limit</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection



