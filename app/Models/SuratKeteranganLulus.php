<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganLulus extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangan_lulus';

    protected $fillable = [
        'surat_id',
        'nrp',
        'nama',
        'program_studi',
        'tanggal_lulus',
        'ipk',
        'gelar',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
