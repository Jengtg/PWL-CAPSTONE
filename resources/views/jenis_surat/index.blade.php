@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Jenis Surat</h5>
            <a href="{{ route('jenis_surat.create') }}" class="btn btn-primary">Add Jenis Surat</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Template</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisSurat as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->nama }}</td>
                            <td>{{ $surat->deskripsi }}</td>
                            <td>{{ $surat->template_path }}</td>
                            <td>{{ $surat->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('jenis_surat.edit', $surat->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('jenis_surat.destroy', $surat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
