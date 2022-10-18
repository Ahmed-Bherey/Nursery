<?php

namespace App\Models;

use App\Models\AddChild;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'holidayStart',
        'holidayEnd',
        'classroom_id',
        'addChild_id',
        'holiday_reason',
        'delete_at',
    ];

    public function classrooms(){
        return $this->belongsTo(Classroom::class , 'classroom_id' , 'id');
    }

    public function addChildren(){
        return $this->belongsTo(AddChild::class , 'addChild_id' , 'id');
    }
}
