@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Home Gallery Management</h4>
                        </div>
                        <div class="card-body">
                             <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($album)
            <tr>
                <td>{{ $album->title }}</td>
                <td>{{ $album->description }}</td>
                <td>
                    @php 
			$images = $album->album; 
		   @endphp
                    @if (!empty($images))
                        @foreach ($images as $image)
                            <img src="{{ asset($image['src']) }}" width="80" class="m-1">
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.home_albums.edit') }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            @else
            <tr>
                <td colspan="4" class="text-center">No album found</td>
            </tr>
            @endif
        </tbody>
    </table>                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


