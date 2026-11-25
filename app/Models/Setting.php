<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /** Get a setting value from the DB (empty string when missing — no hardcoded copy). */
    public static function get(string $key, string $default = ''): string
    {
        return (string) (static::query()->where('key', $key)->value('value') ?? $default);
    }

    /** Get a setting decoded as an array (nav links, footer links). */
    public static function getArray(string $key): array
    {
        $raw = static::get($key);
        $decoded = $raw !== '' ? json_decode($raw, true) : null;
        return is_array($decoded) ? $decoded : [];
    }

    public static function set(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value ?? '', 'group' => $group]);
        Cache::forget('settings.'.$key);
    }
}
