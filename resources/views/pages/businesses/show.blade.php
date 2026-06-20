@extends('layouts.app')

@section('title', ($business->title ?? 'نشاط تجاري') . ' | اسأل قلقيلية')
@section('meta_description', Str::limit($business->description ?? '', 150))
@php $active = 'businesses'; @endphp

@section('content')

{{-- Breadcrumb --}}
<section class="border-b border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
    <nav class="flex flex-wrap items-center gap-2 text-sm font-bold text-slate-500" aria-label="مسار التنقل">
      <a href="{{ route('home') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">الرئيسية</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('businesses.index') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">الأعمال</a>
      <span aria-hidden="true">/</span>
      <span class="text-slate-950">{{ $business->title ?? 'النشاط' }}</span>
    </nav>
  </div>
</section>

{{-- Hero / Header --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-4 pb-8 pt-4 sm:px-6 lg:px-8">
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
      <div class="relative h-64 overflow-hidden bg-blue-50 sm:h-80 lg:h-96">
        @if($business->image ?? false)
          <img src="{{ asset('storage/'.$business->image) }}" alt="{{ $business->title }}" class="absolute inset-0 h-full w-full object-cover" />
        @else
          <img src="{{ asset('images/businesses/restaurant-interior.jpg') }}" alt="{{ $business->title ?? 'النشاط' }}" class="absolute inset-0 h-full w-full object-cover" />
        @endif
        <div class="absolute inset-0 bg-slate-950/25"></div>
        <div class="relative flex h-full items-end justify-between p-5">
          <div>
            <p class="text-sm font-extrabold text-blue-100">{{ $business->category->name ?? 'تصنيف' }}</p>
            <p class="mt-1 text-3xl font-extrabold text-white">{{ $business->title ?? '' }}</p>
          </div>
          @if(isset($business->images) && $business->images->count())
            <span class="hidden rounded-2xl bg-white px-4 py-2 text-sm font-extrabold text-slate-700 shadow-sm sm:inline-flex">{{ $business->images->count() }} صور</span>
          @endif
        </div>
      </div>

      <div class="p-5 sm:p-6">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
          <div class="flex gap-4">
            <div class="-mt-14 flex size-24 shrink-0 items-center justify-center overflow-hidden rounded-2xl border-4 border-white bg-white shadow-md sm:size-28">
              <img src="{{ asset('images/businesses/restaurant-food.jpg') }}" alt="شعار {{ $business->title ?? '' }}" class="h-full w-full object-cover" />
            </div>
            <div class="min-w-0">
              <div class="flex flex-wrap items-center gap-2">
                <h1 class="text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">{{ $business->title ?? '' }}</h1>
                <span class="rounded-2xl bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">موثق</span>
              </div>
              <p class="mt-2 text-sm font-extrabold text-slate-500">{{ $business->category->name ?? '' }} · {{ $business->area->name ?? '' }}</p>
              <div class="mt-3 flex flex-wrap items-center gap-3 text-sm font-extrabold">
                <span class="rounded-full bg-orange-50 px-3 py-1 text-[#EA580C]">{{ $business->avg_rating ?? '4.8' }} من 5</span>
                <a href="#reviews" class="text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $business->reviews_count ?? 0 }} مراجعة</a>
                <span class="inline-flex items-center gap-2 rounded-2xl border border-green-100 bg-green-50 px-3 py-1.5 text-[#16A34A] shadow-sm">
                  <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
                  مفتوح الآن
                </span>
              </div>
              <p class="mt-3 text-sm leading-6 text-slate-600">{{ $business->address ?? '' }}</p>
              <p class="mt-1 text-xs font-bold text-slate-500">آخر تحديث: {{ $business->updated_at?->format('d M Y') ?? '' }}</p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-3 sm:flex sm:flex-wrap lg:justify-end">
            @if($business->phone ?? false)
              <a href="tel:{{ $business->phone }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">اتصال</a>
              <a href="https://wa.me/{{ preg_replace('/\D/','',$business->phone) }}" class="inline-flex items-center justify-center rounded-2xl bg-[#16A34A] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-200">واتساب</a>
            @endif
            <a href="#location" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">الاتجاهات</a>
          </div>
        </div>
      </div>
      <div class="border-t border-slate-200 bg-slate-50 px-5 py-4 sm:px-6">
        <div class="grid gap-3 text-sm font-extrabold text-slate-700 sm:grid-cols-3" aria-label="مؤشرات الثقة">
          <div class="flex items-center gap-2 rounded-2xl bg-white px-3 py-3"><span class="text-[#16A34A]" aria-hidden="true">✓</span> تم التحقق من النشاط</div>
          <div class="flex items-center gap-2 rounded-2xl bg-white px-3 py-3"><span class="text-[#16A34A]" aria-hidden="true">✓</span> تم تحديث البيانات مؤخراً</div>
          <div class="flex items-center gap-2 rounded-2xl bg-white px-3 py-3"><span class="text-[#16A34A]" aria-hidden="true">✓</span> يرد عادة خلال 15 دقيقة</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Main content + sidebar --}}
