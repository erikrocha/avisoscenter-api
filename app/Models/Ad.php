<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'address',
        'price',
        'latitude',
        'longitude',
        'condition',
        'type',
        'bath',
        'pets',
        'wifi',
        'cable',
        'parking_moto',
        'parking_car',
        'thermal',
        'laundry',
        'silent',
        'status'
    ];
}
