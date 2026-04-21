<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    protected $fillable = [
        'title',
        'source',
        'amount',
        'received_on',
        'notes',
        'payment_channel',
        'debit_card_id',
        'credit_card_id',
    ];

    protected function casts(): array
    {
        return [
            'received_on' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    public function debitCard(): BelongsTo
    {
        return $this->belongsTo(DebitCard::class);
    }

    public function creditCard(): BelongsTo
    {
        return $this->belongsTo(CreditCard::class);
    }
}
