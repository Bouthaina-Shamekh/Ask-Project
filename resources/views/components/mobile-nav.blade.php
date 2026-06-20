@props(['active' => ''])

<nav class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white/95 px-2 py-2 backdrop-blur lg:hidden" aria-label="تنقل الجوال">
  <div class="mx-auto grid max-w-md grid-cols-5 gap-1">
    <a href="{{ route('home') }}"
       class="rounded-2xl px-2 py-2 text-center text-xs font-extrabold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'home' ? 'text-[#2563EB]' : 'text-slate-600' }}">الرئيسية</a>
    <a href="{{ route('businesses.index') }}"
       class="rounded-2xl px-2 py-2 text-center text-xs font-extrabold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'businesses' ? 'text-[#2563EB]' : 'text-slate-600' }}"
       @if($active === 'businesses') aria-current="page" @endif>الأعمال</a>
    <a href="{{ route('search') }}"
       class="rounded-2xl px-2 py-2 text-center text-xs font-extrabold focus:outline-none focus:ring-4 focus:ring-blue-200 {{ $active === 'search' ? 'bg-[#2563EB] text-white' : 'bg-[#2563EB] text-white' }}">بحث</a>
    <a href="{{ route('jobs.index') }}"
       class="rounded-2xl px-2 py-2 text-center text-xs font-extrabold focus:outline-none focus:ring-4 focus:ring-blue-100 {{ $active === 'jobs' ? 'text-[#2563EB]' : 'text-slate-600' }}"
       @if($active === 'jobs') aria-current="page" @endif>الوظائف</a>
    <a href="{{ route('login') }}"
       class="rounded-2xl px-2 py-2 text-center text-xs font-extrabold focus:outline-none focus:ring-4 focus:ring-blue-100 text-slate-600">حسابي</a>
  </div>
</nav>
