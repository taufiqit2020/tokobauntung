<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'invoice_number', 'shift_id', 'user_id', 'subtotal',
    'discount', 'tax', 'grand_total', 'payment_method',
    'amount_paid', 'change_due', 'is_synced'
])]
class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
