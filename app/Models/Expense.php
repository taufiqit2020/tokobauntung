<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['category', 'amount', 'description', 'expense_date', 'attachment_path', 'user_id'])]
class Expense extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
