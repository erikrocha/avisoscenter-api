<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionTCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'transaction_tcategories';

    protected $fillable = [
        'transaction_id',
        'tcategory_id'
    ];
}
