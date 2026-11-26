<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ ($page->seo_title ?? $page->title ?? null) ? (($page->seo_title ?? $page->title) . ' — ' . ($site['name'] ?? '')) : ($site['name'] ?? '') }}</title>
@if(!empty($page->seo_description ?? null))<meta name="description" content="{{ $page->seo_description }}">@endif
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre:wght@500;600;700&family=Alex+Brush&family=Faustina:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inria+Serif:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600;700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  .lux-rich-content h1, .rich-quiz-content h1 { font-family: 'Abhaya Libre', Georgia, serif; font-size: 38px; font-weight: 600; line-height: 1.2; color: #0E3B2C; margin: 18px 0 12px; }
  .lux-rich-content h2, .rich-quiz-content h2 { font-family: 'Abhaya Libre', Georgia, serif; font-size: 30px; font-weight: 600; line-height: 1.25; color: #C5A47E; margin: 16px 0 10px; }
  .lux-rich-content h3, .rich-quiz-content h3 { font-family: 'Abhaya Libre', Georgia, serif; font-size: 24px; font-weight: 600; line-height: 1.3; color: #C5A47E; margin: 14px 0 8px; }
  .lux-rich-content h4, .rich-quiz-content h4 { font-size: 19px; font-weight: 600; line-height: 1.35; color: #10221C; margin: 12px 0 6px; }
  .lux-rich-content p, .rich-quiz-content p { font-size: 16px; font-weight: 400; line-height: 1.75; color: #4A5550; margin-bottom: 14px; }
  .lux-rich-content ul, .rich-quiz-content ul { list-style-type: disc; padding-left: 22px; margin: 12px 0 16px; color: #4A5550; }
  .lux-rich-content ol, .rich-quiz-content ol { list-style-type: decimal; padding-left: 22px; margin: 12px 0 16px; color: #4A5550; }
  .lux-rich-content li, .rich-quiz-content li { margin-bottom: 6px; line-height: 1.65; }
  .lux-rich-content-inner h1, .lux-rich-content-inner h2, .lux-rich-content-inner h3, .lux-rich-content-inner h4, .lux-rich-content-inner h5, .lux-rich-content-inner h6 { color: #0E3B2C !important; }
  .lux-rich-content-inner p, .lux-rich-content-inner li, .lux-rich-content-inner ul, .lux-rich-content-inner ol { color: #000000 !important; }
</style>
</head>
<body class="bg-white text-[#10221C] antialiased">
@include('partials.header')
<main>@yield('content')</main>
@include('partials.footer')
</body>
</html>
