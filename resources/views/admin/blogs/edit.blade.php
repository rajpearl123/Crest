@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Add Blog</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" name="author" class="form-control" value="{{ $blog->author }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Blog Category:</label>
                                <select name="blog_category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea id="editor" name="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Publish Date</label>
                                    <input type="date" name="publish_date" class="form-control" value="{{ $blog->publish_date }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Image</label><br>
                                    <img src="{{ asset($blog->image) }}" width="120" alt="Blog Image">
                                    <input type="file" name="image" class="form-control mt-2">
                                </div>

                                <button type="submit" class="btn btn-primary">Update Blog</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editor = new Jodit("#editor", {
            height: 300, // Adjust the editor height
            toolbarSticky: false, // Toolbar will not stick on scroll
            defaultMode: "1", // Start in WYSIWYG mode
            uploader: {
                insertImageAsBase64URI: true // Allows direct image uploads
            }
        });
    });
</script>

@endpush
