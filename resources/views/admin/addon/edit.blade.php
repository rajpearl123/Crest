@extends('admin.layouts.app')
@section('title', 'Add AddOns')
<style>
    .event-img{
        height: 50px;
    }
</style>
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add AddOns</h4>
                            <form action="{{ route('admin.addon.addOnEditStore', $addon->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-6 my-3">
                                        <label for="example-textarea">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" value="{{$addon->name ?? ''}}" placeholder="Enter cake Name" required>
                                    </div>
                                    <div class="col-6 my-3">
                                        <label for="image">Image</label>
                                        {{-- <div class="mt-2">
                                            <img id="imagePreview" src="{{ asset('assets/images/no-file.png') }}" alt="Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div> --}}
                                        <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    <div class="col-6">
                                        <label for="example-textarea mt-3">Price</label>
                                        <input class="form-control" type="number" name="price" id="price" value="{{$addon->price ?? ''}}" placeholder="Enter Price" required>
                                    </div>

                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>