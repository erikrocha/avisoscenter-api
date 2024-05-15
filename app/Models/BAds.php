<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BAds extends Model
{
    use HasFactory;
    protected $table = 'bads';

    protected $fillable = [
        'business_id',
        'image',
        'status',
        'expired_at',
        'created_at',
        'updated_at'
    ];
}
