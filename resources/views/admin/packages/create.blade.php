@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Create Package</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.packages.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Package Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="photography">Photography</option>
                                        <option value="videography">Videography</option>
                                        <option value="offers">Offers</option>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" id="price" step="0.01" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Package Features</label>
                                    <div id="feature-wrapper">
                                        <div class="input-group mb-2">
                                            <input type="text" name="features[]" class="form-control" placeholder="Enter feature" required>
                                            <button type="button" class="btn btn-success add-feature">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Add Package</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('#feature-wrapper').addEventListener('click', function (e) {
            if (e.target.classList.contains('add-feature')) {
                let inputGroup = e.target.closest('.input-group');
                let clone = inputGroup.cloneNode(true);
                clone.querySelector('input').value = '';
                clone.querySelector('button').classList.remove('btn-success', 'add-feature');
                clone.querySelector('button').classList.add('btn-danger', 'remove-feature');
                clone.querySelector('button').innerText = '-';
                document.querySelector('#feature-wrapper').appendChild(clone);
            }

            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
@endpush
@endsection
