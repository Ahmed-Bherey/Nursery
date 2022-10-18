<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralExpensese extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'expensese_type',
        'price',
        'active',
        'delete_at',
    ];
}
