@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Blogs Comments Management</h4>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-body">
			<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <select name="blog_id" class="form-control">
                <option value="">-- Filter by Blog --</option>
                @foreach($blogs as $blog)
                    <option value="{{ $blog->id }}" {{ request('blog_id') == $blog->id ? 'selected' : '' }}>
                        {{ $blog->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="text" name="name" class="form-control" placeholder="Filter by Name" value="{{ request('name') }}">
        </div>

        <div class="col-md-2">
            <input type="text" name="email" class="form-control" placeholder="Filter by Email" value="{{ request('email') }}">
        </div>

        <div class="col-md-2">
            <select name="approve" class="form-control">
                <option value="">-- Status --</option>
                <option value="1" {{ request('approve') === '1' ? 'selected' : '' }}>Approved</option>
                <option value="0" {{ request('approve') === '0' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <div class="col-md-3 d-flex">
            <button class="btn btn-primary mr-2" type="submit">Filter</button>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Blog</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $index => $comment)
@php
    $blog = DB::table('blogs')->where('id', $comment->blog_id)->first();
@endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><a href="{{ route('blogdetail', $blog->slug) }}">{{ $blog->title ?? 'N/A' }}</a></td>
                                            <td>{{ $comment->name }}</td>
                                            <td>{{ $comment->email }}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>
                                                @if($comment->approve)
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
    <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn {{ $comment->approve ? 'btn-warning' : 'btn-success' }} btn-sm">
            {{ $comment->approve ? 'Reject' : 'Approve' }}
        </button>
    </form>

    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
    </form>
</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="wptb-pagination-wrap text-center">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
