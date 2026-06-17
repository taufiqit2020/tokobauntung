<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
 
#[Fillable(['amount', 'description', 'income_date', 'user_id'])]
class EsTegukIncome extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
