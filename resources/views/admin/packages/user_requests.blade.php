@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Custom Package User Requests</h4>
                        </div>
                        <div class="card-body">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Package</th>
                                            <th>Event Date</th>
                                            <th>Budget</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($user_requests as $key => $req)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $req->name }}</td>
                                                <td>{{ $req->email }}</td>
                                                <td>{{ $req->package }}</td>
                                                <td>{{ \Carbon\Carbon::parse($req->event_datetime)->format('d M Y h:i A') }}</td>
                                                <td>?{{ number_format($req->budget) }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $req->id }}">
                                                        View Details
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="detailsModal{{ $req->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $req->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-dark text-white">
                                                            <h5 class="modal-title" id="detailsModalLabel{{ $req->id }}">Request Details - {{ $req->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Name:</strong> {{ $req->name }}</p>
                                                            <p><strong>Email:</strong> {{ $req->email }}</p>
                                                            <p><strong>Phone:</strong> {{ $req->phone ?? 'N/A' }}</p>
                                                            <p><strong>Package:</strong> {{ $req->package }}</p>
                                                            <p><strong>Venue:</strong> {{ $req->venue }}</p>
                                                            <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($req->event_datetime)->format('d M Y h:i A') }}</p>
                                                            <p><strong>Budget:</strong> ?{{ number_format($req->budget) }}</p>

                                                            <p><strong>Events:</strong><br>
                                                                @foreach($req->event ?? [] as $event)
                                                                    <span class="badge bg-info">{{ $event }}</span>
                                                                @endforeach
                                                            </p>

                                                            <p><strong>Photography:</strong><br>
                                                                @foreach($req->photography ?? [] as $photo)
                                                                    <span class="badge bg-success">{{ $photo }}</span>
                                                                @endforeach
                                                            </p>

                                                            <p><strong>Videography:</strong><br>
                                                                @foreach($req->videography ?? [] as $video)
                                                                    <span class="badge bg-warning text-dark">{{ $video }}</span>
                                                                @endforeach
                                                            </p>

                                                            <p><strong>Extras:</strong><br>
                                                                @foreach($req->extras ?? [] as $extra)
                                                                    <span class="badge bg-secondary">{{ $extra }}</span>
                                                                @endforeach
                                                            </p>

                                                            <p><strong>Requirement:</strong> {{ $req->requirement ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No custom package requests found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
