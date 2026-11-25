<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public const FIELDS = [
        'site_name', 'site_tagline', 'logo_text', 'logo_sub',
        'header_button_text', 'header_button_link',
        'footer_about', 'footer_disclaimer', 'footer_copyright',
        'contact_phone', 'contact_whatsapp_label', 'contact_city',
        'social_facebook', 'social_instagram', 'social_linkedin',
    ];

    public function edit()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'logo_text' => ['nullable', 'string', 'max:255'],
            'logo_sub' => ['nullable', 'string', 'max:255'],
            'header_button_text' => ['nullable', 'string', 'max:255'],
            'header_button_link' => ['nullable', 'string', 'max:255'],
            'footer_about' => ['nullable', 'string'],
            'footer_disclaimer' => ['nullable', 'string'],
            'footer_copyright' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:255'],
            'contact_whatsapp_label' => ['nullable', 'string', 'max:255'],
            'contact_city' => ['nullable', 'string', 'max:255'],
            'social_facebook' => ['nullable', 'string', 'max:255'],
            'social_instagram' => ['nullable', 'string', 'max:255'],
            'social_linkedin' => ['nullable', 'string', 'max:255'],
            'nav_items' => ['nullable', 'string'],
            'footer_explore' => ['nullable', 'string'],
        ]);
        foreach (self::FIELDS as $field) {
            Setting::set($field, $data[$field] ?? '');
        }
        foreach (['nav_items', 'footer_explore'] as $jsonField) {
            $raw = trim($data[$jsonField] ?? '');
            if ($raw === '') continue;
            $decoded = json_decode($raw, true);
            if (! is_array($decoded)) {
                return back()->withErrors([$jsonField => 'Not valid JSON.'])->withInput();
            }
            Setting::set($jsonField, json_encode($decoded));
        }
        return back()->with('ok', 'Settings saved — header, footer and contact details updated everywhere.');
    }
}
