<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dateFrom',
        'dateTo',
        'active',
        'delete_at',
    ];
}