<section class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_360px] lg:px-8">
  <div class="grid gap-6">

    {{-- About --}}
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
      <h2 class="text-2xl font-extrabold text-slate-950">عن النشاط</h2>
      <p class="mt-4 text-base leading-8 text-slate-600">{{ $business->description ?? '' }}</p>
    </article>

    {{-- Services --}}
    @if(isset($business->services) && $business->services->count())
      <section aria-labelledby="services-title" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <p class="text-sm font-extrabold text-[#16A34A]">الخدمات</p>
        <h2 id="services-title" class="mt-2 text-2xl font-extrabold text-slate-950">ما الذي يقدمه النشاط؟</h2>
        <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
          @foreach($business->services as $service)
            <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
              <h3 class="font-extrabold text-slate-950">{{ $service->name }}</h3>
              <p class="mt-2 text-sm leading-6 text-slate-600">{{ $service->description }}</p>
            </article>
          @endforeach
        </div>
      </section>
    @endif

    {{-- Reviews --}}
    <section id="reviews" aria-labelledby="reviews-title" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
      <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <p class="text-sm font-extrabold text-[#EA580C]">المراجعات</p>
          <h2 id="reviews-title" class="mt-2 text-2xl font-extrabold text-slate-950">ماذا يقول الزوار؟</h2>
        </div>
        <div class="grid gap-3 sm:grid-cols-[auto_auto] lg:grid-cols-1">
          <div class="rounded-2xl bg-orange-50 p-4 text-center">
            <p class="text-4xl font-extrabold text-[#EA580C]">{{ $business->avg_rating ?? '4.8' }}</p>
            <p class="mt-1 text-sm font-extrabold text-slate-600">من {{ $business->reviews_count ?? 0 }} مراجعة</p>
          </div>
          @auth
            <a href="#write-review" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">اكتب مراجعة</a>
          @else
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">دخّل لتكتب مراجعة</a>
          @endauth
        </div>
      </div>

      <div class="mt-6 grid gap-4">
        @forelse($business->reviews ?? [] as $review)
          <article class="rounded-2xl border border-slate-200 bg-white p-4">
            <div class="flex items-start justify-between gap-4">
              <div>
                <h3 class="font-extrabold text-slate-950">{{ $review->user->name ?? 'مجهول' }}</h3>
                <p class="mt-1 text-xs font-bold text-slate-500">{{ $review->created_at->format('d M Y') }}</p>
              </div>
              <span class="rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $review->rating }}</span>
            </div>
            <p class="mt-3 text-sm leading-7 text-slate-600">{{ $review->comment }}</p>
          </article>
        @empty
          <p class="text-sm font-bold text-slate-500">لا توجد مراجعات بعد. كن أول من يكتب!</p>
        @endforelse
      </div>
    </section>

    {{-- Location --}}
    <section id="location" aria-labelledby="location-title" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
      <p class="text-sm font-extrabold text-[#2563EB]">الموقع</p>
      <h2 id="location-title" class="mt-2 text-2xl font-extrabold text-slate-950">كيف تصل؟</h2>
      <div class="relative mt-5 h-80 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
        <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(148,163,184,0.14)_1px,transparent_1px),linear-gradient(0deg,rgba(148,163,184,0.14)_1px,transparent_1px)] bg-[size:44px_44px]"></div>
        <div class="absolute inset-x-0 top-14 h-8 bg-white shadow-sm"></div>
        <div class="absolute inset-y-0 right-20 w-8 bg-white shadow-sm"></div>
        <div class="absolute right-1/2 top-1/2 flex size-14 -translate-y-1/2 translate-x-1/2 items-center justify-center rounded-full border-4 border-white bg-[#2563EB] text-sm font-extrabold text-white shadow-lg">المكان</div>
        <div class="absolute bottom-4 right-4 rounded-2xl border border-slate-200 bg-white/95 px-3 py-2 text-xs font-extrabold text-slate-600 shadow-sm">{{ $business->address ?? 'قلقيلية' }}</div>
      </div>
    </section>
  </div>

  {{-- Sidebar --}}
  <aside class="grid h-fit gap-6 lg:sticky lg:top-24">
    <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" aria-labelledby="info-title">
      <h2 id="info-title" class="text-xl font-extrabold text-slate-950">معلومات التواصل</h2>
      <dl class="mt-5 grid gap-4">
        @if(isset($business->workingHours) && $business->workingHours->count())
          <div>
            <dt class="text-sm font-extrabold text-slate-500">أوقات العمل</dt>
            @foreach($business->workingHours as $wh)
              <dd class="mt-1 text-sm font-extrabold text-slate-950">{{ $wh->day }}: {{ $wh->open_time }} - {{ $wh->close_time }}</dd>
            @endforeach
          </div>
        @endif
        @if($business->phone ?? false)
          <div>
            <dt class="text-sm font-extrabold text-slate-500">الهاتف</dt>
            <dd class="mt-1"><a href="tel:{{ $business->phone }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $business->phone }}</a></dd>
          </div>
        @endif
        @if($business->email ?? false)
          <div>
            <dt class="text-sm font-extrabold text-slate-500">البريد الإلكتروني</dt>
            <dd class="mt-1"><a href="mailto:{{ $business->email }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $business->email }}</a></dd>
          </div>
        @endif
        @if($business->website ?? false)
          <div>
            <dt class="text-sm font-extrabold text-slate-500">الموقع</dt>
            <dd class="mt-1"><a href="{{ $business->website }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100" target="_blank" rel="noopener">{{ $business->website }}</a></dd>
          </div>
        @endif
      </dl>
    </section>

    <section id="claim" class="rounded-2xl border border-slate-200 bg-slate-950 p-5 text-white shadow-sm">
      <p class="text-sm font-extrabold text-blue-200">هل تملك هذا النشاط؟</p>
      <h2 class="mt-2 text-xl font-extrabold">طالب بإدارة الصفحة</h2>
      <p class="mt-3 text-sm leading-6 text-slate-300">حدّث الصور، أوقات العمل، والرد على المراجعات من لوحة واحدة.</p>
      <a href="{{ route('register') }}" class="mt-5 inline-flex w-full items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">المطالبة بالملف</a>
    </section>
  </aside>
