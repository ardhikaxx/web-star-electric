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
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            $table->morphs('stockable'); // can be Product or SalesProduct
            $table->integer('change'); // e.g., +10, -1
            $table->integer('before_stock');
            $table->integer('after_stock');
            $table->string('type'); // restock, sale, correction, etc.
            $table->string('reference_type')->nullable(); // DailyReportProductSale, SalesProduct, etc.
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // who made the change
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
