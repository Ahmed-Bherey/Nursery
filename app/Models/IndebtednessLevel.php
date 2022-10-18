<?php

namespace App\Models;

use App\Models\EducationalExpenses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndebtednessLevel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'year_id',
        'level_id',
        'child_id',
        'educationalExpense_id',
        'amount',
        'pay',
        'note',
        'delete_at',
    ];

    public function levels()
    {
        return $this->belongsTo(Leavel::class, 'level_id', 'id');
    }

    public function years()
    {
        return $this->belongsTo(EducationalYear::class, 'year_id', 'id');
    }

    public function educational_expenses()
    {
        return $this->belongsTo(EducationalExpenses::class, 'educationalExpense_id', 'id');
    }

    public function endebtednessLevels()
    {
        return $this->belongsTo(IndebtednessLevel::class, 'IndebtednessLevel_id', 'id');
    }

    public function childs()
    {
        return $this->belongsTo(AddChild::class, 'child_id', 'id');
    }
}
