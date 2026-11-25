<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login — LUX CMS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0E1A14] text-white antialiased min-h-screen flex items-center justify-center px-6">
<div class="w-full max-w-md">
  <div class="text-center">
    <span class="inline-flex w-14 h-14 rounded-full bg-white text-[#10221C] items-center justify-center font-serif font-bold text-xl">LV</span>
    <h1 class="font-serif text-4xl mt-5">LUX Villa Dubai</h1>
    <p class="text-neutral-400 mt-2">CMS Admin — sign in to manage pages, sections and settings.</p>
  </div>
  <form action="{{ route('admin.login.post') }}" method="POST" class="bg-white text-[#10221C] rounded-2xl p-8 mt-8 shadow-2xl">
    @csrf
    @if($errors->any())<div class="bg-red-100 border border-red-300 text-red-800 rounded-lg px-4 py-3 mb-5 text-sm">{{ $errors->first() }}</div>@endif
    <label class="block"><span class="font-semibold">Email</span><input type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="block mt-5"><span class="font-semibold">Password</span><input type="password" name="password" required class="mt-2 w-full border rounded-lg px-3 py-3"></label>
    <label class="flex items-center gap-2 mt-5 text-sm text-neutral-600"><input type="checkbox" name="remember" value="1"> Remember me</label>
    <button class="btn-tan w-full justify-center mt-6">Sign In →</button>
  </form>
  <p class="text-center text-neutral-500 text-sm mt-6"><a href="{{ route('home') }}" class="hover:text-white">← Back to website</a></p>
</div>
</body>
</html>
