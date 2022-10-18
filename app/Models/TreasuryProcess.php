<?php

namespace App\Models;

use App\Models\AddChild;
use App\Models\Employee;
use App\Models\Treasury;
use App\Models\SellUniform;
use App\Models\GeneralAccount;
use App\Models\EducationalExpenses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreasuryProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'treasury_id',
        'employee_id',
        'generalAccount_id',
        'educationalExpense_id',
        'child_id',
        'buyBook_id',
        'sellBook_id',
        'buyUniform_id',
        'sellUniform_id',
        'credit',
        'debt',
        'comment',
    ];

    public function treasuries(){
        return $this->belongsTo(Treasury::class , 'treasury_id' , 'id');
    }

    public function employees(){
        return $this->belongsTo(Employee::class , 'employee_id' , 'id');
    }

    public function generalAccounts(){
        return $this->belongsTo(GeneralAccount::class , 'generalAccount_id' , 'id');
    }

    public function educationalExpenses(){
        return $this->belongsTo(EducationalExpenses::class , 'educationalExpense_id' , 'id');
    }

    public function children(){
        return $this->belongsTo(AddChild::class , 'child_id' , 'id');
    }

    public function buyUniforms(){
        return $this->belongsTo(BuyUniform::class , 'buyUniform_id' , 'id');
    }

    public function sellUniforms(){
        return $this->belongsTo(SellUniform::class , 'sellUniform_id' , 'id');
    }

    public function buyBooks(){
        return $this->belongsTo(BuyBook::class , 'buyBook_id' , 'id');
    }

    public function sellBooks(){
        return $this->belongsTo(SellBook::class , 'sellBook_id' , 'id');
    }
}
