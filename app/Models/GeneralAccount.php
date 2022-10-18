<?php

namespace App\Models;

use App\Models\Treasury;
use App\Models\GeneralExpensese;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'treasury_id',
        'generalExpensese_id',
        'amount',
        'delete_at',
    ];

    public function treasuries(){
        return $this->belongsTo(Treasury::class , 'treasury_id' , 'id');
    }

    public function generalExpenseses(){
        return $this->belongsTo(GeneralExpensese::class , 'generalExpensese_id' , 'id');
    }
}
