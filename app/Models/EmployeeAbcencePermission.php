<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeAbcencePermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'type',
        'employee_id',
        'absence_reason',
        'delete_at',
    ];

    public function employees(){
        return $this->belongsTo(Employee::class , 'employee_id' , 'id');
    }
}
