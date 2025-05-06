@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Update Banner</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('admin.contact-info.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label class="form-label">Website URL</label>
                                    <input type="text" class="form-control" name="website_url" value="{{ $contactInfo->website_url ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $contactInfo->email ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $contactInfo->phone ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address 1</label>
                                    <textarea class="form-control" name="address1" required>{{ $contactInfo->address1 ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Map Link 1</label>
                                    <input type="link" class="form-control" name="map1" value="{{ $contactInfo->map1 ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address 2</label>
                                    <textarea class="form-control" name="address2" required>{{ $contactInfo->address2 ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Map Link 2</label>
                                    <input type="link" class="form-control" name="map2" value="{{ $contactInfo->map2 ?? '' }}" required>
                                    
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


