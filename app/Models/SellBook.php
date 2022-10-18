<?php

namespace App\Models;

use App\Models\Leavel;
use App\Models\AddChild;
use App\Models\BuyBookTotal;
use App\Models\EducationalYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'level_id',
        'child_id',
        'note',
        'total',
        'subTotal',
        'book_id',
        'amount',
        'price',
        'year_id',
        'treasury_id',
        'delete_at',
    ];

    public function levels()
    {
        return $this->belongsTo(Leavel::class, 'level_id', 'id');
    }

    public function childs()
    {
        return $this->belongsTo(AddChild::class, 'child_id', 'id');
    }

    public function books()
    {
        return $this->belongsTo(BuyBookTotal::class, 'book_id', 'id');
    }

    public function years()
    {
        return $this->belongsTo(EducationalYear::class, 'year_id', 'id');
    }
}
