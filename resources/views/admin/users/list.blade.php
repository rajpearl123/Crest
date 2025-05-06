@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Users</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end mb-3">
                                <input type="text" id="searchInput" class="form-control w-25" placeholder="Search...">
                            </div>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Profile</th>
                                            <th>Contact Details</th>
                                            <th>Joined On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key => $user)  
                                                                             
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="showImage('{{ $user->image ? asset('assets/images/user/' . $user->image) : asset('assets/web-assets/img/user/user.png') }}')">
                                                    <img src="{{ $user->image ? asset('assets/images/user/' . $user->image) : asset('assets/web-assets/img/user/user.png') }}" 
                                                        class="avatar-sm rounded-circle img-thumbnail" alt="User Image">
                                                </a>
                                            </td>
                                            <!-- Modal -->
                                            <div id="imageModal" class="modal fade" tabindex="-1" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">User Image</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img id="modalImage" src="" class="img-fluid rounded">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                                <strong>{{$user->name}}</strong>
                                                <p class="mb-0">
                                                    <a href="mailto:{{$user->email}}" class="text-primary">{{$user->email}}</a><br>
                                                    <span id="phone-{{$user->id}}" class="text-muted">{{$user->phone}}</span>
                                                    <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard('phone-{{$user->id}}')">
                                                        <i class="bx bx-copy-alt"></i>
                                                    </button>
                                                </p>
                                            </td>
                                            <td>{{ $user->created_at->format('d F Y, h:i A') }}</td>                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function copyToClipboard(elementId) {
        var text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(function() {
            console.log('Phone number copied to clipboard!');
        }).catch(function(error) {
            console.error('Error copying text: ', error);
        });
    }
</script>
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll("#datatable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? "" : "none";
        });
    });
</script>
<!-- JavaScript -->
<script>
    function showImage(imageSrc) {
        document.getElementById("modalImage").src = imageSrc;
        $("#imageModal").modal("show"); // Using Bootstrap's modal
    }
</script>
@endpush
