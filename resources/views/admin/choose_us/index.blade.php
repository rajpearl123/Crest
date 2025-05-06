@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <h4 class="mb-0">Manage "Why Choose Us" Section</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="text-end mb-3">
                                <a href="{{ route('admin.choose_us.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                        <tr>
                                            <td><strong>{{ $item->title }}</strong></td>
                                            <td>{{ Str::limit($item->content, 50) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.choose_us.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.choose_us.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
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
