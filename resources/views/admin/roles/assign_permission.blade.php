@extends('admin.layouts.app')
@section('title', 'Permissions Assignment')
<style>
    .event-img {
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
                            <form action="{{ route('admin.assign-permission-store') }}" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-6 my-3">
                                        <label for="role_id">Staff Role</label>
                                        <select name="role_id" id="role_id" class="form-control" required>
                                            <option value="" disabled selected>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 my-3">
                                        <label for="permission_id">Permissions</label>
                                        <select name="permission_id[]" id="permission_id" class="form-control select2" multiple required>
                                            @foreach ($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ ucfirst($permission->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
                            <h4 class="card-title">Roles & Permissions</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Assigned Permissions</th>
                                        <!-- <th>Status</th>
                                        <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($assigned_permissions->count() > 0)
                                        @foreach ($assigned_permissions as $key => $assigned_permission)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ ucfirst($role->name) }}</td>                                            
                                            <td>
                                                {{ $role->permissions->pluck('name')->implode(', ') }}
                                            </td>
                                            <!-- <td>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $assigned_permission->id }}">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            </td> -->
                                        </tr>

                                        <!-- Edit Role Modal -->
                                        <div class="modal fade" id="editRoleModal{{ $assigned_permission->id }}" tabindex="-1" aria-labelledby="editRoleLabel{{ $assigned_permission->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Role</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="name">Role Name</label>
                                                                <input class="form-control" type="text" name="name" value="" required>
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
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <div style="display: flex; flex-direction: column; align-items: center;">
                                                    <img src="{{ asset('assets/images/no-file.png') }}" alt="No File" width="100">
                                                    <p>No Assigned Permissions Found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-container">
                                {{ $assigned_permissions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
