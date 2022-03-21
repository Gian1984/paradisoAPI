<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeslots extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'start','end', 'price','value','available'
    ];

    public function timeslots(){
        return $this->hasMany(Reservation::class);
    }
}
