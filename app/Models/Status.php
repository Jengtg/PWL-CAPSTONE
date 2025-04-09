<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['nama_status'];

    public function surat()
    {
        return $this->hasMany(Surat::class, 'status_id');
    }
}
