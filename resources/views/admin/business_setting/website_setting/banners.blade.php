@extends('admin.layouts.app')
@section('title', 'Banners')
<style>
    .banner-img{
        width: 111px;
    }
</style>
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Home Page Banner</h4>
                            <form action="{{ route('admin.website-setting.bannerStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="example-textarea">Upload Banner</label>
                                    <input class="form-control" type="file" name="banner" id="banner" accept="image/*" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Social Links</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $key => $banner)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset('assets/images/banners/' . $banner->banner) }}" class="banner-img" alt="Banner"></td>
                                        <td>
                                            <form action="{{ route('admin.website-setting.bannerStatus', $banner->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="active" value="1">
                                                <input type="checkbox" id="switch{{ $banner->id }}" switch="none"
                                                    name="active" value="0"
                                                    onchange="this.form.submit()" 
                                                    {{ $banner->status == '0' ? 'checked' : '' }} />
                                                <label for="switch{{ $banner->id }}" data-on-label="On" data-off-label="Off"></label>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.website-setting.bannerDelete', $banner->id)}}">
                                                <button class="btn btn-danger" ><i class="bx bx-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection