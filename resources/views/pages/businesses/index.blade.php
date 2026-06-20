@extends('layouts.app')

@section('title', 'الأعمال والمحلات | اسأل قلقيلية')
@section('meta_description', 'تصفح الأعمال والمحلات والخدمات في قلقيلية مع البحث، التصفية، الترتيب، ومعلومات التواصل.')
@php $active = 'businesses'; @endphp

@section('content')

<section class="border-b border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
    <nav class="flex flex-wrap items-center gap-2 text-sm font-bold text-slate-500" aria-label="مسار التنقل">
      <a href="{{ route('home') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">الرئيسية</a>
      <span aria-hidden="true">/</span>
      <span class="text-slate-950">الأعمال والمحلات</span>
    </nav>
    <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
      <div>
        <p class="inline-flex w-fit items-center gap-2 rounded-2xl bg-blue-50 px-3 py-1.5 text-sm font-extrabold text-[#2563EB]">
          <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
          دليل الأعمال في قلقيلية
        </p>
        <h1 class="mt-3 text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">تصفح المحلات والخدمات المحلية</h1>
        <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">ابحث، صف، ورتب النتائج للوصول إلى الأعمال المناسبة حسب المنطقة، التصنيف، التقييم، وحالة الدوام.</p>
      </div>
      <a href="{{ route('register') }}" class="inline-flex w-fit items-center justify-center rounded-2xl bg-[#16A34A] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-200">
        أضف نشاطا جديدا
      </a>
    </div>
  </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8" aria-label="بحث الأعمال">
  <form action="{{ route('businesses.index') }}" method="GET" class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm" role="search">
    <div class="grid gap-3 lg:grid-cols-[1fr_220px_180px_auto]">
      <label class="relative block">
        <span class="sr-only">ابحث عن نشاط أو خدمة</span>
        <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-extrabold text-slate-400" aria-hidden="true">بحث</span>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="اسم محل، خدمة، طبيب، مطعم..."
          class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pr-16 pl-4 text-base font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
      </label>
      <label class="relative block">
        <span class="sr-only">التصنيف</span>
        <select name="category" class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-extrabold text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100">
          <option value="">كل التصنيفات</option>
          @foreach($categories ?? [] as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </label>
      <label class="relative block">
        <span class="sr-only">المنطقة</span>
        <select name="area" class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-extrabold text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100">
          <option value="">كل المناطق</option>
          @foreach($areas ?? [] as $area)
            <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
          @endforeach
        </select>
      </label>
      <button type="submit" class="inline-flex h-14 items-center justify-center rounded-2xl bg-[#2563EB] px-7 text-base font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">بحث</button>
    </div>
  </form>
</section>

<section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
  {{-- Mobile filters --}}
  <div class="lg:hidden" aria-label="فلاتر سريعة">
    <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
      <div class="mb-3 flex items-center justify-between gap-3">
        <h2 class="text-sm font-extrabold text-slate-950">تصفية النتائج</h2>
        <a href="{{ route('businesses.index') }}" class="rounded-2xl bg-slate-100 px-3 py-2 text-xs font-extrabold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-100">مسح</a>
      </div>
      <div class="flex gap-2 overflow-x-auto pb-1">
        <a href="{{ route('businesses.index', array_merge(request()->all(), ['open_now' => 1])) }}" class="shrink-0 rounded-2xl {{ request('open_now') ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">مفتوح الآن</a>
        <a href="{{ route('businesses.index', array_merge(request()->all(), ['min_rating' => 4])) }}" class="shrink-0 rounded-2xl {{ request('min_rating') == 4 ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">4+ تقييم</a>
        <a href="{{ route('businesses.index', array_merge(request()->all(), ['verified' => 1])) }}" class="shrink-0 rounded-2xl {{ request('verified') ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">موثق</a>
      </div>
    </div>
  </div>

  <div class="mt-6 grid gap-6 lg:grid-cols-[280px_1fr]">
    {{-- Desktop Sidebar Filters --}}
    <aside class="hidden lg:block">
      <form action="{{ route('businesses.index') }}" method="GET" class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" aria-label="فلاتر الأعمال">
        <div class="flex items-center justify-between gap-3">
          <h2 class="text-lg font-extrabold text-slate-950">الفلاتر</h2>
          <a href="{{ route('businesses.index') }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">مسح الكل</a>
        </div>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">حالة الدوام</legend>
          <div class="mt-3 grid gap-2">
            <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
              <input type="checkbox" name="open_now" value="1" {{ request('open_now') ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> مفتوح الآن
            </label>
            <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
              <input type="checkbox" name="open_24" value="1" {{ request('open_24') ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> يعمل 24 ساعة
            </label>
          </div>
        </fieldset>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">التصنيف</legend>
          <div class="mt-3 grid gap-2">
            @foreach($categories ?? [] as $cat)
              <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id, (array)request('categories')) ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> {{ $cat->name }}
              </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">التقييم</legend>
          <div class="mt-3 grid gap-2">
            <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
              <input type="radio" name="min_rating" value="4.5" {{ request('min_rating') == '4.5' ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> 4.5 فأعلى
            </label>
            <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
              <input type="radio" name="min_rating" value="4.0" {{ request('min_rating') == '4.0' ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> 4.0 فأعلى
            </label>
          </div>
        </fieldset>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">المنطقة</legend>
          <div class="mt-3 grid gap-2">
            @foreach($areas ?? [] as $area)
              <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                <input type="checkbox" name="areas[]" value="{{ $area->id }}" {{ in_array($area->id, (array)request('areas')) ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> {{ $area->name }}
              </label>
            @endforeach
          </div>
        </fieldset>
        <button type="submit" class="mt-6 w-full rounded-2xl bg-[#2563EB] py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تطبيق الفلاتر</button>
      </form>
    </aside>

    {{-- Results --}}
    <div>
      <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div>
            <h2 class="text-lg font-extrabold text-slate-950">{{ $businesses->total() ?? 0 }} نتيجة في قلقيلية</h2>
            <p class="mt-1 text-sm font-bold text-slate-500">تم ترتيب النتائج حسب الأكثر صلة وحالة الدوام.</p>
          </div>
          <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <form method="GET" action="{{ route('businesses.index') }}">
              @foreach(request()->except('sort') as $key => $val)
                <input type="hidden" name="{{ $key }}" value="{{ $val }}" />
              @endforeach
              <label class="flex items-center gap-2 text-sm font-extrabold text-slate-700">
                ترتيب:
                <select name="sort" onchange="this.form.submit()" class="h-11 rounded-2xl border border-slate-200 bg-slate-50 px-3 text-sm font-extrabold text-slate-700 outline-none focus:border-[#2563EB] focus:ring-4 focus:ring-blue-100">
                  <option value="relevant" {{ request('sort','relevant') === 'relevant' ? 'selected' : '' }}>الأكثر صلة</option>
                  <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>الأعلى تقييما</option>
                  <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>الأحدث إضافة</option>
                </select>
              </label>
            </form>
          </div>
        </div>
      </div>

      <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($businesses ?? [] as $business)
          <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
            <div class="relative h-40 overflow-hidden bg-slate-100">
              @if($business->image)
                <img src="{{ asset('storage/'.$business->image) }}" alt="{{ $business->title }}" class="h-full w-full object-cover" />
              @endif
              <div class="absolute inset-0 bg-slate-950/20"></div>
              <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
                <span class="text-2xl font-extrabold text-white">{{ $business->category->name ?? '' }}</span>
                <span class="rounded-full px-3 py-1 text-xs font-extrabold bg-green-50 text-[#16A34A]">مفتوح</span>
              </div>
            </div>
            <div class="p-5">
              <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                  <h3 class="truncate text-lg font-extrabold text-slate-950">{{ $business->title }}</h3>
                  <p class="mt-1 text-sm font-bold text-slate-500">{{ $business->category->name ?? '' }} · {{ $business->area->name ?? '' }}</p>
                </div>
                <span class="shrink-0 rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $business->avg_rating ?? '4.8' }}</span>
              </div>
              <p class="mt-2 text-sm font-bold text-slate-500">{{ $business->reviews_count ?? 0 }} تقييم</p>
              <p class="mt-3 text-sm leading-6 text-slate-600">{{ Str::limit($business->description, 90) }}</p>
              <div class="mt-5 grid grid-cols-2 gap-2">
                <a href="tel:{{ $business->phone }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">اتصال</a>
                <a href="{{ route('businesses.show', $business->slug) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">التفاصيل</a>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-3 py-12 text-center text-slate-500 font-bold">لا توجد نتائج مطابقة.</div>
        @endforelse
      </div>

      @if(isset($businesses) && $businesses->hasPages())
        <nav class="mt-8 flex items-center justify-center gap-2" aria-label="صفحات النتائج">
          {{ $businesses->onEachSide(1)->links('components.pagination') }}
        </nav>
      @endif
    </div>
  </div>
</section>

@endsection
