@extends('layouts.master')

@section('web-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Pengajuan Surat</h5>
        </div>
        <div class="card-body">
            <form action="#" method="GET" id="jenisSuratForm">
                <div class="mb-3">
                    <label for="nrp" class="form-label">NRP</label>
                    <input type="text" class="form-control" id="nrp" value="{{ Auth::user()->id }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studi</label>
                    <input type="text" class="form-control" id="prodi" value="{{ Auth::user()->programStudi->name ?? '-' }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                    <select name="jenis_surat" id="jenis_surat" class="form-select" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        @foreach($jenis_surats as $jenis)
                            <option value="{{ $jenis->nama }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Ajukan Surat</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('jenisSuratForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const jenis = document.getElementById('jenis_surat').value;

        if (!jenis) {
            alert('Silakan pilih jenis surat terlebih dahulu.');
            return;
        }

        // Redirect based on jenis_surat
        switch (jenis) {
            case 'Surat Keterangan Mahasiswa Aktif':
                window.location.href = "{{ route('aktif.create') }}";
                break;
            case 'Surat Pengantar Tugas Mata Kuliah':
                window.location.href = "{{ route('lulus.create') }}";
                break;
            case 'Surat Keterangan Lulus':
                window.location.href = "{{ route('tugas.create') }}";
                break;
            case 'Laporan Hasil Studi':
                window.location.href = "{{ route('studi.create') }}";
                break;
            default:
                alert('Jenis surat tidak dikenali.');
        }
    });
</script>

@endsection
