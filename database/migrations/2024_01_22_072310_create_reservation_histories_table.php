<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_histories', function (Blueprint $table) {
            $table->id();
            $table->string('reservationid');
            $table->string('fullname');
            $table->string('location');
            $table->string('number');
            $table->string('cottagenumber');
            $table->string('paymenttype');
            $table->integer('children');
            $table->integer('adults');
            $table->time('checkin');
            $table->time('checkout');
            $table->string('totalbill');
            $table->string('photopayment')->nullable();
            $table->string('photoid')->nullable();
  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_histories');
    }
};
