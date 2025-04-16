@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Form Surat Keterangan Aktif</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('aktif.store') }}" method="POST">
                @csrf

                <input type="hidden" name="surat_id" value="{{ $surat_id }}">

                <div class="mb-3">
                    <label for="nrp" class="form-label">NRP</label>
                    <input type="text" class="form-control" id="nrp" name="nrp" value="{{ old('nrp', $user->id) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->name) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="program_studi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control" id="program_studi" name="program_studi" value="{{ old('program_studi', $user->programStudi->name) }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="fakultas" class="form-label">Fakultas</label>
                    <input type="text" class="form-control" id="fakultas" name="fakultas" value="{{ old('fakultas','Fakultas Teknologi dan Rekayasa Cerdas') }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester" value="{{ old('semester') }}" required>
                </div>

                <div class="mb-3">
                    <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                    <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" placeholder="2024/2025" value="{{ old('tahun_akademik') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Surat</button>
            </form>
        </div>
    </div>
</div>
@endsection
