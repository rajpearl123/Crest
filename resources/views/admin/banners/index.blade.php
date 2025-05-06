@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Manage Banners</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-dark">Banner List</h5>
                                    <!-- <a href="{{ route('admin.banners.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus-circle"></i> Add New Banner
                                    </a> -->
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Subtitle</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($banners as $banner)
                                            <tr>
                                                <td class="align-middle">{{ $banner->title }}</td>
                                                <td class="align-middle">{{ $banner->subtitle }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset($banner->image) }}" alt="Banner Image" class="img-thumbnail" width="80">
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
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
</div>

@endsection
