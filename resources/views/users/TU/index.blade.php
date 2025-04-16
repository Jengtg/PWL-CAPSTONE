@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Daftar Surat Disetujui</h5>
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
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Jenis Surat</th>
                        <th>Data</th>
                        <th>Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($surats as $surat)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $surat->user->name }}</td>
                            <td>{{ $surat->user->id }}</td>
                            <td>{{ $surat->user->programStudi->name ?? '-' }}</td>
                            <td>{{ $surat->jenis_surat }}</td>
                            <td>
                                <a href="{{ route('tu.surat.data', $surat->id) }}" class="btn btn-info btn-sm">Data</a>

                            </td>
                            <td>
                                @if ($surat->file_path)
                                    <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="btn btn-success btn-sm">Lihat File</a>
                                @else
                                    <form action="{{ route('tu.surat.upload', $surat->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" accept="application/pdf" required>
                                        <button type="submit" class="btn btn-primary btn-sm mt-1">Submit</button>
                                    </form>
                                
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada surat yang tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
