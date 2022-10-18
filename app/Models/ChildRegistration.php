<?php

namespace App\Models;

use App\Models\Leavel;
use App\Models\AddChild;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_date',
        'child_id',
        'acceptance_date',
        'born_date',
        'age',
        'level_id',
        'delete_at',
        'gender',
        'city',
    ];

    public function children()
    {
        return $this->belongsTo(AddChild::class, 'child_id', 'id');
    }

    public function levels()
    {
        return $this->belongsTo(Leavel::class, 'level_id', 'id');
    }
}
