<?php

namespace App\Models;

use App\Models\Absence;
use Illuminate\Database\Eloquent\Model;
use App\Models\EducationalExpensesCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddChild extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'id_number',
        'address',
        'father_name',
        'father_tel',
        'mother_name',
        'mother_tel',
        'another_tel',
        'img',
        'religion',
        'active',
        'delete_at',
        'year_id',
        'fatherJob',
        'motherJob',
    ];

    public function childRooms()
    {
        return $this->hasMany(ChildRoom::class, 'addChlid_id', 'id');
    }

    public function educationalExpensesCollections()
    {
        return $this->hasMany(EducationalExpensesCollection::class, 'child_id', 'id');
    }

    public function childRegistrations()
    {
        return $this->hasMany(ChildRegistration::class, 'child_id', 'id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'addChild_id', 'id');
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class, 'addChild_id', 'id');
    }

}
