<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi'; // Pastikan sesuai dengan nama tabel di database
    protected $fillable = ['name']; // Kolom yang bisa diisi melalui Eloquent
}
