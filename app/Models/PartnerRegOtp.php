<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerRegOtp extends Model
{
    use HasFactory;

    protected $table = 'partner_reg_otp';

    protected $fillable = [
        'user_id',
        'mobile_no',
        'mobile_otp',
        'email_id',
        'email_otp',
        'expire_at',
    ];

    public $timestamps = true;
}
