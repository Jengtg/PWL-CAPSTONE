<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\ProgramStudi;
use App\Models\Status;
use App\Models\User;
use App\Models\JenisSurat;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Seed Program Studi
        $programStudis = ['Teknik Informatika', 'Sistem Informasi', 'Magister Ilmu Komputer'];
        foreach ($programStudis as $prodi) {
            ProgramStudi::create(['name' => $prodi]);
        }

        // Seed Statuses
        $statuses = ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'];
        foreach ($statuses as $status) {
            Status::create(['nama_status' => $status]);
        }

        // Seed Roles
        $roles = ['Master Admin', 'Tata Usaha', 'Kepala Prodi', 'Mahasiswa'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Seed Master Admin
        User::create([
            'id' => 'admin01',
            'name' => 'Master Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'Master Admin')->first()->id,
            'prodi_id' => null,
        ]);

        $jenisSurats = [
            [
                'nama' => 'Surat Keterangan Mahasiswa Aktif',
                'deskripsi' => 'Digunakan sebagai bukti bahwa mahasiswa masih aktif terdaftar di perguruan tinggi.',
                'template_path' => 'templates/mahasiswa_aktif.docx',
                'is_active' => true,
            ],
            [
                'nama' => 'Surat Pengantar Tugas Mata Kuliah',
                'deskripsi' => 'Untuk keperluan tugas mata kuliah seperti observasi atau magang.',
                'template_path' => 'templates/tugas_mata_kuliah.docx',
                'is_active' => true,
            ],
            [
                'nama' => 'Surat Keterangan Lulus',
                'deskripsi' => 'Surat keterangan bahwa mahasiswa telah menyelesaikan studinya.',
                'template_path' => 'templates/lulus.docx',
                'is_active' => true,
            ],
            [
                'nama' => 'Laporan Hasil Studi',
                'deskripsi' => 'Rekap nilai dan hasil studi selama masa perkuliahan.',
                'template_path' => 'templates/hasil_studi.docx',
                'is_active' => true,
            ],
        ];

        foreach ($jenisSurats as $jenisSurat) {
            JenisSurat::create($jenisSurat);
        }
        

    }
}
