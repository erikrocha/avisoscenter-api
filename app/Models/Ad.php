<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Modelo;
use App\Models\City;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Type;

class Ad extends Modelo
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
        'notes',
        'currency',
        'year',
        'mileage',
        'engine',
        'fuel',
        'transmission',
        'color',
        'created_at',
        'updated_at',
        'expired_at'
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ad_categories', 'ad_id', 'category_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'ad_images', 'ad_id', 'image_id');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class, 'ad_phones', 'ad_id', 'phone_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ad_id');
    }

}
