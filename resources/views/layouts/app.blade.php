<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="@yield('meta_description', 'اسأل قلقيلية منصة محلية للبحث عن المحلات والخدمات والوظائف في قلقيلية.')" />
  <title>@yield('title', 'اسأل قلقيلية | دليل الأعمال والوظائف')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-[#F8FAFC] pb-28 text-slate-900 antialiased [font-family:Tajawal,Inter,sans-serif] lg:pb-0">

  {{-- Navbar --}}
  <x-navbar :active="$active ?? ''" />

  {{-- Main Content --}}
  <main>
    @yield('content')
  </main>

  {{-- Mobile Bottom Nav --}}
  <x-mobile-nav :active="$active ?? ''" />

  {{-- Footer --}}
  <x-footer />

</body>
</html>
