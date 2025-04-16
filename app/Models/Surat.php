<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'user_id',
        'jenis_surat',
        'status_id',
    ];

    /**
     * Relasi ke User (mahasiswa yang mengajukan)
     */
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Status surat (misalnya: menunggu, disetujui, ditolak)
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    /**
     * Relasi ke Approval (persetujuan kaprodi)
     */
    public function approval()
    {
        return $this->hasOne(Approval::class);
    }

    /**
     * Relasi ke dokumen surat yang sudah diunggah oleh tata usaha
     */
    public function dokumen()
    {
        return $this->hasOne(DokumenSurat::class);
    }

    /**
     * Relasi ke data tambahan surat keterangan aktif
     */
    public function keteranganAktif()
    {
        return $this->hasOne(SuratKeteranganAktif::class);
    }

    /**
     * Relasi ke data tambahan surat pengantar tugas
     */
    public function pengantarTugas()
    {
        return $this->hasOne(SuratPengantarTugas::class);
    }

    /**
     * Relasi ke data tambahan surat keterangan lulus
     */
    public function keteranganLulus()
    {
        return $this->hasOne(SuratKeteranganLulus::class);
    }

    /**
     * Relasi ke data tambahan laporan hasil studi
     */
    public function laporanHasilStudi()
    {
        return $this->hasOne(LaporanHasilStudi::class);
    }
}
