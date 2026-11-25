<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ ($page->seo_title ?? $page->title ?? null) ? (($page->seo_title ?? $page->title) . ' — ' . ($site['name'] ?? '')) : ($site['name'] ?? '') }}</title>
@if(!empty($page->seo_description ?? null))<meta name="description" content="{{ $page->seo_description }}">@endif
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@500;600;700&family=Alex+Brush&family=Faustina:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inria+Serif:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600;700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Poppins:wght@300;400;500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-[#10221C] antialiased">
@include('partials.header')
<main>@yield('content')</main>
@include('partials.footer')
</body>
</html>
