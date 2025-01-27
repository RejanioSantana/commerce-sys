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

        Schema::create("Company", function (Blueprint $table) {
            $table->id();
            $table->string('Name_Company');
            $table->string('Cnpj_Company');
            $table->bigInteger('Phone_Company');
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Email')->unique();
            $table->unsignedInteger('User_Code')->unique();
            $table->string('password');
            $table->boolean('Status');
            $table->foreignId('Id_Company')->constrained('Company')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('Type_Access', function (Blueprint $table) { 
            $table->id();
            $table->string('Name_Type_Access');
        });
        Schema::create('Type_User', function (Blueprint $table) {
            $table->unsignedBigInteger('Id_User');
            $table->unsignedBigInteger('Id_Type_Access');
        
            // Define uma chave primária composta
            $table->primary(['Id_User', 'Id_Type_Access']);
        
            // Define as chaves estrangeiras
            $table->foreign('Id_User')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Id_Type_Access')->references('id')->on('Type_Access')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Company');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('Type_Access');
        Schema::dropIfExists('Type_User');
    }
};