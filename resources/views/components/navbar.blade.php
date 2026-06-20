@props(['active' => ''])

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
  <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8" aria-label="التنقل الرئيسي">

    <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="اسأل قلقيلية">
      <span class="flex size-11 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <img src="{{ asset('images/ask-qalqilya-logo.svg') }}" alt="" class="h-full w-full object-contain p-1.5" />
      </span>
      <span>
        <span class="block text-lg font-extrabold leading-5 text-slate-950">اسأل قلقيلية</span>
        <span class="block text-xs font-bold text-slate-500">دليل محلي موثوق</span>
      </span>
    </a>

    <div class="hidden items-center gap-1 lg:flex">
      <a href="{{ route('categories.index') }}"
         class="rounded-2xl px-4 py-2 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'categories' ? 'bg-blue-50 font-extrabold text-[#2563EB]' : 'text-slate-700 hover:bg-slate-100' }}"
         @if($active === 'categories') aria-current="page" @endif>التصنيفات</a>
      <a href="{{ route('businesses.index') }}"
         class="rounded-2xl px-4 py-2 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'businesses' ? 'bg-blue-50 font-extrabold text-[#2563EB]' : 'text-slate-700 hover:bg-slate-100' }}"
         @if($active === 'businesses') aria-current="page" @endif>الأعمال</a>
      <a href="{{ route('jobs.index') }}"
         class="rounded-2xl px-4 py-2 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'jobs' ? 'bg-blue-50 font-extrabold text-[#2563EB]' : 'text-slate-700 hover:bg-slate-100' }}"
         @if($active === 'jobs') aria-current="page" @endif>الوظائف</a>
      <a href="{{ route('search') }}"
         class="rounded-2xl px-4 py-2 text-sm font-bold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'search' ? 'bg-blue-50 font-extrabold text-[#2563EB]' : 'text-slate-700 hover:bg-slate-100' }}"
         @if($active === 'search') aria-current="page" @endif>البحث</a>
    </div>

    <div class="flex items-center gap-2">
      @auth
        <a href="{{ route('dashboard') }}" class="hidden rounded-2xl px-3 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-blue-100 md:inline-flex">لوحتي</a>
      @else
        <a href="{{ route('login') }}" class="hidden rounded-2xl px-3 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-blue-100 md:inline-flex">دخول</a>
        <a href="{{ route('register') }}" class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-extrabold text-slate-800 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100 sm:inline-flex">حساب جديد</a>
      @endauth
      <a href="{{ route('register') }}" class="inline-flex rounded-2xl bg-[#2563EB] px-4 py-2.5 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">
        سجل نشاطك
      </a>
    </div>

  </nav>
</header>
