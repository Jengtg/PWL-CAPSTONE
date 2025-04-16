@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Detail Surat Pengantar Tugas Mata Kuliah</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Mahasiswa:</strong> {{ $surat->user->name }}</p>
            <p><strong>NIM:</strong> {{ $surat->user->id }}</p>
            <p><strong>Program Studi:</strong> {{ $surat->user->programStudi->name ?? '-' }}</p>
            <p><strong>Mata Kuliah:</strong> {{ $data->mata_kuliah }}</p>
            <p><strong>Dosen Pengampu:</strong> {{ $data->dosen_pengampu }}</p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $data->tanggal_pengajuan }}</p>
        </div>
    </div>
</div>
@endsection
