<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_id',
        'approved_by',
        'status_id',
        'comment',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
    
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
