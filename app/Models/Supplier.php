<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'contact_name', 'phone', 'address'])]
class Supplier extends Model
{
    //
}
