<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'price', 'weekendinflation', 'specialdayinflation', 'groupdiscount',
    ];

    public function orders(){
        return $this->hasMany(Reservation::class);
    }
}
