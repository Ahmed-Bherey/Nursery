<?php

namespace App\Models;

use App\Models\Treasury;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreasuryTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'user_id',
        'treasuryFrom_id',
        'treasuryTo_id',
        'amount',
    ];

    public function treasury_from(){
        return $this->belongsTo(Treasury::class , 'treasuryFrom_id' , 'id');
    }

    public function treasury_to(){
        return $this->belongsTo(Treasury::class , 'treasuryTo_id' , 'id');
    }
}
