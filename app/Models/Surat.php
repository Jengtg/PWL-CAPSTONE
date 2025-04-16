<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat'; 

    protected $fillable = ['user_id', 'jenis_surat', 'status_id'];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function approval()
    {
        return $this->hasOne(Approval::class);
    }

    public function dokumen()
    {
        return $this->hasOne(DokumenSurat::class);
    }
    public function jenis()
    {
    return $this->belongsTo(JenisSurat::class, 'jenis_surat');
    }
    
}
