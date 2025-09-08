<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_id',
        'limit',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'category_id' => 'integer',
        'limit' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helpers
    public function spent()
    {
        return $this->category->transactions()
            ->whereBetween('date', [$this->start_date, $this->end_date])
            ->sum('amount');
    }

    public function remaining()
    {
        return $this->amount - abs($this->spent());
    }

    public function progress()
    {
        return $this->amount > 0
            ? round((abs($this->spent()) / $this->amount) * 100, 2)
            : 0;
    }
}
