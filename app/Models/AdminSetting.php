<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $table = 'admin_settings';
    
    protected $fillable = ['key', 'value'];

    public static function getPin()
    {
        $setting = self::where('key', 'admin_pin')->first();
        return $setting ? $setting->value : '1234';
    }

    public static function setPin($pin)
    {
        return self::updateOrCreate(
            ['key' => 'admin_pin'],
            ['value' => $pin]
        );
    }

    public static function checkRecoveryKey($key)
    {
        $setting = self::where('key', 'admin_pin')->first();
        return $setting && $setting->recovery_key === $key;
    }
}