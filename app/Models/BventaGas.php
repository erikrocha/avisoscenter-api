<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BventaGas extends Model
{
  use HasFactory;
  protected $table = 'bventa_gas';
  public $timestamps = false;
  protected $fillable = [
    'key', 
    'user_name', 
    'user_phone', 
    'user_whatsapp', 
    'is_used', 
    'machine_id', 
    'license_type', 
    'referral_source', 
    'is_fully_paid', 
    'activated_at', 
    'expires_at'
  ];
}
