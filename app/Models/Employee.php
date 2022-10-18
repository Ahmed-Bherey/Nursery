<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeAbcencePermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'id_number',
        'address',
        'tel1',
        'tel2',
        'educational_qualification',
        'graducation_date',
        'employee_type',
        'hiring_date',
        'main_salary',
        'insurance',
        'insurance_date',
        'delete_at',
    ];

    public function employeeAbcencePermissions(){
        return $this->hasMany(EmployeeAbcencePermission::class , 'employee_id' , 'id');
    }
}
