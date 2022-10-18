<?php

namespace App\Models;

use App\Models\EducationalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuyUniformTotal extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_id',
        'date',
        'supplier',
        'notes',
        'total_buy',
        'total_sale',
        'delete_at',
        'treasury_id',
    ];

    public function years(){
        return $this->belongsTo(EducationalYear::class,'year_id','id');
    }

    public function treasuries(){
        return $this->belongsTo(Treasury::class,'treasury_id','id');
    }
}
