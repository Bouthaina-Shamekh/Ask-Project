@extends('layouts.app')

@section('title', 'وظائف في قلقيلية | اسأل قلقيلية')
@section('meta_description', 'وظائف في قلقيلية عبر اسأل قلقيلية: ابحث عن فرص عمل محلية، صف النتائج حسب الدوام والخبرة والراتب، وتقدم بسرعة.')
@php $active = 'jobs'; @endphp

@section('content')

<section class="border-b border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
    <nav class="flex flex-wrap items-center gap-2 text-sm font-bold text-slate-500" aria-label="مسار التنقل">
      <a href="{{ route('home') }}" class="hover:text-[#2563EB]">الرئيسية</a>
      <span aria-hidden="true">/</span>
      <span class="text-slate-950">الوظائف</span>
    </nav>
    <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
      <div>
        <p class="inline-flex w-fit items-center gap-2 rounded-2xl bg-blue-50 px-3 py-1.5 text-sm font-extrabold text-[#2563EB]">
          <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
          فرص محلية محدثة
        </p>
        <h1 class="mt-3 text-3xl font-extrabold leading-tight text-slate-950 sm:text-4xl">وظائف في قلقيلية</h1>
        <p class="mt-3 max-w-2xl text-base leading-7 text-slate-600">ابحث عن فرص عمل قريبة من بيتك، وقارن بين نوع الدوام، الخبرة، الراتب، وتاريخ انتهاء التقديم بسرعة.</p>
      </div>
      <a href="#employer" class="inline-flex w-fit items-center justify-center rounded-2xl bg-[#16A34A] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-200">أعلن عن وظيفة</a>
    </div>
  </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8" aria-label="بحث الوظائف">
  <form action="{{ route('jobs.index') }}" method="GET" class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm" role="search">
    <div class="grid gap-3 lg:grid-cols-[1fr_220px_180px_auto]">
      <label class="relative block">
        <span class="sr-only">كلمة البحث عن وظيفة</span>
        <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-extrabold text-slate-400" aria-hidden="true">بحث</span>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="مسمى وظيفي، شركة، مهارة..."
          class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pr-16 pl-4 text-base font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
      </label>
      <label class="relative block">
        <span class="sr-only">نوع الوظيفة</span>
        <select name="type" class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-extrabold text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100">
          <option value="">كل أنواع الدوام</option>
          <option value="full_time" {{ request('type') === 'full_time' ? 'selected' : '' }}>دوام كامل</option>
          <option value="part_time" {{ request('type') === 'part_time' ? 'selected' : '' }}>دوام جزئي</option>
          <option value="internship" {{ request('type') === 'internship' ? 'selected' : '' }}>تدريب</option>
          <option value="freelance" {{ request('type') === 'freelance' ? 'selected' : '' }}>عمل حر</option>
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
  {{-- Mobile quick filters --}}
  <div class="lg:hidden mb-4">
    <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
      <div class="flex gap-2 overflow-x-auto pb-1">
        <a href="{{ route('jobs.index', array_merge(request()->all(), ['type' => 'full_time'])) }}" class="shrink-0 rounded-2xl {{ request('type') === 'full_time' ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">دوام كامل</a>
        <a href="{{ route('jobs.index', array_merge(request()->all(), ['type' => 'part_time'])) }}" class="shrink-0 rounded-2xl {{ request('type') === 'part_time' ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">دوام جزئي</a>
        <a href="{{ route('jobs.index', array_merge(request()->all(), ['experience' => 'no_experience'])) }}" class="shrink-0 rounded-2xl {{ request('experience') === 'no_experience' ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">بدون خبرة</a>
        <a href="{{ route('jobs.index', array_merge(request()->all(), ['date' => 'today'])) }}" class="shrink-0 rounded-2xl {{ request('date') === 'today' ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">جديد اليوم</a>
      </div>
    </div>
  </div>

  <div class="grid gap-6 lg:grid-cols-[280px_1fr]">
    {{-- Sidebar filters --}}
    <aside class="hidden lg:block">
      <form action="{{ route('jobs.index') }}" method="GET" class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" aria-label="فلاتر الوظائف">
        <div class="flex items-center justify-between gap-3">
          <h2 class="text-lg font-extrabold text-slate-950">الفلاتر</h2>
          <a href="{{ route('jobs.index') }}" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700">مسح الكل</a>
        </div>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">نوع الوظيفة</legend>
          <div class="mt-3 grid gap-2">
            @foreach(['full_time'=>'دوام كامل','part_time'=>'دوام جزئي','internship'=>'تدريب','freelance'=>'عمل حر'] as $val => $label)
              <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                <input type="checkbox" name="types[]" value="{{ $val }}" {{ in_array($val,(array)request('types')) ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> {{ $label }}
              </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">الخبرة</legend>
          <div class="mt-3 grid gap-2">
            @foreach(['no_experience'=>'بدون خبرة','junior'=>'سنة إلى سنتين','mid'=>'3 سنوات','senior'=>'5 سنوات فأكثر'] as $val => $label)
              <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                <input type="checkbox" name="experience[]" value="{{ $val }}" {{ in_array($val,(array)request('experience')) ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> {{ $label }}
              </label>
            @endforeach
          </div>
        </fieldset>
        <fieldset class="mt-6">
          <legend class="text-sm font-extrabold text-slate-950">المنطقة</legend>
          <div class="mt-3 grid gap-2">
            @foreach($areas ?? [] as $area)
              <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                <input type="checkbox" name="areas[]" value="{{ $area->id }}" {{ in_array($area->id,(array)request('areas')) ? 'checked' : '' }} class="size-4 accent-[#2563EB]" /> {{ $area->name }}
              </label>
            @endforeach
          </div>
        </fieldset>
        <button type="submit" class="mt-6 w-full rounded-2xl bg-[#2563EB] py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تطبيق الفلاتر</button>
      </form>
    </aside>

    {{-- Results --}}
    <div>
      <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm mb-4">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div>
            <h2 class="text-lg font-extrabold text-slate-950">{{ $jobs->total() ?? 0 }} وظيفة متاحة</h2>
            <p class="mt-1 text-sm font-bold text-slate-500">نتائج محدثة من شركات ومحلات داخل قلقيلية.</p>
          </div>
          <form method="GET" action="{{ route('jobs.index') }}">
            @foreach(request()->except('sort') as $key => $val)
              <input type="hidden" name="{{ $key }}" value="{{ $val }}" />
            @endforeach
            <label class="flex items-center gap-2 text-sm font-extrabold text-slate-700">
              ترتيب:
              <select name="sort" onchange="this.form.submit()" class="h-11 rounded-2xl border border-slate-200 bg-slate-50 px-3 text-sm font-extrabold text-slate-700 outline-none focus:border-[#2563EB] focus:ring-4 focus:ring-blue-100">
                <option value="newest" {{ request('sort','newest') === 'newest' ? 'selected' : '' }}>الأحدث</option>
                <option value="salary" {{ request('sort') === 'salary' ? 'selected' : '' }}>الأعلى راتبا</option>
                <option value="expiry" {{ request('sort') === 'expiry' ? 'selected' : '' }}>ينتهي قريبا</option>
              </select>
            </label>
          </form>
        </div>
      </div>

      <div class="grid gap-4 xl:grid-cols-2">
        @forelse($jobs ?? [] as $job)
          <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
            @if($job->image)
              <img src="{{ asset('storage/'.$job->image) }}" alt="{{ $job->title }}" class="h-36 w-full object-cover" />
            @endif
            <div class="p-5">
              <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                  <p class="text-sm font-extrabold text-[#2563EB]">{{ $job->business->title ?? '' }} · {{ $job->area->name ?? '' }}</p>
                  <h3 class="mt-2 text-xl font-extrabold text-slate-950">{{ $job->title }}</h3>
                  <p class="mt-2 text-sm font-bold text-slate-500">
                    {{ __('employment.'.$job->employment_type) }}
                    @if($job->salary_min) · {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} {{ $job->salary_currency }} @endif
                    @if($job->experience_level) · {{ __('experience.'.$job->experience_level) }} @endif
                  </p>
                </div>
                <div class="flex flex-wrap gap-2">
                  @if($job->created_at->isToday())
                    <span class="w-fit rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">جديد اليوم</span>
                  @endif
                </div>
              </div>
              <p class="mt-4 text-sm leading-7 text-slate-600">{{ Str::limit($job->description, 120) }}</p>
              <div class="mt-5 grid gap-2 text-xs font-extrabold text-slate-500 sm:grid-cols-2">
                <span>نشر: {{ $job->created_at->diffForHumans() }}</span>
                @if($job->expires_at)
                  <span>ينتهي: {{ $job->expires_at->format('d M Y') }}</span>
                @endif
              </div>
              <div class="mt-5 grid grid-cols-2 gap-2">
                <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تقديم الآن</a>
                <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">التفاصيل</a>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-2 py-12 text-center text-slate-500 font-bold">لا توجد وظائف مطابقة حالياً.</div>
        @endforelse
      </div>

      @if(isset($jobs) && $jobs->hasPages())
        <nav class="mt-8 flex items-center justify-center gap-2" aria-label="صفحات النتائج">
          {{ $jobs->onEachSide(1)->links('components.pagination') }}
        </nav>
      @endif
    </div>
  </div>
</section>

{{-- Employer CTA --}}
<section id="employer" class="border-t border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid gap-6 rounded-2xl border border-slate-200 bg-slate-950 p-6 text-white shadow-sm sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
      <div>
        <p class="text-sm font-extrabold text-blue-200">لأصحاب العمل</p>
        <h2 class="mt-2 text-2xl font-extrabold sm:text-3xl">أعلن عن وظيفة وابحث عن الكفاءات المناسبة</h2>
        <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300">أضف تفاصيل الوظيفة، نوع الدوام، الراتب، والخبرة المطلوبة. يصلك الطلبات من سكان قلقيلية مباشرة.</p>
      </div>
      <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">أعلن عن وظيفة</a>
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-slate-600">سجل نشاطك</a>
      </div>
    </div>
  </div>
</section>

@endsection
