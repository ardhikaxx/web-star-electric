<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Seeder;

class AdminSettingSeeder extends Seeder
{
    public function run(): void
    {
        AdminSetting::updateOrCreate(
            ['key' => 'admin_pin'],
            ['value' => '2222']
        );
    }
}