</section>

{{-- Similar Businesses --}}
@if(isset($similar) && $similar->count())
<section class="border-y border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="text-sm font-extrabold text-[#16A34A]">أعمال مشابهة</p>
        <h2 class="mt-2 text-2xl font-extrabold text-slate-950">في نفس التصنيف أو المنطقة</h2>
      </div>
      <a href="{{ route('businesses.index') }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">عرض المزيد</a>
    </div>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      @foreach($similar as $s)
        <a href="{{ route('businesses.show', $s->slug) }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100">
          <div class="flex items-center justify-between gap-3">
            <span class="rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $s->avg_rating ?? '4.5' }}</span>
            <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
          </div>
          <h3 class="mt-4 text-lg font-extrabold text-slate-950">{{ $s->title }}</h3>
          <p class="mt-1 text-sm font-bold text-slate-500">{{ $s->category->name ?? '' }} · {{ $s->area->name ?? '' }}</p>
          <p class="mt-3 text-xs font-extrabold text-[#2563EB]">عرض الملف</p>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- Mobile sticky actions --}}
<div class="fixed inset-x-0 bottom-16 z-40 border-t border-slate-200 bg-white/95 px-3 py-3 shadow-lg backdrop-blur lg:hidden">
  <div class="mx-auto grid max-w-md grid-cols-3 gap-2">
    <a href="tel:{{ $business->phone ?? '' }}" class="inline-flex min-h-12 items-center justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white focus:outline-none focus:ring-4 focus:ring-blue-200">اتصال</a>
    <a href="https://wa.me/{{ preg_replace('/\D/','',$business->phone ?? '') }}" class="inline-flex min-h-12 items-center justify-center rounded-2xl bg-[#16A34A] px-3 py-3 text-sm font-extrabold text-white focus:outline-none focus:ring-4 focus:ring-green-200">واتساب</a>
    <a href="#location" class="inline-flex min-h-12 items-center justify-center rounded-2xl border border-slate-200 bg-white px-3 py-3 text-sm font-extrabold text-slate-800 focus:outline-none focus:ring-4 focus:ring-blue-100">الاتجاهات</a>
  </div>
</div>

@endsection
