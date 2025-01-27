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
        Schema::create('Cash', function (Blueprint $table) {
            $table->id();
            $table->decimal('Balance_Before',8,2);
            $table->date('Cash_Date');
            $table->timestamps();
        });
        Schema::create('Cash_Book', function (Blueprint $table) {
            $table->id();
            $table->date('Date_Cash_Book');
            $table->string('Note_Cash_Book');
            $table->boolean('Type_Cash_Book');
            $table->decimal('Value_Cash_Book',8,2);
            $table->foreignId('Id_User')->constrained('users');
            $table->foreignId('Id_Cash')->constrained('Cash')->onDelete('cascade');
            $table->foreignId('Id_Client')->constrained('Client');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Cash');
        Schema::dropIfExists('Cash_Book');
    }
};
