<?php

namespace App\Models;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leavel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
        'notes',
        'delete_at',
    ];

    public function classrooms(){
        return $this->hasMany(Classroom::class,'level_id','id');
    }
}
