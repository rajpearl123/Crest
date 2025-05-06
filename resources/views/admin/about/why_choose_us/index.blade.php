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
                            <a href="{{ route('admin.why_choose_us.create') }}" class="btn btn-primary" style="background: white;color: black;">Add Feature</a>
                        </div>
                        <div class="card-body">
                            
                        <table class="table">
                            <thead>
                                <tr>
                                   
                                    <th>Feature</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($features as $feature)
                                    <tr>
                                        
                                        <td>{{ $feature->feature_text }}</td>
                                        <td>
                                            <a href="{{ route('admin.why_choose_us.edit', $feature->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.why_choose_us.destroy', $feature->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

