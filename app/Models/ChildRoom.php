<?php

namespace App\Models;

use App\Models\Leavel;
use App\Models\Absence;
use App\Models\Holiday;
use App\Models\AddChild;
use App\Models\Classroom;
use App\Models\ChildRegistration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'level_id',
        'classRoom_id',
        'addChlid_id',
        'delete_at',
    ];

    public function levels(){
        return $this->belongsTo(Leavel::class , 'level_id' , 'id');
    }

    public function classRooms(){
        return $this->belongsTo(Classroom::class , 'classRoom_id' , 'id');
    }

    public function add_chlids(){
        return $this->belongsTo(AddChild::class , 'addChlid_id' , 'id');
    }

    public function absences(){
        return $this->hasMany(Absence::class , 'addChild_id' , 'id');
    }

    public function absencesNext(){
        return $this->hasMany(Absence::class , 'addChild_id' , 'addChlid_id');
    }

    public function holidays(){
        return $this->hasMany(Holiday::class , 'addChild_id' , 'id');
    }
}
