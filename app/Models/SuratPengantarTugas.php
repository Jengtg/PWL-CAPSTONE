<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantarTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_pengantar_tugas';
    protected $fillable = [
        'surat_id',
        'nrp',
        'nama',
        'program_studi',
        'mata_kuliah',
        'dosen_pengampu',
        'instansi_tujuan',
        'alamat_instansi',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
