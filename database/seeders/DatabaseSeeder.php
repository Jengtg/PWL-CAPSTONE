<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\ProgramStudi;
use App\Models\Status;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Roles
        $roles = ['Master Admin', 'Tata Usaha', 'Kepala Prodi', 'Mahasiswa'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

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

        // Seed Master Admin
        User::create([
            'id' => 'admin01',
            'name' => 'Master Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'Master Admin')->first()->id,
            'prodi_id' => null,
        ]);
    }
}
