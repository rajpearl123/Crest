@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Services Management</h4>
                        </div>
                        <div class="card-body">
                             <table class="table table-striped">
<div class="mb-3">
    <form method="GET" action="{{ route('admin.steps.index') }}">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.steps.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

                           <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($steps as $step)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $step->title }}</td>
                <td>
                    @if($step->image)
                        <img src="{{ asset($step->image) }}" width="50">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $step->description }}</td>
                <td>
                    <a href="{{ route('admin.steps.edit', $step->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.steps.destroy', $step->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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

@endsection


