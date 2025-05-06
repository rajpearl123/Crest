@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Add Blog</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Title:</label>
                                    <input type="text" name="title" class="form-control">
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
                                    <label>Author:</label>
                                    <input type="text" name="author" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Content:</label>
                                    <textarea id="editor" name="content" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Image:</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Publish Date:</label>
                                    <input type="date" name="publish_date" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Blog</button>
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