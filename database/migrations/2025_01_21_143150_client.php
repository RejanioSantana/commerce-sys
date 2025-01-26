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
        Schema::create('Client', function (Blueprint $table) {
            $table->id();
            $table->string('First_Name',11);
            $table->string('Last_Name',40);
            $table->string('Cpf_Client',11)->unique();
            $table->string('Email_Client',60)->nullable();
            $table->integer('Whatsapp_Client');
            $table->boolean('Status_Client');
            $table->timestamps();
        });
        Schema::create('Client_Address', function (Blueprint $table) {
            $table->id();
            $table->string('Name_Street',);
            $table->string('Number_Street',4);
            $table->string('Complement_Street',255);
            $table->integer('Zip_Code');
            $table->foreignId('Id_Client')->constrained('Client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Client');
        Schema::dropIfExists('Client_Address');
    }
};
