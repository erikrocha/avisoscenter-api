<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'url'
    ];

    public function ads()
    {
        return $this->belongsToMany(Post::class, 'ad_images', 'image_id', 'ad_id');
    }
}
