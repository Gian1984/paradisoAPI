<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'startdate',
        'finishdate',
        'starttime',
        'finishtime',
        'slot_id',
        'fullday',
        'guests',
        'amount',
        'product_id',
        'transactionID',
        'cardBrand',
        'lastFour',
        'expire',
        'language'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function slot()
    {
        return $this->belongsTo(Timeslots::class, 'slot_id');
    }
    public function extras()
    {
        return $this->hasMany(Extra::class);
    }
}
