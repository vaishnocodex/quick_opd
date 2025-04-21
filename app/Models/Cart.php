<?php

// Cart.php (Model)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
 
    protected $table = 'cart';  
    protected $fillable = [
        'user_id',
        'session_id',
        'p_name',
        'hospital_id',
        'doctor_id',
        'booking_date',
        'booking_shift',
        'qty',
        'price',
        'gst',
        'total',
        'type',
        'created_at',
        'updated_at'
    ];
}

