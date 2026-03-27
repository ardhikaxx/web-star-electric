<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('click_count')->default(0)->after('is_active');
            $table->unsignedBigInteger('unique_click_count')->default(0)->after('click_count');
            $table->unsignedBigInteger('interest_click_count')->default(0)->after('unique_click_count');
            $table->timestamp('last_clicked_at')->nullable()->after('interest_click_count');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'click_count',
                'unique_click_count',
                'interest_click_count',
                'last_clicked_at',
            ]);
        });
    }
};
