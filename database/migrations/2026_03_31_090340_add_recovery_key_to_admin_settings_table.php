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
        Schema::table('admin_settings', function (Blueprint $table) {
            $table->string('recovery_key')->nullable()->after('value');
        });

        DB::table('admin_settings')
            ->where('key', 'admin_pin')
            ->update(['recovery_key' => 'ARRAHMAN2026']);
    }

    public function down(): void
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            $table->dropColumn('recovery_key');
        });
    }
};
