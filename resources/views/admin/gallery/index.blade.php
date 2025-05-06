@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Gallery Management</h4>
                        </div>
                        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                        <div class="card-body">
<form method="GET" action="{{ route('admin.gallery.index') }}" class="mb-3 d-flex align-items-center gap-3">
    <select name="category_id" class="form-select w-auto">
        <option value="">-- Filter by Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Reset</a>
</form>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <!-- <th>Author</th> -->
                                        <!-- <th>Link</th> -->
                                         <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($galleries as $gallery)
                                    <tr>
                                        <td><img src="{{ asset($gallery->image) }}" width="100"></td>
                                        <td>{{ $gallery->title }}</td>
                                        <td>{{ $gallery->category->name ?? 'N/A' }}</td>

                                        <!-- <td>{{ $gallery->author }}</td> -->
                                        <!-- <td><a href="{{ $gallery->link }}" target="_blank">View</a></td> -->
                                        <td>
                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                             </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="wptb-pagination-wrap text-center">
                                {{ $galleries->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


