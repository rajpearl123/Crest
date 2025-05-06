@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Admin Profile</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" aria-label="Admin Profile Information">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Profile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($admin)
                                        <tr>
                                            <td class="text-center">{{ $admin->name }}</td>
                                            <td class="text-center">{{ $admin->email }}</td>
                                            <td class="text-center">{{ $admin->mobile }}</td>
                                            <td class="text-center">
                                                @if($admin->profile && file_exists(public_path('assets/images/admin/' . $admin->profile)))
                                                    <img src="{{ asset('assets/images/admin/' . $admin->profile) }}" alt="{{ $admin->name }}'s Profile Image" width="80" height="80" style="object-fit: cover; border-radius: 50%;">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.profile') }}" class="btn btn-sm btn-primary">Update</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No admin found.</td>
                                        </tr>
                                    @endif
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