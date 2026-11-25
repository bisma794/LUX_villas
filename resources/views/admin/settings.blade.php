@extends('layouts.admin')
@section('content')
<h1 class="font-serif text-4xl">Settings</h1>
<p class="text-neutral-600 mt-2">Header, footer and contact details for the whole site. Everything here is stored in the database — nothing is hardcoded in the templates.</p>
<form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white rounded-2xl border p-6 mt-6">
  @csrf @method('PUT')
  <div class="grid md:grid-cols-2 gap-5">
    <label class="block"><span class="font-semibold">Site name</span><input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Site tagline</span><input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Logo text</span><input type="text" name="logo_text" value="{{ old('logo_text', $settings['logo_text'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Logo sub-text</span><input type="text" name="logo_sub" value="{{ old('logo_sub', $settings['logo_sub'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Header button text</span><input type="text" name="header_button_text" value="{{ old('header_button_text', $settings['header_button_text'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Header button link</span><input type="text" name="header_button_link" value="{{ old('header_button_link', $settings['header_button_link'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Contact phone</span><input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">WhatsApp label</span><input type="text" name="contact_whatsapp_label" value="{{ old('contact_whatsapp_label', $settings['contact_whatsapp_label'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">City / address</span><input type="text" name="contact_city" value="{{ old('contact_city', $settings['contact_city'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Facebook URL</span><input type="text" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">Instagram URL</span><input type="text" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block"><span class="font-semibold">LinkedIn URL</span><input type="text" name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block md:col-span-2"><span class="font-semibold">Footer about text</span><textarea name="footer_about" rows="3" class="mt-2 w-full border rounded-lg px-3 py-3">{{ old('footer_about', $settings['footer_about'] ?? '') }}</textarea></label>
    <label class="block md:col-span-2"><span class="font-semibold">Footer disclaimer</span><textarea name="footer_disclaimer" rows="3" class="mt-2 w-full border rounded-lg px-3 py-3">{{ old('footer_disclaimer', $settings['footer_disclaimer'] ?? '') }}</textarea></label>
    <label class="block md:col-span-2"><span class="font-semibold">Footer copyright line</span><input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright'] ?? '') }}" class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block md:col-span-2"><span class="font-semibold">Header nav items (JSON — list of {"label","url"})</span><textarea name="nav_items" rows="6" spellcheck="false" class="mt-2 w-full border rounded-lg px-3 py-3 font-mono text-sm">{{ old('nav_items', $settings['nav_items'] ?? '') }}</textarea></label>
    <label class="block md:col-span-2"><span class="font-semibold">Footer Explore links (JSON — list of {"label","url"})</span><textarea name="footer_explore" rows="6" spellcheck="false" class="mt-2 w-full border rounded-lg px-3 py-3 font-mono text-sm">{{ old('footer_explore', $settings['footer_explore'] ?? '') }}</textarea></label>
  </div>
  <button class="btn-tan mt-6">Save Settings</button>
</form>
@endsection
