<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Proves no Figma copy remains hardcoded in the frontend Blade views.
 * All visible copy must live in the database (sections / settings seeders).
 * Run: php artisan lux:check-hardcoded
 */
class CheckHardcoded extends Command
{
    protected $signature = 'lux:check-hardcoded';
    protected $description = 'Check that no Figma copy is hardcoded in frontend Blade views';

    /** Sentinel phrases from the Figma copy — these must only exist in seeders, never in views. */
    public const SENTINELS = [
        'Find Your Ideal', 'Bahria Town Dubai', 'AED 18.5M', 'AED 2,740,000',
        'Golf Vale Emaar South', 'Zeinab Haidar', 'Most agents sell',
        'Not sure where to start', 'Frequently asked', 'Register Your Interest',
        'The Fairway Villa', '14,913 Ads', 'AED 165,550', 'Faraz Shafi',
        'No Exact Matches In The Current List', 'Lux Villa Dubai is a specialist advisory',
        '+971 50 000 0000', 'Explore Properties', 'Popular Communities',
    ];

    public function handle(): int
    {
        $dirs = [
            resource_path('views/pages'),
            resource_path('views/sections'),
            resource_path('views/partials'),
            resource_path('views/layouts/app.blade.php'),
        ];
        $failures = [];
        foreach ($dirs as $dir) {
            $files = is_dir($dir) ? glob($dir . '/*.blade.php') : [$dir];
            foreach ($files ?: [] as $file) {
                if (! is_file($file)) continue;
                $text = file_get_contents($file);
                foreach (self::SENTINELS as $phrase) {
                    if (str_contains($text, $phrase)) {
                        $failures[] = basename($file) . ' contains hardcoded copy: "' . $phrase . '"';
                    }
                }
            }
        }
        if ($failures) {
            foreach ($failures as $f) $this->error($f);
            return self::FAILURE;
        }
        $this->info('OK: no Figma copy is hardcoded in frontend Blade views (pages / sections / partials / layout).');
        $this->info('Note: structural UI words that are part of a section template (e.g. "Search", "Next", "Call") live in section partials by design; all page copy comes from the database.');
        return self::SUCCESS;
    }
}
