@extends('admin.layouts.app')
@section('title', 'Roles')
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
                            <h4 class="card-title">Add Role</h4>
                            <form action="{{route('admin.role-store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-6 my-3">
                                        <label for="example-textarea">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" 
                                                placeholder="ex: Manager" required 
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                            <h4 class="card-title">Roles</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($roles->count() > 0)                                         
                                        @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ ucfirst($role->name) }}</td>
                                            <td>
                                                <form action="{{ route('admin.role-status', $role->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="active" value="inactive">
                                                    <input type="checkbox" id="switch{{ $role->id }}" switch="none"
                                                        name="active" value="active"
                                                        onchange="this.form.submit()" 
                                                        {{ $role->status == 'active' ? 'checked' : '' }} />
                                                    <label for="switch{{ $role->id }}" data-on-label="On" data-off-label="Off"></label>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal{{ $role->id }}"><i class="bx bx-edit"></i></button>
                                                <div class="modal fade skote-centered-modal" id="transactionModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel{{ $role->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{route('admin.role-update', $role->id)}}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="transactionModalLabel{{ $role->id }}">Update Role</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="example-textarea">Name</label>
                                                                        <input class="form-control" type="text" name="name" id="name" 
                                                                            value="{{ $role->name }}" required 
                                                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <img src="{{ asset('assets/images/no-file.png') }}" alt="No File" width="100">
                                                    <p>No Roles Found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

