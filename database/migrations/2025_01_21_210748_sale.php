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
            $table->foreignId('Id_User')->constrained('users');
            $table->foreignId('Id_Client')->constrained('Client');
            $table->foreignId('Id_Company')->constrained('Company')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('Item_Sale', function (Blueprint $table) {
            $table->id();
            $table->string('Name_Item_Sale');
            $table->unsignedInteger('Amount_Item');
            $table->decimal('Unit_Value',8,2);
            $table->foreignId('Id_Product')->constrained('Product');
            $table->foreignId('Id_Sale')->constrained('Sale');
            $table->timestamps();
        });
        Schema::create('Nfce', function (Blueprint $table) {
            $table->id();
            $table->string('num')->unique();
            $table->string('serie');
            $table->string('Passkey')->unique();
            $table->text('xml');
            $table->string('pdf_danfe')->nullable();
            $table->enum('status', ['Autorizada', 'Cancelada', 'Rejeitada']);
            $table->timestamp('date');
            $table->foreignId('Id_Sale')->constrained('Sale');
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
