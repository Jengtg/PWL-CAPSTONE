@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Program Studi</h5>
            <a href="{{ route('program-studi.create') }}" class="btn btn-primary">Tambah Program Studi</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programStudi as $index => $prodi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $prodi->name }}</td>
                            <td>
                                <a href="{{ route('program-studi.edit', $prodi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('program-studi.destroy', $prodi->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Program Studi ini?')">Hapus</button>
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
