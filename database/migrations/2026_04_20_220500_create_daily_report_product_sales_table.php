<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_report_product_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sales_product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('row_key')->nullable();
            $table->string('product_name');
            $table->string('product_type')->nullable();
            $table->string('color')->nullable();
            $table->enum('payment_type', ['dp', 'lunas']);
            $table->decimal('price', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_report_product_sales');
    }
};
