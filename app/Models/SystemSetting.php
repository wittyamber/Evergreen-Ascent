<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /**
     * A static helper to get a setting value by key.
     * Usage: SystemSetting::get('site_name', 'Default Name')
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * A static helper to set a value.
     */
    public static function set($key, $value, $group = 'general')
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }
}
