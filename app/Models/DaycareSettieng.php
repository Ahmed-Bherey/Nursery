<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycareSettieng extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'website',
        'tel1',
        'tel2',
        'tel3',
        'fax',
        'address',
        'commercial_number',
        'commercial_id',
        'logo',
        'vision',
        'mission',
    ];
}
