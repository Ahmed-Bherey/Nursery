<?php

namespace App\Models;
use App\Models\AddChild;
use App\Models\Treasury;
use App\Models\EducationalExpenses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalExpensesCollection extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'level_id',
        'treasury_id',
        'child_id',
        'expenses_id',
        'total_paid',
        'rest',
        'notes',
        'delete_at',
    ];

    public function treasuries()
    {
        return $this->belongsTo(Treasury::class, 'treasury_id', 'id');
    }

    public function children()
    {
        return $this->belongsTo(AddChild::class, 'child_id', 'id');
    }

    public function educationalExpenses()
    {
        return $this->belongsTo(EducationalExpenses::class, 'expenses_id', 'id');
    }

    public function educationalExpensesCollections()
    {
        return $this->hasMany(EducationalExpenses::class, 'expenses_id', 'id');
    }

    public function levels()
    {
        return $this->belongsTo(EducationalExpenses::class, 'level_id', 'id');
    }
}
