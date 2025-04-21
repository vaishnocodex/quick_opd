<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 

    protected $fillable = [
        'user_id',
        'hospital_id',
        'order_id',
        'doctor_id',
        'type',
        'booking_date',
        'time_slot',
        'status',
        'total_amount',
        'discount',
        'payment_type',
        'payment_status',
        'appointment_for',
        'pa_name',
        'father_name',
        'gender',
        'age',
        'contact_no',
        'email',
    ];
}
