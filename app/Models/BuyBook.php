<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'supplier',
        'note',
        'totalBuyPrice',
        'totalSellPrice',
        'year_id',
        'delete_at',
        'treasury_id'
    ];
    public function years()
    {
        return $this->belongsTo(EducationalYear::class, 'year_id', 'id');
    }
}
