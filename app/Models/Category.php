<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'type'
    ];

    // Relationships
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    // Helpers
    public function totalSpent()
    {
        return $this->transactions()->where('amount', '<', 0)->sum('amount');
    }

    public function totalEarned()
    {
        return $this->transactions()->where('amount', '>', 0)->sum('amount');
    }
}
