<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->string('phone_number')->nullable()->after('username');
            $table->string('pin')->nullable()->after('phone_number');
            $table->string('role')->default('employee')->after('pin');
            $table->boolean('is_active')->default(true)->after('role');
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->timestamp('email_verified_at')->nullable()->change();
            $table->unique('username');
            $table->unique('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropUnique(['phone_number']);
            $table->dropColumn(['username', 'phone_number', 'pin', 'role', 'is_active']);
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
        });
    }
};
