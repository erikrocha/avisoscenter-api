<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TCategory extends Model
{
    use HasFactory;
    protected $table = 'tcategories';
    public $timestamps = false;
    
    protected $fillable = [
        'tc_name'
    ];
}
