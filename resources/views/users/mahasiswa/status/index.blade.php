@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Daftar Status Surat</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NRP</th>
                        <th>Jenis Surat</th>
                        <th>Nama Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statuses as $index => $status)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $status->mahasiswa->id }}</td>
                            <td>{{ $status->jenis_surat }}</td>
                            <td>{{ $status->status->nama_status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
