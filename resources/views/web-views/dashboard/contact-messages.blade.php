@extends('web-views.layouts.app')
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp
@php use App\Utils\ViewPath; @endphp

@section('title', Auth::user()->name)
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include(ViewPath::USER_PROFILE_SIDEBAR)
            <div class="col-12 col-lg-8 mt-5 col-md-8">
                <div class="message-table-block">
                    <!-- <div class="col-md-9"> -->
                    @if($messages->isEmpty())
                        <p>No contact messages found.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $key => $message)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ Str::limit($message->message, 50) }}</td>
                                        <td>{{ $message->is_replied ? 'Replied' : 'Pending' }}</td>
                                        <td>
                                            <a href="{{route('replies', $message->id)}}" class="btn btn-sm btn-primary">
                                                <i class="mdi-message-reply-text"></i>View Replies
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

@endsection