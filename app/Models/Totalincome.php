<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totalincome extends Model
{
    use HasFactory;
    protected $fillable = [
        'income',
    ];
}
