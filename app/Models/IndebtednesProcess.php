<?php

namespace App\Models;

use App\Models\User;
use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\EducationalYear;
use App\Models\EducationalExpenses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndebtednesProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'year_id',
        'level_id',
        'child_id',
        'educationalExpense_id',
        'credit',
        'debt',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }

    public function years(){
        return $this->belongsTo(EducationalYear::class, 'year_id' , 'id');
    }

    public function children(){
        return $this->belongsTo(AddChild::class, 'child_id' , 'id');
    }

    public function educational_expenses(){
        return $this->belongsTo(EducationalExpenses::class, 'educationalExpense_id' , 'id');
    }

    public function levels(){
        return $this->belongsTo(Leavel::class, 'level_id' , 'id');
    }
}
