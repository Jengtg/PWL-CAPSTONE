<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'prodi_id');
    }
}
