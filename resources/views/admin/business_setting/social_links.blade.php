@extends('admin.layouts.app')
@section('title', 'Social Links')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Social Links</h4>
                            <form action="{{ route('admin.business-setting.social-links-store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="example-textarea">Name</label>
                                    <select name="name" class="form-control" id="name" required>
                                        <option value=""  disabled selected>--Select--</option>
                                        @foreach ($social_links as $social_link)
                                            <option value="{{$social_link->name}}">{{ucFirst($social_link->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-textarea">Link</label>
                                    <input class="form-control" type="text" name="link" id="link" placeholder="ex: https://instagram.com" required>
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
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($social_links as $key => $social_link)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucfirst($social_link->name) }}</td>
                                        <td><a href="{{ $social_link->link }}" target="_blank">{{ $social_link->link }}</a></td>
                                        <td>
                                            <form action="{{ route('admin.business-setting.social-links-status', $social_link->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="active" value="1">
                                                <input type="checkbox" id="switch{{ $social_link->id }}" switch="none"
                                                    name="active" value="0"
                                                    onchange="this.form.submit()" 
                                                    {{ $social_link->status == '0' ? 'checked' : '' }} />
                                                <label for="switch{{ $social_link->id }}" data-on-label="On" data-off-label="Off"></label>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.business-setting.social-links-edit', $social_link->id)}}">
                                                <button class="btn btn-primary" ><i class="bx bx-edit"></i></button>
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