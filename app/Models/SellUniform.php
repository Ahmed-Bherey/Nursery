<?php

namespace App\Models;

use App\Models\BuyUniform;
use App\Models\EducationalYear;
use App\Models\SellUniformTotal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellUniform extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_id',
        'sellUniformTotal_id',
        'buyUniform_id',
        'quantity',
        'price',
        'subTotal',
        'delete_at'
    ];

    public function years(){
        return $this->belongsTo(EducationalYear::class,'year_id','id');
    }

    public function sellUniformTotals(){
        return $this->belongsTo(SellUniformTotal::class,'sellUniformTotal_id','id');
    }

    public function buyUniforms(){
        return $this->belongsTo(BuyUniform::class,'buyUniform_id','id');
    }
}
