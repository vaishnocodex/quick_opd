<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
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




       // Custom query to fetch orders with hospital and doctor information
       public static function getOrdersWithUsers($userId)
       {
           return DB::table('orders')
               ->leftJoin('users as hospital', 'orders.hospital_id', '=', 'hospital.id')
               ->leftJoin('users as doctor', 'orders.doctor_id', '=', 'doctor.id')
               ->where('orders.user_id', $userId)
               ->select(
                   'orders.*',
                   'hospital.name as hospital_name',
                   'hospital.email as hospital_email',
                   'doctor.name as doctor_name',
                   'doctor.email as doctor_email'
               )
               ->get();
       }

}
