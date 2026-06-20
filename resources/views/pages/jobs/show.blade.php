@extends('layouts.app')

@section('title', ($job->title ?? 'وظيفة') . ' | ' . ($job->business->title ?? '') . ' | اسأل قلقيلية')
@section('meta_description', Str::limit($job->description ?? '', 150))
@php $active = 'jobs'; @endphp

@section('content')

{{-- Breadcrumb --}}
<section class="border-b border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
    <nav class="flex flex-wrap items-center gap-2 text-sm font-bold text-slate-500" aria-label="مسار التنقل">
      <a href="{{ route('home') }}" class="hover:text-[#2563EB]">الرئيسية</a>
      <span aria-hidden="true">/</span>
      <a href="{{ route('jobs.index') }}" class="hover:text-[#2563EB]">الوظائف</a>
      <span aria-hidden="true">/</span>
      <span class="text-slate-950">{{ $job->title ?? '' }}</span>
    </nav>
  </div>
</section>

{{-- Hero --}}
<section class="bg-white">
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
      @if($job->image ?? false)
        <img src="{{ asset('storage/'.$job->image) }}" alt="{{ $job->title }}" class="h-56 w-full object-cover" />
      @else
        <img src="{{ asset('images/jobs/office-workspace.jpg') }}" alt="{{ $job->title }}" class="h-56 w-full object-cover" />
      @endif
      <div class="p-5 sm:p-6">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
          <div>
            <div class="flex flex-wrap gap-2">
              <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">التقديم مفتوح</span>
              @if($job->created_at->isToday())
                <span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-extrabold text-[#EA580C]">جديد اليوم</span>
              @endif
            </div>
            <h1 class="mt-4 text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">{{ $job->title }}</h1>
            <p class="mt-3 text-lg font-extrabold text-slate-700">{{ $job->business->title ?? '' }}</p>
            <p class="mt-1 text-sm font-bold text-slate-500">{{ $job->business->category->name ?? '' }} · {{ $job->area->name ?? '' }}</p>
            <div class="mt-5 flex flex-wrap gap-2 text-sm font-extrabold">
              @if($job->employment_type)
                <span class="rounded-2xl bg-blue-50 px-3 py-2 text-[#2563EB]">{{ __('employment.'.$job->employment_type) }}</span>
              @endif
              @if($job->salary_min)
                <span class="rounded-2xl bg-green-50 px-3 py-2 text-[#16A34A]">{{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} {{ $job->salary_currency }}</span>
              @endif
              @if($job->experience_level)
                <span class="rounded-2xl bg-slate-100 px-3 py-2 text-slate-700">{{ __('experience.'.$job->experience_level) }}</span>
              @endif
              @if($job->workplace_type)
                <span class="rounded-2xl bg-slate-100 px-3 py-2 text-slate-700">{{ __('workplace.'.$job->workplace_type) }}</span>
              @endif
              @if($job->expires_at)
                <span class="rounded-2xl bg-orange-50 px-3 py-2 text-[#EA580C]">ينتهي: {{ $job->expires_at->format('d M Y') }}</span>
              @endif
            </div>
          </div>
          <a href="#apply" class="inline-flex w-full items-center justify-center rounded-2xl bg-[#2563EB] px-6 py-4 text-base font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 sm:w-fit">
            تقديم الآن
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Main + Sidebar --}}
<section class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_360px] lg:px-8">
  <div class="grid gap-6">

    {{-- Summary --}}
    <section aria-labelledby="summary-title" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
      <h2 id="summary-title" class="text-2xl font-extrabold text-slate-950">ملخص الوظيفة</h2>
      <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl bg-slate-50 p-4">
          <p class="text-sm font-extrabold text-slate-500">نوع الدوام</p>
          <p class="mt-1 font-extrabold text-slate-950">{{ __('employment.'.$job->employment_type ?? 'full_time') }}</p>
        </div>
        @if($job->salary_min ?? false)
          <div class="rounded-2xl bg-slate-50 p-4">
            <p class="text-sm font-extrabold text-slate-500">الراتب</p>
            <p class="mt-1 font-extrabold text-slate-950">{{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} {{ $job->salary_currency }}</p>
          </div>
        @endif
        @if($job->experience_level ?? false)
          <div class="rounded-2xl bg-slate-50 p-4">
            <p class="text-sm font-extrabold text-slate-500">الخبرة</p>
            <p class="mt-1 font-extrabold text-slate-950">{{ __('experience.'.$job->experience_level) }}</p>
          </div>
        @endif
        @if($job->area ?? false)
          <div class="rounded-2xl bg-slate-50 p-4">
            <p class="text-sm font-extrabold text-slate-500">مكان العمل</p>
            <p class="mt-1 font-extrabold text-slate-950">{{ $job->area->name }}</p>
          </div>
        @endif
        @if($job->expires_at ?? false)
          <div class="rounded-2xl bg-slate-50 p-4">
            <p class="text-sm font-extrabold text-slate-500">آخر موعد</p>
            <p class="mt-1 font-extrabold text-slate-950">{{ $job->expires_at->format('d M Y') }}</p>
          </div>
        @endif
      </div>
    </section>

    {{-- Description --}}
    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
      <h2 class="text-2xl font-extrabold text-slate-950">وصف الوظيفة</h2>
      <div class="mt-4 text-base leading-8 text-slate-600 prose prose-slate max-w-none">
        {!! nl2br(e($job->description ?? '')) !!}
      </div>
      @if($job->requirements ?? false)
        <h3 class="mt-8 text-xl font-extrabold text-slate-950">المتطلبات</h3>
        <div class="mt-4 text-sm leading-7 text-slate-600">
          {!! nl2br(e($job->requirements)) !!}
        </div>
      @endif
    </article>

    {{-- Apply --}}
    <section id="apply" aria-labelledby="apply-title" class="scroll-mt-24 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
      <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
          <p class="text-sm font-extrabold text-[#2563EB]">طريقة التقديم</p>
          <h2 id="apply-title" class="mt-2 text-2xl font-extrabold text-slate-950">قدّم على {{ $job->title }}</h2>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">أرسل بياناتك بوضوح واذكر خبرتك السابقة. يفضل إرفاق السيرة الذاتية بصيغة PDF.</p>
        </div>
        @auth
          <a href="#apply-form" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تقديم الآن</a>
        @else
          <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">دخول للتقديم</a>
        @endauth
      </div>

      @auth
        <form id="apply-form" action="{{ route('jobs.apply', $job->slug) }}" method="POST" enctype="multipart/form-data" class="mt-6 grid gap-4">
          @csrf
          <div class="grid gap-4 sm:grid-cols-2">
            <div>
              <label class="block text-sm font-extrabold text-slate-700 mb-2">الاسم الكامل</label>
              <input type="text" name="full_name" value="{{ auth()->user()->name }}" required class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-bold text-slate-900 outline-none focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
            </div>
            <div>
              <label class="block text-sm font-extrabold text-slate-700 mb-2">رقم الهاتف</label>
              <input type="tel" name="phone" required class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-bold text-slate-900 outline-none focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
            </div>
          </div>
          <div>
            <label class="block text-sm font-extrabold text-slate-700 mb-2">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-bold text-slate-900 outline-none focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
          </div>
          <div>
            <label class="block text-sm font-extrabold text-slate-700 mb-2">السيرة الذاتية (PDF)</label>
            <input type="file" name="cv" accept=".pdf,.doc,.docx" class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-bold text-slate-900 outline-none focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
          </div>
          <div>
            <label class="block text-sm font-extrabold text-slate-700 mb-2">رسالة تعريفية (اختياري)</label>
            <textarea name="message" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-base font-bold text-slate-900 outline-none focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100"></textarea>
          </div>
          <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-6 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">إرسال الطلب</button>
        </form>
      @endauth
    </section>

    {{-- Safety warning --}}
    <section class="rounded-2xl border border-orange-100 bg-orange-50 p-5 shadow-sm" aria-label="تنبيه أمان">
      <h2 class="text-lg font-extrabold text-slate-950">تنبيه أمان مهم</h2>
      <p class="mt-2 text-sm leading-7 text-slate-700">لا تدفع أي رسوم قبل التأكد من جهة العمل. اسأل قلقيلية لا يطلب أي مبالغ للتقديم على الوظائف.</p>
    </section>
  </div>

  {{-- Sidebar --}}
  <aside class="grid h-fit gap-6 lg:sticky lg:top-24">
    <section class="hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm lg:block">
      <h2 class="text-xl font-extrabold text-slate-950">إجراءات سريعة</h2>
      <div class="mt-5 grid gap-3">
        <a href="#apply" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تقديم الآن</a>
        <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">الرجوع للوظائف</a>
      </div>
    </section>

    @if($job->business ?? false)
      <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-start gap-4">
          <div class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-[#2563EB] text-xl font-extrabold text-white">
            {{ mb_substr($job->business->title, 0, 1) }}
          </div>
          <div>
            <div class="flex flex-wrap items-center gap-2">
              <h2 class="text-xl font-extrabold text-slate-950">{{ $job->business->title }}</h2>
              <span class="rounded-2xl bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">موثق</span>
            </div>
            <p class="mt-1 text-sm font-bold text-slate-500">{{ $job->business->category->name ?? '' }} · {{ $job->business->area->name ?? '' }}</p>
          </div>
        </div>
        <p class="mt-4 text-sm leading-7 text-slate-600">{{ Str::limit($job->business->description, 100) }}</p>
        <a href="{{ route('businesses.show', $job->business->slug) }}" class="mt-5 inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">عرض ملف صاحب العمل</a>
      </section>
    @endif
  </aside>
</section>

{{-- Similar Jobs --}}
@if(isset($similar) && $similar->count())
<section class="border-y border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="text-sm font-extrabold text-[#16A34A]">وظائف مشابهة</p>
        <h2 class="mt-2 text-2xl font-extrabold text-slate-950">فرص قد تناسبك أيضا</h2>
      </div>
      <a href="{{ route('jobs.index') }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700">عرض كل الوظائف</a>
    </div>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      @foreach($similar as $s)
        <a href="{{ route('jobs.show', $s->slug) }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100">
          <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-extrabold text-[#2563EB]">{{ __('employment.'.$s->employment_type) }}</span>
          <h3 class="mt-4 text-lg font-extrabold text-slate-950">{{ $s->title }}</h3>
          <p class="mt-1 text-sm font-bold text-slate-500">{{ $s->business->title ?? '' }} · {{ $s->area->name ?? '' }}</p>
          @if($s->salary_min)
            <p class="mt-3 text-sm font-extrabold text-slate-700">{{ number_format($s->salary_min) }} - {{ number_format($s->salary_max) }} {{ $s->salary_currency }}</p>
          @endif
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- Mobile sticky apply --}}
<div class="fixed inset-x-0 bottom-16 z-40 border-t border-slate-200 bg-white/95 px-3 py-3 shadow-lg backdrop-blur lg:hidden">
  <div class="mx-auto grid max-w-md grid-cols-2 gap-2">
    <a href="#apply" class="inline-flex min-h-12 items-center justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white focus:outline-none focus:ring-4 focus:ring-blue-200">تقديم الآن</a>
    <a href="{{ route('jobs.index') }}" class="inline-flex min-h-12 items-center justify-center rounded-2xl border border-slate-200 bg-white px-3 py-3 text-sm font-extrabold text-slate-800 focus:outline-none focus:ring-4 focus:ring-blue-100">الوظائف</a>
  </div>
</div>

@endsection
