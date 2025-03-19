<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudiAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['prodi_id', 'user_id', 'role_id', 'assigned_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
