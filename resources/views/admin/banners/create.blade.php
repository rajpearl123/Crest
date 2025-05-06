@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Add Banner</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter banner title" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" placeholder="Enter banner subtitle" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Add Banner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
