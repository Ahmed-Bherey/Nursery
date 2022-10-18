<?php

namespace App\Models;

use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\Treasury;
use App\Models\EducationalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellUniformTotal extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_id',
        'date',
        'level_id',
        'child_id',
        'notes',
        'total',
        'delete_at',
        'treasury_id',
    ];

    public function years(){
        return $this->belongsTo(EducationalYear::class,'year_id','id');
    }

    public function levels(){
        return $this->belongsTo(Leavel::class,'level_id','id');
    }

    public function children(){
        return $this->belongsTo(AddChild::class,'child_id','id');
    }

    public function treasuries(){
        return $this->belongsTo(Treasury::class,'treasury_id','id');
    }
}
