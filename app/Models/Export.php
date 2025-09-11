<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','filename','status','format','params','error','completed_at'
    ];

    protected $casts = [
        'params' => 'array',
        'completed_at' => 'datetime',
    ];
}
