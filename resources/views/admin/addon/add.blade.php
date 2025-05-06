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
                            <form action="{{ route('admin.addon.addOnStore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-6 my-3">
                                        <label for="example-textarea">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter cake Name" required>
                                    </div>
                                    <div class="col-6 my-3">
                                        <label for="image">Image</label>
                                        {{-- <div class="mt-2">
                                            <img id="imagePreview" src="{{ asset('assets/images/no-file.png') }}" alt="Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                                        </div> --}}
                                        <input class="form-control" type="file" name="image" id="image" accept="image/*" required onchange="previewImage(event)">
                                    </div>
                                    <div class="col-6">
                                        <label for="example-textarea mt-3">Price</label>
                                        <input class="form-control" type="number" name="price" id="price" placeholder="Enter Price" required>
                                    </div>

                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">AddOns</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Prices</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($addons->count() > 0)                                         
                                        @foreach ($addons as $key => $addon)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{asset('assets/images/addons/'.$addon->image)}}" class="event-img" alt="No Image"></td>
                                            <td>{{ ucfirst($addon->name) }}</td>
                                            <td>{{$addon->price}}</td>
                                            <td>
                                                <form action="{{ route('admin.addon.addonStatus', $addon->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="active" value="1">
                                                    <input type="checkbox" id="switch{{ $addon->id }}" switch="none"
                                                        name="active" value="0"
                                                        onchange="this.form.submit()" 
                                                        {{ $addon->status == '0' ? 'checked' : '' }} />
                                                    <label for="switch{{ $addon->id }}" data-on-label="On" data-off-label="Off"></label>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.addon.editAddOnView', $addon->id)}}">
                                                    <button class="btn btn-primary" ><i class="bx bx-edit"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <img src="{{ asset('assets/images/no-file.png') }}" alt="No File" width="100">
                                                    <p>No AddOns Found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                {{ $addons->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

