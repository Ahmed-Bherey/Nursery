<?php

namespace App\Models;

use App\Models\BuyBookTotal;
use App\Models\EducationalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuyUniform extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_id',
        'buyUniformTotal_id',
        'name',
        'quantity',
        'buy_price',
        'sale_price',
        'subTotal',
        'delete_at',
    ];

    public function buyBooks(){
        return $this->belongsTo(BuyBook::class , 'buyBook_id' , 'id');
    }

    public function years()
    {
        return $this->belongsTo(EducationalYear::class, 'year_id', 'id');
    }
}
