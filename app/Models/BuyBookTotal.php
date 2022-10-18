<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyBookTotal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'buyPrice',
        'sellPrice',
        'buyBook_id',
        'year_id',
        'delete_at',
        'subTotal'

    ];
    public function buyBooks(){
        return $this->belongsTo(BuyBook::class , 'buyBook_id' , 'id');
    }
    public function years()
    {
        return $this->belongsTo(EducationalYear::class, 'year_id', 'id');
    }
}
