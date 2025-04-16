@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Form Surat Keterangan Lulus</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('lulus.store') }}" method="POST">
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
                    <label for="tanggal_lulus" class="form-label">Tanggal Lulus</label>
                    <input type="date" class="form-control" id="tanggal_lulus" name="tanggal_lulus" value="{{ old('tanggal_lulus') }}" required>
                </div>

                <div class="mb-3">
                    <label for="ipk" class="form-label">IPK</label>
                    <input type="text" class="form-control" id="ipk" name="ipk" value="{{ old('ipk') }}" required>
                </div>

                <div class="mb-3">
                    <label for="gelar" class="form-label">Gelar</label>
                    <input type="text" class="form-control" id="gelar" name="gelar" value="{{ old('gelar') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Surat</button>
            </form>
        </div>
    </div>
</div>
@endsection
