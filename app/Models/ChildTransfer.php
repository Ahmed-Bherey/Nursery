<?php

namespace App\Models;

use App\Models\AddChild;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'level_id',
        'classroomFrom_id',
        'classroomTo_id',
        'addChild_id',
        'delete_at',
    ];

    public function classroomsFrom(){
        return $this->belongsTo(Classroom::class , 'classroomFrom_id' , 'id');
    }

    public function classroomsTo(){
        return $this->belongsTo(Classroom::class , 'classroomTo_id' , 'id');
    }

    public function addChildren(){
        return $this->belongsTo(AddChild::class , 'addChild_id' , 'id');
    }
}
