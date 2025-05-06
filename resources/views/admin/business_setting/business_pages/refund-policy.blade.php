@extends('admin.layouts.app')
@section('title', 'Refund Policy')
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
                            <h4 class="card-title">Refund Policy</h4>
                            <p class="card-title-desc">Write about your refund policies here.</p>
                            <form action="{{ route('admin.business-setting.refund-policy-store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="example-textarea">Refund Policy</label>
                                    <textarea class="form-control summernote" name="content" id="example-textarea" rows="5">{{$refund_policy->content}}</textarea>
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