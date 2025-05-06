@extends('admin.layouts.app')
@section('title', 'Website Setting')
@php use App\Utils\ViewPath; @endphp
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @include(ViewPath::ADMIN_INLINE_MENU_WEBSITE_SETTING)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.website-setting.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Header Logo Upload -->
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Website Header Logo</label>
                                        <div class="border p-3 text-center">
                                            <img id="headerLogoPreview" src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->header_logo) : asset('assets/images/logo/no-img.jpg') }}"  alt="Header Logo" class="img-fluid" style="max-height: 100px;">
                                        </div>
                                        <input type="file" name="header_logo" id="headerLogo" class="form-control mt-2" accept="image/*" onchange="previewImage(event, 'headerLogoPreview')">
                                    </div>

                                    <!-- Footer Logo Upload -->
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Website Footer Logo</label>
                                        <div class="border p-3 text-center">
                                            <img id="footerLogoPreview" src="{{ $websiteSetting->footer_logo ? asset('assets/images/logo/' . $websiteSetting->footer_logo) : asset('assets/images/logo/no-img.jpg') }}" alt="Footer Logo" class="img-fluid" style="max-height: 100px;">
                                        </div>
                                        <input type="file" name="footer_logo" id="footerLogo" class="form-control mt-2" accept="image/*" onchange="previewImage(event, 'footerLogoPreview')">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Website Favicon</label>
                                        <div class="border p-3 text-center">
                                            <img id="favicon" src="{{ $websiteSetting->favicon ? asset('assets/images/logo/' . $websiteSetting->favicon) : asset('assets/images/logo/no-img.jpg') }}" alt="Footer Logo" class="img-fluid" style="max-height: 100px;">
                                        </div>
                                        <input type="file" name="favicon" id="favicon" class="form-control mt-2" accept="image/*" onchange="previewImage(event, 'footerLogoPreview')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Company name" value="{{ $websiteSetting->name }}">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Company Address</label>
                                        <textarea name="address" id="address" class="form-control" placeholder="Company address">{{$websiteSetting->address}}</textarea>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Company Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Company Email" value="{{ $websiteSetting->email }}">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Company Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Company Phone" value="{{ $websiteSetting->phone }}">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Copyright</label>
                                        <input type="text" name="copyright" id="copyright" class="form-control" placeholder="Copyright" value="{{ $websiteSetting->copyright }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Setting</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to preview image -->
<script>
    function previewImage(event, previewId) {
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById(previewId).src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
