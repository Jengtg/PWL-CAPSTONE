<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\ProgramStudi;
use App\Models\Status;
use App\Models\ProgramStudiAdmin;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed data untuk roles
//        Role::insert([
//            ['name' => 'Mahasiswa'],
//            ['name' => 'Ketua Prodi'],
//            ['name' => 'Tata Usaha'],
//        ]);

//        // Seed data untuk program studi
//        ProgramStudi::insert([
//            ['name' => 'Teknik Informatika'],
//            ['name' => 'Sistem Informasi'],
//            ['name' => 'Magister Ilmu Komputer'],
//        ]);

<<<<<<< Updated upstream
//        // Seed data untuk statuses
//        Status::insert([
//            ['nama_status' => 'Menunggu Persetujuan'],
//            ['nama_status' => 'Disetujui'],
//            ['nama_status' => 'Ditolak'],
//        ]);
=======
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
            'id' => '0001',
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
        
>>>>>>> Stashed changes

//        // Data Admin (Ketua Prodi & Tata Usaha)
//        $admins = [
//            // Ketua Prodi Teknik Informatika
//            [
//                'nama' => 'Ketua Prodi TI',
//                'email' => 'ketua.ti@example.com',
//                'password' => Hash::make('password'),
//                'prodi_id' => 1,
//                'role_id' => 2,
//                'nip' => '1000001',
//            ],
//            // Ketua Prodi Sistem Informasi
//            [
//                'nama' => 'Ketua Prodi SI',
//                'email' => 'ketua.si@example.com',
//                'password' => Hash::make('password'),
//                'prodi_id' => 2,
//                'role_id' => 2,
//                'nip' => '1000002',
//            ],
//            // Ketua Prodi Magister Ilmu Komputer
//            [
//                'nama' => 'Ketua Prodi MIK',
//                'email' => 'ketua.mik@example.com',
//                'password' => Hash::make('password'),
//                'prodi_id' => 3,
//                'role_id' => 2,
//                'nip' => '1000003',
//            ],
//            // Tata Usaha Teknik Informatika
//            [
//                'nama' => 'TU TI',
//                'email' => 'tu.ti@example.com',
//                'password' => Hash::make('password'),
//                'prodi_id' => 1,
//                'role_id' => 3,
//                'nip' => '2000001',
//            ],
//            // Tata Usaha Sistem Informasi
//            [
//                'nama' => 'TU SI',
//                'email' => 'tu.si@example.com',
//                'password' => Hash::make('password'),
//                'prodi_id' => 2,
//                'role_id' => 3,
//                'nip' => '2000002',
//            ],
//            // Tata Usaha Magister Ilmu Komputer
//            [
//                'nama' => 'TU MIK',
//                'email' => 'tu.mik@example.com',
//                'password' => Hash::make('password'),
//                'prodi_id' => 3,
//                'role_id' => 3,
//                'nip' => '2000003',
//            ],
//        ];
//
//        // Insert ke tabel users dan simpan ID yang dihasilkan
//        foreach ($admins as $admin) {
//            $user = User::create([
//                'nama' => $admin['nama'],
//                'email' => $admin['email'],
//                'password' => $admin['password'],
//                'prodi_id' => $admin['prodi_id'],
//                'role_id' => $admin['role_id'],
//                'nip' => $admin['nip'],
//            ]);
//
//            // Masukkan ke tabel program_studi_admins
//            ProgramStudiAdmin::create([
//                'prodi_id' => $admin['prodi_id'],
//                'user_id' => $user->id,
//                'role_id' => $admin['role_id'],
//            ]);
//        }
    }
}
