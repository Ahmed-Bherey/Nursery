<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'treasury_secretary',
        'balance',
        'active',
        'delete_at',
    ];
}
