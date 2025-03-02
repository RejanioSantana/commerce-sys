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
        Schema::create("Unit_Type", function (Blueprint $table) {
            $table->id();
            $table->string("Name_Unit_Type",20);
            $table->string("Short_Name",3);
        });
        Schema::create("Product_Category", function (Blueprint $table) {
            $table->id();
            $table->string("Name_Product_Category",20);
        });
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->string('Cod_Product');
            $table->unsignedBigInteger('Ncm');
            $table->string('Name_Product');
            $table->unsignedInteger('Amount_Product');
            $table->unsignedInteger('Min_Amount');
            $table->decimal('Purchase_Value',8,2);
            $table->decimal('Sale_Value',8,2);
            $table->string('Note_Product')->nullable();
            $table->foreignId('Id_Unit_Type')->nullable()->constrained('Unit_Type');
            $table->foreignId('Id_Product_Category')->nullable()->constrained('Product_Category');
            $table->foreignId('Id_Company')->constrained('Company')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('Return_Product', function (Blueprint $table) {
            $table->id();
            $table->date('Date_Return_Product');
            $table->decimal('Value_Return_Product',8,2);
            $table->foreignId('Id_Client')->constrained('Client');
            $table->foreignId('Id_Cash_Book')->constrained('Cash_Book');
            $table->foreignId('Cod_Product')->constrained('Product');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Product');
        Schema::dropIfExists('Unit_Type');
        Schema::dropIfExists('Product_Category');
        Schema::dropIfExists('Return_Product');
    }
};
