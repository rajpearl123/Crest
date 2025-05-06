@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Edit Item</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('admin.choose_us.update', $whyChooseUs->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $whyChooseUs->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Content</label>
                                <textarea name="content" class="form-control" required>{{ $whyChooseUs->content }}</textarea>
                            </div>
                            <button class="btn btn-success">Update</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
