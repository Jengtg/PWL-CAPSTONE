@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Status Pengajuan Surat</h2>

    <div id="status-table-container">
        <p>Memuat data...</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', async function () {
    const container = document.getElementById('status-table-container');

    try {
        const response = await fetch("{{ route('statuses.index') }}", {
            headers: {
                'Accept': 'application/json',
            }
        });

        const result = await response.json();

        if (!result.success && !Array.isArray(result)) {
            container.innerHTML = '<p>Gagal memuat data surat.</p>';
            return;
        }

        const suratList = Array.isArray(result) ? result : result.data;

        if (suratList.length === 0) {
            container.innerHTML = '<p>Anda belum mengajukan surat apapun.</p>';
            return;
        }

        let html = `
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Surat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
        `;

        suratList.forEach(item => {
            let statusText = 'Tidak Diketahui';

            switch (item.status_id) {
                case 1:
                    statusText = 'Menunggu Persetujuan';
                    break;
                case 2:
                    statusText = 'Disetujui';
                    break;
                case 3:
                    statusText = 'Ditolak';
                    break;
            }

            html += `
                <tr>
                    <td>${item.jenis_surat}</td>
                    <td>${statusText}</td>
                </tr>
            `;
        });

        html += `
                </tbody>
            </table>
        `;

        container.innerHTML = html;

    } catch (error) {
        container.innerHTML = '<p>Terjadi kesalahan saat memuat data.</p>';
    }
});
</script>
@endsection
