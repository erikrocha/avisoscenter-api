<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    //public $timestamps = false;

    protected $fillable = [
        'body',
        'address',
        'price',
        'latitude',
        'longitude',
        'condition',
        'type_id',
        'isIA',
        'bath',
        'pets',
        'wifi',
        'cable',
        'parking_moto',
        'parking_car',
        'thermal',
        'laundry',
        'silent',
        'cook',
        'status',
        'created_at',
        'updated_at'
    ];
}
