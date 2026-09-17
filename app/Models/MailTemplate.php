<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MailTemplate extends Model
{
    protected $fillable = ['key', 'name', 'subject', 'body', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn (self $template) => Cache::forget("mail_template_{$template->key}"));
        static::deleted(fn (self $template) => Cache::forget("mail_template_{$template->key}"));
    }

    public static function findByKey(string $key): ?self
    {
        return Cache::remember("mail_template_{$key}", 3600, function () use ($key) {
            return static::where('key', $key)->first();
        });
    }

    /**
     * Render a template's subject and body with placeholders replaced.
     * Returns null if the template does not exist or is inactive.
     */
    public static function render(string $key, array $data): ?array
    {
        $template = static::findByKey($key);

        if (!$template || !$template->is_active) {
            return null;
        }

        return [
            'subject' => static::replacePlaceholders($template->subject, $data),
            'body'    => static::replacePlaceholders($template->body, $data),
        ];
    }

    protected static function replacePlaceholders(string $text, array $data): string
    {
        $replacements = [];
        foreach ($data as $key => $value) {
            $replacements['{{' . $key . '}}'] = (string) $value;
        }

        return strtr($text, $replacements);
    }
}
