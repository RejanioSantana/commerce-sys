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
        Schema::create('Sale', function (Blueprint $table) {
            $table->id();
            $table->string('Discount_Sale');
            $table->date('Date_Sale');
            $table->foreignId('Id_User')->constrained('User');
            $table->foreignId('Id_Client')->constrained('Client');
            $table->timestamps();
        });
        Schema::create('Item_Sale', function (Blueprint $table) {
            $table->id();
            $table->string('Discount_Sale');
            $table->date('Date_Sale');
           $table->foreignId('Id_Client')->constrained('Client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Sale');
        Schema::dropIfExists('Item_Sale');
    }
};