@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Enquiry</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Wedding Date</th>
                                            <th>Venue</th>
                                            <th>Type</th>
                                            <th>Package</th>
                                            <th>Price</th>
                                            <th>Booked At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $index => $appointment)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $appointment->name }}</td>
                                                <td>{{ $appointment->contact }}</td>
                                                <td>{{ $appointment->email }}</td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->wedding_date)->format('d M Y') }}</td>
                                                <td>{{ $appointment->wedding_venue }}</td>
                                                <td>{{ ucfirst($appointment->type) }}</td>
                                                <td>{{ $appointment->package->name ?? 'N/A' }}</td>
                                                <td>₹{{ $appointment->package->price ?? '-' }}</td>
                                                <td>{{ $appointment->created_at->format('d M Y h:i A') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No appointments found.</td>
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
