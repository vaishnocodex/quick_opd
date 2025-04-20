<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction'; 

    protected $fillable = [
        'hospital_id',
        'user_id',
        'order_id',
        'debit',
        'credit',
        'amount',
        'gst',
        'type',
        'remark',
        'date',
        'status',
    ];
}
