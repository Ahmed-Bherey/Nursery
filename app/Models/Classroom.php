<?php

namespace App\Models;

use App\Models\Leavel;
use App\Models\ChildRoom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'level_id',
        'student_count',
        'notes',
        'active',
        'delete_at',
    ];

    public function levels(){
        return $this->belongsTo(Leavel::class,'level_id','id');
    }

    public function childRooms(){
        return $this->hasMany(ChildRoom::class , 'classRoom_id' , 'id');
    }
}
