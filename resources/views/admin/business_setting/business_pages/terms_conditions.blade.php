@extends('admin.layouts.app')
@section('title', 'Terms & Conditions')
@php use App\Utils\ViewPath; @endphp
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            @include(ViewPath::ADMIN_INLINE_MENU_BUSINESS)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Terms & Conditions</h4>
                            <p class="card-title-desc">Write about your terms & conditions here.</p>
                            <form action="{{ route('admin.business-setting.terms-conditions-store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="example-textarea">Terms & Conditions</label>
                                    <textarea rows="4" name="content" class="form-control summernote">{{$terms_conditions->content}}</textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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