<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'phone_id'
    ];
}
