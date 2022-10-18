<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Treasury;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'employee_id',
        'treasury_id',
        'main_salary',
        'job_type',
        'reward',
        'reward_reason',
        'absent_day',
        'discount',
        'total_salary',
        'delete_at',
    ];

    public function employees(){
        return $this->belongsTo(Employee::class , 'employee_id' , 'id');
    }

    public function treasuries(){
        return $this->belongsTo(Treasury::class , 'treasury_id' , 'id');
    }
}
