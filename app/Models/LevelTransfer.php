<?php

namespace App\Models;

use App\Models\User;
use App\Models\Leavel;
use App\Models\AddChild;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'user_id',
        'child_id',
        'levelFrom_id',
        'levelTo_id',
        'delete_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function children()
    {
        return $this->belongsTo(AddChild::class, 'child_id', 'id');
    }

    public function levels_from()
    {
        return $this->belongsTo(Leavel::class, 'levelFrom_id', 'id');
    }

    public function levels_to()
    {
        return $this->belongsTo(Leavel::class, 'levelTo_id', 'id');
    }
}
