@extends('admin.layouts.app')
@section('title', 'Staff')
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
                            <h4 class="card-title">Add Staff Member</h4>
                            <form action="{{route('admin.staff-add')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-4 my-3">
                                        <label for="example-textarea">Name</label>
                                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}"
                                                placeholder="ex: xyz" required 
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4 my-3">
                                        <label for="example-textarea">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}"
                                                placeholder="ex: example@dhanlaxmi.com" required 
                                                oninput="this.value = this.value.replace(/[^A-Za-z0-9@.]/g, '')">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4 my-3">
                                        <label for="example-textarea">Phone No.</label>
                                        <input class="form-control" type="number" name="phone" id="phone" value="{{ old('phone') }}" 
                                                placeholder="ex: Manager" required 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 my-3">
                                        <label for="example-textarea">Choose Staff Role</label>
                                        <select class="form-control" name="role_id" id="role_id" required> 
                                            <option value="" disabled selected>Choose...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" >{{ ucfirst($role->name) }}</option>
                                                @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4 my-3">
                                        <label for="example-textarea">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" 
                                                placeholder="*******" required>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4 my-3">
                                        <label for="example-textarea">Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" 
                                                placeholder="*******" required>
                                        @error('confirm_password')
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
                            <h4 class="card-title">Staff Members</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
                                        <th>Contact Details</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($staffs->count() > 0)                                         
                                        @foreach ($staffs as $key => $staff)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{$staff->role->name}}</td>
                                            <td class="align-middle">
                                                <p class="mb-1 fw-semibold text-dark">{{ ucfirst($staff->name) }}</p>
                                                <p class="mb-1 text-muted"><i class="mdi mdi-email-outline me-1"></i> {{ $staff->email }}</p>
                                                <p class="mb-0 text-muted"><i class="mdi mdi-phone-outline me-1"></i> {{ $staff->phone }}</p>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.staff-status', $staff->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="active" value="inactive">
                                                    <input type="checkbox" id="switch{{ $staff->id }}" switch="none"
                                                        name="active" value="active"
                                                        onchange="this.form.submit()" 
                                                        {{ $staff->status == 'active' ? 'checked' : '' }} />
                                                    <label for="switch{{ $staff->id }}" data-on-label="On" data-off-label="Off"></label>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal{{ $staff->id }}"><i class="bx bx-edit"></i></button>
                                                <div class="modal fade skote-centered-modal" id="transactionModal{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="transactionModalLabel{{ $staff->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{route('admin.staff-update', $staff->id)}}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="transactionModalLabel{{ $role->id }}">Update Role</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="example-textarea">Name</label>
                                                                        <input class="form-control" type="text" name="name" id="name" value="{{ $staff->name }}"
                                                                            placeholder="ex: xyz" required 
                                                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                                                        @error('name')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="example-textarea">Email</label>
                                                                        <input class="form-control" type="email" name="email" id="email" value="{{ $staff->email }}"
                                                                            placeholder="ex: example@gmil.com" required
                                                                            oninput="this.value = this.value.replace(/[^A-Za-z0-9@.]/g, '')">
                                                                        @error('email')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="example-textarea">Phone No.</label>
                                                                        <input class="form-control" type="number" name="phone" id="phone" value="{{ $staff->phone }}"
                                                                            placeholder="ex: 1234567890" required
                                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                                        @error('phone')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="example-textarea">Choose Staff Role</label>
                                                                        <select class="form-control" name="role_id" id="role_id" required> 
                                                                            <option value="" disabled selected>Choose...</option>
                                                                                @foreach ($roles as $role)
                                                                                    <option value="{{ $role->id }}" {{ $role->id == $staff->role_id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                                                                @endforeach
                                                                        </select>
                                                                        @error('role_id')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <!-- <div class="mb-3">
                                                                        <label for="example-textarea">Password</label>
                                                                        <input class="form-control" type="password" name="password" id="password" 
                                                                            placeholder="*******" required>
                                                                        @error('password')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="example-textarea">Confirm Password</label>
                                                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" 
                                                                            placeholder="*******" required>
                                                                        @error('confirm_password')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div> -->

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
                                {{ $staffs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

