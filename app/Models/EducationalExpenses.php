<?php

namespace App\Models;

use App\Models\EducationalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalExpenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'level_id',
        'name',
        'notes',
        'active',
        'educationalYear_id',
        'amount',
        'delete_at',
    ];

    public function educationalYears(){
        return $this->belongsTo(EducationalYear::class,'educationalYear_id','id');
    }

    public function leavels(){
        return $this->belongsTo(Leavel::class,'level_id','id');
    }
}
