@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary text-white text-center py-3">
                            <h4 class="mb-0" style="color:black;">?? Manage Blogs</h4>
                        </div>

                        @php
                        $settings = \App\Models\Blog::first();
                        @endphp

                        <div class="text-center mt-4">
                            <label class="switch">
                                <input type="checkbox" id="toggleVisibility" {{ $settings->show_author_date ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                            <p class="mt-2 font-weight-bold text-muted">Show Author & Publish Date</p>
                        </div>

                        <div class="card-body">
                            <div class="card-body">
                                <form method="GET" class="row mb-4">
                                    <div class="col-md-5">
                                        <select name="category" class="form-control">
                                            <option value="">-- Filter by Category --</option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="author" class="form-control" placeholder="Filter by Author" value="{{ request('author') }}">
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                                    </div>
                                </form>

                                <!-- Table with View button -->
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="bg-light text-dark">
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Image</th>
                                            <th>Publish Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $key => $blog)
                                        <tr class="text-center">
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-primary font-weight-bold"><a href="{{ route('blogdetail', $blog->slug) }}">{{ $blog->title }}</a></td>
                                            <td class="text-info">{{ $blog->author }}</td>
                                            <td class="text-success">
                                                {{ $blog->category->name ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($blog->image) }}" width="80" class="rounded shadow-sm" alt="Blog Image">
                                            </td>
                                            <td class="text-muted">{{ \Carbon\Carbon::parse($blog->publish_date)->format('d M Y') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#blogModal" 
                                                        data-id="{{ $blog->id }}"
                                                        data-title="{{ $blog->title }}"
                                                        data-image="{{ asset($blog->image) }}"
                                                        data-content="{{ $blog->content }}">
                                                     View
                                                </button>
                                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                                    ?? Edit
                                                </a>
                                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        ?? Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- card body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="blogModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="blogImage" src="" alt="Blog Image" style="max-width: 100%; max-height: 300px; display: block; margin: 0 auto;">
                <div id="blogContent" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 24px;
    }

    .slider::before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider::before {
        transform: translateX(26px);
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

@endsection
@push('js')

<script>
    document.getElementById('toggleVisibility').addEventListener('change', function() {
        let status = this.checked ? 1 : 0;
        fetch("{{ route('admin.blog.toggleVisibility') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    show_author_date: status
                })
            }).then(response => response.json())
            .then(data => alert(data.message));
    });

    // Modal content update
    document.getElementById('blogModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const title = button.getAttribute('data-title');
        const image = button.getAttribute('data-image');
        const content = button.getAttribute('data-content');

        const modalTitle = this.querySelector('#blogModalLabel');
        const modalImage = this.querySelector('#blogImage');
        const modalContent = this.querySelector('#blogContent');

        modalTitle.textContent = title;
        modalImage.src = image;
        modalContent.innerHTML = content; // Assuming content is HTML or plain text
    });
</script>

@endpush