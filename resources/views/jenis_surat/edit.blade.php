@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Edit Jenis Surat</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_surat.update', $jenisSurat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $jenisSurat->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $jenisSurat->deskripsi }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="template_path" class="form-label">Template Path</label>
                    <input type="text" class="form-control" id="template_path" name="template_path" value="{{ $jenisSurat->template_path }}">
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select class="form-select" id="is_active" name="is_active">
                        <option value="1" {{ $jenisSurat->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$jenisSurat->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
