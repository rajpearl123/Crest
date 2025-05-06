@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row">
                <div class="col-xl-8">
                    <!-- Bookings, Earnings, Queries Summary -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Blogs</div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Blogs</h5>
                                    <p class="card-text display-6">{{ $blog_count }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">Gallery</div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Gallery</h5>
                                    <p class="card-text display-6">{{ $gallery_count }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header">Inquiries</div>
                                <div class="card-body">
                                    <h5 class="card-title">Contact Messages</h5>
                                    <p class="card-text display-6">{{ $contact_us }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Graph Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-2">
                                    <h5 class="card-title mb-4">Subscribers Over Time</h5>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="text-muted font-size-16" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div style="position: relative; height: 300px;">
                                <canvas id="subscribersChart" style="width: 100%; height: 100%;"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Posts Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-2">
                                    <h5 class="card-title mb-4">Popular Posts</h5>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="text-muted font-size-16" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2">Post</th>
                                            <th scope="col"><a href="{{ route('admin.comments.index') }}">Comments</a></th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($popularBlogs as $post)
                                        <tr>
                                            <td style="width: 100px;">
                                                <img src="{{ asset($post->image) }}" alt="" class="avatar-md h-auto d-block rounded">
                                            </td>
                                            <td>
                                                <h5 class="font-size-13 text-truncate mb-1">
                                                    <a href="{{ route('blogdetail', $post->slug) }}" class="text-dark">{{ $post->title }}</a>
                                                </h5>
                                                <p class="text-muted mb-0">{{ $post->created_at->format('d M, Y') }}</p>
                                            </td>
                                            <td><i class="bx bx-comment-dots align-middle me-1"></i> {{ $post->comments_count ?? 0 }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted font-size-16" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side Section -->
                <div class="col-xl-4">
                    <!-- Subscribers Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-start">
                                <h5 class="card-title mb-3 me-2">Subscribers</h5>
                                <div class="dropdown ms-auto">
                                    <a class="text-muted font-size-16" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div>
                                    <p class="text-muted mb-1">Total Subscribers</p>
                                    <h4 class="mb-3">{{ $subscribers }}</h4>
                                    <p class="text-success mb-0"><span>{{ number_format($percentageChange, 2) }}% <i class="mdi mdi-arrow-top-right ms-1"></i></span></p>
                                </div>
                                <div class="ms-auto align-self-end">
                                    <i class="bx bx-group display-4 text-light"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Queries Section -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-start">
                                <div class="me-2">
                                    <h5 class="card-title mb-3">Queries</h5>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="text-muted font-size-16" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.contact-list') }}">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 310px;">
                                <ul class="list-group list-group-flush">
                                    @foreach($queries as $query)
                                        <li class="list-group-item py-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                            <i class="bx bxs-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="font-size-14 mb-1">{{ $query->name }} 
                                                        <small class="text-muted float-end">{{ $query->created_at->diffForHumans() }}</small>
                                                    </h5>
                                                    <p class="text-muted">{{ $query->message }}</p>
                                                    <div>
                                                        <a href="{{ route('admin.replyView', $query->id) }}" class="text-success">
                                                            <i class="mdi mdi-reply me-1"></i> Reply
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                // Debug data
                const labels = @json($labels);
                const subscriberData = @json($subscriberData);
                console.log('Labels:', labels);
                console.log('Subscriber Data:', subscriberData);

                // Validate data
                if (!labels || !subscriberData || labels.length === 0 || subscriberData.length === 0) {
                    console.warn('No data available for chart. Using fallback data.');
                    // Fallback data
                    labels = ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7'];
                    subscriberData = [10, 20, 15, 30, 25, 40, 50];
                }

                const ctx = document.getElementById('subscribersChart').getContext('2d');
                if (!ctx) {
                    console.error('Canvas element not found.');
                    return;
                }

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Subscribers',
                            data: subscriberData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Subscribers'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error initializing chart:', error);
            }
        });
    </script>
@endsection