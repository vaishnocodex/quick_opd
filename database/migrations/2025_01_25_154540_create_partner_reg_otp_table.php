<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerRegOtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('partner_reg_otp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // User ID field without foreign key constraint
            $table->string('mobile_no');
            $table->string('mobile_otp');
            $table->string('email_id');
            $table->string('email_otp');
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_reg_otp');
    }
}
