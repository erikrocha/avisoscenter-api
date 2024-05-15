<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BCategory extends Model
{
    use HasFactory;
    protected $table = 'bcategories';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'status',
    ];
}
