<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'account_id',
        'category_id',
        'type',
        'amount',
        'date',
        'description',
        'receipt',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'account_id' => 'integer',
        'category_id' => 'integer',
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public const TYPE_INCOME = 'income';
    public const TYPE_EXPENSE = 'expense';

    /**
     * Relations
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Account::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * Helpers
     */
    public function isIncome(): bool
    {
        return $this->type === self::TYPE_INCOME;
    }

    public function isExpense(): bool
    {
        return $this->type === self::TYPE_EXPENSE;
    }

    /**
     * Return a formatted amount (adds negative sign for expenses)
     */
    public function formattedAmount(): string
    {
        $amount = (float) $this->amount;
        return ($this->isExpense() ? '-' : '') . number_format(abs($amount), 2);
    }

    /**
     * Accessors
     */
    public function getReceiptUrlAttribute(): ?string
    {
        if (empty($this->receipt)) {
            return null;
        }

        return \Illuminate\Support\Facades\Storage::url($this->receipt);
    }

    /**
     * Mutators
     */
    public function setAmountAttribute($value): void
    {
        // normalize to a decimal string with 2 places
        $this->attributes['amount'] = number_format((float) $value, 2, '.', '');
    }

    /**
     * Scopes
     */
    public function scopeForUser(\Illuminate\Database\Eloquent\Builder $query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForAccount(\Illuminate\Database\Eloquent\Builder $query, $accountId)
    {
        return $query->where('account_id', $accountId);
    }

    public function scopeForCategory(\Illuminate\Database\Eloquent\Builder $query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeOfType(\Illuminate\Database\Eloquent\Builder $query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeBetweenDates(\Illuminate\Database\Eloquent\Builder $query, $from, $to)
    {
        if ($from) {
            $query->whereDate('date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }
        return $query;
    }
}
