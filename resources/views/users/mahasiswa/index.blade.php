@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Pengajuan Surat Saya</h5>
            <a href="{{ route('surat.create') }}" class="btn btn-primary">Ajukan Surat Baru</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Surat</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->jenis_surat }}</td>
                            <td>{{ $item->status->nama ?? '-' }}</td>
                            <td>
                                @if ($item->file_path)
                                    <a href="{{ Storage::url($item->file_path) }}" target="_blank">Lihat File</a>
                                @else
                                    Belum ada file
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('surat.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <form action="{{ route('surat.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus surat ini?')">Hapus</button>
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
