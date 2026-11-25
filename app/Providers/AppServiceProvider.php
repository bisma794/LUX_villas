<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share DB-driven site settings (header nav, footer, contact) with the layout.
        // Guarded so artisan commands run before the settings table exists.
        View::composer(['layouts.app', 'partials.header', 'partials.footer'], function ($view) {
            if (! Schema::hasTable('settings')) {
                $view->with('site', ['nav_items' => [], 'footer_explore' => []]);
                return;
            }
            $rows = Setting::pluck('value', 'key')->all();
            $view->with('site', [
                'name' => $rows['site_name'] ?? '',
                'logo_text' => $rows['logo_text'] ?? '',
                'logo_sub' => $rows['logo_sub'] ?? '',
                'header_button_text' => $rows['header_button_text'] ?? '',
                'header_button_link' => $rows['header_button_link'] ?? '/enquiry',
                'footer_about' => $rows['footer_about'] ?? '',
                'footer_disclaimer' => $rows['footer_disclaimer'] ?? '',
                'footer_copyright' => $rows['footer_copyright'] ?? '',
                'contact_phone' => $rows['contact_phone'] ?? '',
                'contact_whatsapp_label' => $rows['contact_whatsapp_label'] ?? '',
                'contact_city' => $rows['contact_city'] ?? '',
                'social_facebook' => $rows['social_facebook'] ?? '#',
                'social_instagram' => $rows['social_instagram'] ?? '#',
                'social_linkedin' => $rows['social_linkedin'] ?? '#',
                'nav_items' => json_decode($rows['nav_items'] ?? '[]', true) ?: [],
                'footer_explore' => json_decode($rows['footer_explore'] ?? '[]', true) ?: [],
            ]);
        });
    }
}
