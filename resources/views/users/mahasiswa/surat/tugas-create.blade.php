@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Form Surat Pengantar Tugas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tugas.store') }}" method="POST">
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
                    <label for="mata_kuliah" class="form-label">Mata Kuliah</label>
                    <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah" value="{{ old('mata_kuliah') }}" required>
                </div>

                <div class="mb-3">
                    <label for="dosen_pengampu" class="form-label">Dosen Pengampu</label>
                    <input type="text" class="form-control" id="dosen_pengampu" name="dosen_pengampu" value="{{ old('dosen_pengampu') }}" required>
                </div>

                <div class="mb-3">
                    <label for="instansi_tujuan" class="form-label">Instansi Tujuan</label>
                    <input type="text" class="form-control" id="instansi_tujuan" name="instansi_tujuan" value="{{ old('instansi_tujuan') }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                    <textarea class="form-control" id="alamat_instansi" name="alamat_instansi" required>{{ old('alamat_instansi') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Surat</button>
            </form>
        </div>
    </div>
</div>
@endsection
