@extends('admin.layouts.app')
@section('title', 'Edit Social Link')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Social Links</h4>
                            <form action="{{ route('admin.business-setting.social-links-edit-store', $id) }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="example-textarea">Link</label>
                                    <input class="form-control" type="text" name="link" id="link" placeholder="ex: https://instagram.com" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection