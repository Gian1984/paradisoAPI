<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'price', 'description', 'image','language'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
