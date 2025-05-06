@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Contact Information</h4>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="card energi-card">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h5 class="card-title">Contact Details</h5>
                            @if($contactList)
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Website URL:</strong> <a href="{{ $contactList->website_url }}" target="_blank">{{ $contactList->website_url }}</a></p>
                                        <p><strong>Email:</strong> <a href="mailto:{{ $contactList->email }}">{{ $contactList->email }}</a></p>
                                        <p><strong>Phone:</strong> <a href="tel:{{ $contactList->phone }}">{{ $contactList->phone }}</a></p>
                                        <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($contactList->created_at)->format('d F Y, h:i A') }}</p>
                                        <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($contactList->updated_at)->format('d F Y, h:i A') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Address 1:</strong><br>{!! nl2br(e($contactList->address1)) !!}</p>
                                        <p><strong>Map 1:</strong> <a href="{{ $contactList->map1 }}" target="_blank">View on Google Maps</a></p>
                                        <p><strong>Address 2:</strong><br>{!! nl2br(e($contactList->address2)) !!}</p>
                                        <p><strong>Map 2:</strong> <a href="{{ $contactList->map2 }}" target="_blank">View on Google Maps</a></p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.contact-info.edit', $contactList->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                   
                                </div>
                            @else
                                <p>No contact information available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    // Custom toast notification
    function showToast(message, type = 'success') {
        var toast = $('<div>').css({
            position: 'fixed',
            top: '20px',
            right: '20px',
            padding: '15px',
            color: '#fff',
            background: type === 'success' ? '#28a745' : '#dc3545',
            borderRadius: '5px',
            zIndex: 1000,
            maxWidth: '300px'
        }).text(message);
        
        $('body').append(toast);
        setTimeout(function() {
            toast.fadeOut(300, function() { $(this).remove(); });
        }, 3000);
    }
});
</script>
@endsection