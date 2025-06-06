<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSurat extends Model
{
    use HasFactory;

    protected $fillable = ['surat_id', 'file_path', 'uploaded_by'];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

