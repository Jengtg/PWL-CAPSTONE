@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Daftar Surat Menunggu Persetujuan</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jenis Surat</th> <!-- Added this column -->
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ $surat->mahasiswa->name ?? 'N/A' }}</td> <!-- Ensure Mahasiswa Name is displayed -->
                            <td>{{ $surat->jenis_surat ?? 'N/A' }}</td> <!-- Ensure Jenis Surat is displayed -->
                            <td>{{ $surat->status->nama_status }}</td>
                            <td class="d-flex gap-1">
                                <form action="{{ route('kaprodi.surat.approve', $surat->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    <input type="text" name="comment" class="form-control form-control-sm me-2" placeholder="Komentar" required>
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>

                                <form action="{{ route('kaprodi.surat.reject', $surat->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    <input type="text" name="comment" class="form-control form-control-sm me-2" placeholder="Komentar" required>
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada surat yang menunggu persetujuan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
