<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganAktif extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_aktif';

    protected $fillable = [
        'surat_id',
        'nrp',
        'nama',
        'program_studi',
        'fakultas',
        'semester',
        'tahun_akademik',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
