@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Detail Surat Keterangan Lulus</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Mahasiswa:</strong> {{ $surat->user->name }}</p>
            <p><strong>NIM:</strong> {{ $surat->user->id }}</p>
            <p><strong>Program Studi:</strong> {{ $surat->user->programStudi->name ?? '-' }}</p>
            <p><strong>Fakultas:</strong> {{ $data->fakultas }}</p>
            <p><strong>Tanggal Lulus:</strong> {{ $data->tanggal_lulus }}</p>
            <p><strong>Indeks Prestasi Kumulatif (IPK):</strong> {{ $data->ipk }}</p>
        </div>
    </div>
</div>
@endsection
