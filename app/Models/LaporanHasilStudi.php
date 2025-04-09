<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilStudi extends Model
{
    use HasFactory;

    protected $table = 'laporan_hasil_studi';

    protected $fillable = [
        'surat_id',
        'nrp',
        'nama',
        'program_studi',
        'semester',
        'ip_semester',
        'ipk',
        'jumlah_sks',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
