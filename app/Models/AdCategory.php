<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'category_id'
    ];

    public function phones()
    {
        return $this->belongsToMany(Phone::class, 'ad_phones', 'ad_id', 'phone_id');
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'id');
    }
}
