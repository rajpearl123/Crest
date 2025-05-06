@extends('admin.layouts.app')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Manage About Us Section</h4>
                        </div>
                        <div class="card-body">
                            
                            <form action="{{ route('admin.about.update') }}" method="POST">
                                @csrf
                                @method('POST')
                                
                                <div class="mb-3">
                                    <label>Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" value="{{ $section->subtitle ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $section->title ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $section->description ?? '' }}</textarea>
                                </div>

                                <!-- Progress Bars Section -->
                                <h4>Progress Bars</h4>
                                @php
                                    $progress_bars = !empty($section->progress_bars) ? json_decode($section->progress_bars, true) : []; 
                                @endphp                                

                                <div id="progress-bars">
                                    @foreach($progress_bars as $index => $progress)
                                        <div class="progress-item">
                                            <input type="text" name="progress_bars[{{ $index }}][label]" placeholder="Label" value="{{ $progress['label'] }}" class="form-control mb-2">
                                            <input type="number" name="progress_bars[{{ $index }}][value]" placeholder="Value" value="{{ $progress['value'] }}" class="form-control mb-2">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-progress" class="btn btn-secondary mb-3">Add Progress</button>

                                <div class="mb-3">
                                    <label>Operation Description</label>
                                    <textarea name="op_desc" class="form-control">{{ $section->op_desc ?? '' }}</textarea>
                                </div>

                                <!-- Operation Data Section -->
                                <h4>Operation Data</h4>
                                @php
                                    $operation_data = !empty($section->operation_data) ? json_decode($section->operation_data, true) : [];
                                @endphp

                                <div id="operation-data">
                                    @foreach($operation_data as $index => $operation)
                                        <div class="operation-item">
                                            <input type="text" name="operation_data[{{ $index }}][op_data]" placeholder="Operation Data" value="{{ $operation['op_data'] }}" class="form-control mb-2">
                                            <input type="text" name="operation_data[{{ $index }}][op_title]" placeholder="Operation Title" value="{{ $operation['op_title'] }}" class="form-control mb-2">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-operation" class="btn btn-secondary mb-3">Add Operation</button>

                                <button type="submit" class="btn btn-primary">Save</button>
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
document.getElementById('add-progress').addEventListener('click', function() {
    let index = document.querySelectorAll('.progress-item').length;
    let html = `
        <div class="progress-item">
            <input type="text" name="progress_bars[${index}][label]" placeholder="Label" class="form-control mb-2">
            <input type="number" name="progress_bars[${index}][value]" placeholder="Value" class="form-control mb-2">
        </div>
    `;
    document.getElementById('progress-bars').insertAdjacentHTML('beforeend', html);
});

document.getElementById('add-operation').addEventListener('click', function() {
    let index = document.querySelectorAll('.operation-item').length;
    let html = `
        <div class="operation-item">
            <input type="number" name="operation_data[${index}][op_data]" placeholder="Operation Data" class="form-control mb-2">
            <input type="text" name="operation_data[${index}][op_title]" placeholder="Operation Title" class="form-control mb-2">
        </div>
    `;
    document.getElementById('operation-data').insertAdjacentHTML('beforeend', html);
});
</script>
@endpush
