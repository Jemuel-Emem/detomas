<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservationid',
        'fullname',
        'location',
        'number',
        'cottagenumber',
        'paymenttype',
        'children',
        'adults',
        'checkin',
        'checkout',
        'totalbill',
        'photopayment',
        'photoid',
    ];
}
