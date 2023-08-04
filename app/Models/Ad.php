<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    //public $timestamps = false;

    protected $fillable = [
        'city_id',
        'brand_id',
        'model_id',
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
        'currency',
        'year',
        'mileage',
        'engine',
        'fuel',
        'transmission',
        'color',
        'created_at',
        'updated_at'
    ];
}
