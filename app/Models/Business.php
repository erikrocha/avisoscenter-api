<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'bcategory_id',
        'name',
        'description',
        'address',
        'image',
        'web',
        'email',
        'phone',
        'whatsapp',
        'facebook',
        'tiktok',
        'status',
        'created_at',
        'updated_at',
    ];
}
