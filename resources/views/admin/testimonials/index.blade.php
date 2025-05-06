@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Testimonials Management</h4>
                        </div>
                        <div class="card-body">
                             <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Country</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $testimonial->rating }} ?</td>
                                        <td>{{ Str::limit($testimonial->review, 50, '...') }}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>
                                            @if($testimonial->image)
                                                <img src="{{ asset($testimonial->image) }}" width="50" height="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $testimonial->country }}</td>
                                        <td>
                                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="wptb-pagination-wrap text-center">
                                {{ $testimonials->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


