<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'ad_categories', 'category_id', 'ad_id');
    }
}
