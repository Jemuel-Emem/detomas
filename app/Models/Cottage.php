<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cottage extends Model
{
    use HasFactory;
    protected $fillable = [
        'cottagecode',
        'description',
        'price',
        'cottagephoto',
        'cottagenumber',
        'status',
    ];
}
