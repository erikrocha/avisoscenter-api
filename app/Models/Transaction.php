<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'type',
        'created_at',
        'updated_at'
    ];

    public function tcategories()
    {
        return $this->belongsToMany(TCategory::class, 'transaction_tcategories', 'transaction_id', 'tcategory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
