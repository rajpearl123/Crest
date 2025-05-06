@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-white text-center">
                            <h4>Edit Package</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.packages.update', $package->id) }}">
                                @csrf
                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Package Name</label>
                                    <input type="text" name="name" value="{{ $package->name }}" class="form-control" required>
                                </div>
                
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="photography" {{ $package->type == 'photography' ? 'selected' : '' }}>Photography</option>
                                        <option value="videography" {{ $package->type == 'videography' ? 'selected' : '' }}>Videography</option>
                                    </select>
                                </div>
                
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" step="0.01" value="{{ $package->price }}" class="form-control">
                                </div>
                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $package->description }}</textarea>
                                </div>
                
                                <div class="mb-3">
                                    <label class="form-label">Features</label>
                                    <div id="feature-wrapper">
                                        @php
                                            $features = json_decode($package->features, true) ?? [];
                                        @endphp
                                
                                        @foreach ($features as $index => $feature)
                                            <div class="input-group mb-2">
                                                <input type="text" name="features[]" value="{{ $feature }}" class="form-control" required>
                                                <button type="button" class="btn {{ $index == 0 ? 'btn-success add-feature' : 'btn-danger remove-feature' }}">
                                                    {{ $index == 0 ? '+' : '-' }}
                                                </button>
                                            </div>
                                        @endforeach
                                
                                        @if (empty($features))
                                            <div class="input-group mb-2">
                                                <input type="text" name="features[]" class="form-control" required>
                                                <button type="button" class="btn btn-success add-feature">+</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                
                                <button type="submit" class="btn btn-success">Update Package</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const wrapper = document.querySelector('#feature-wrapper');

        wrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-feature')) {
                const inputGroup = e.target.closest('.input-group');
                const clone = inputGroup.cloneNode(true);
                clone.querySelector('input').value = '';

                const button = clone.querySelector('button');
                button.classList.remove('btn-success', 'add-feature');
                button.classList.add('btn-danger', 'remove-feature');
                button.textContent = '-';

                wrapper.appendChild(clone);
            }

            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
@endpush

