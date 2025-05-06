@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Manage About Us section</h4>
                        </div>
                        <div class="card-body">
                            
                        <form action="{{ route('admin.why_choose_us.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label>Feature Icon (Bootstrap Icon Class)</label>
                                <input type="text" name="feature_icon" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <label>Feature Text</label>
                                <input type="text" name="feature_text" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

