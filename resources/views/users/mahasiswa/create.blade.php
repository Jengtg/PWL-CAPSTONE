@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header"><h5>Ajukan Surat</h5></div>
        <div class="card-body">
            <form action="{{ route('surat.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                    <input type="text" name="jenis_surat" id="jenis_surat" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan</button>
            </form>
        </div>
    </div>
</div>
@endsection
