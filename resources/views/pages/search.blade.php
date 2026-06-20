@php $active = 'search'; @endphp
@extends('layouts.app')

@section('title', 'البحث | اسأل قلقيلية')

@section('content')

{{-- Hero + Search Form --}}
<section class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap items-center gap-2 text-sm font-bold text-slate-500" aria-label="مسار التنقل">
            <a href="{{ route('home') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">الرئيسية</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-950">البحث</span>
        </nav>

        <div class="mt-6 max-w-4xl">
            <p class="inline-flex w-fit items-center gap-2 rounded-2xl bg-blue-50 px-3 py-1.5 text-sm font-extrabold text-[#2563EB]">
                <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
                بحث ذكي داخل قلقيلية
            </p>
            <h1 class="mt-4 text-3xl font-extrabold leading-tight text-slate-950 sm:text-5xl">ابحث في الأعمال، الخدمات، الوظائف، والتصنيفات</h1>
            <p class="mt-4 max-w-2xl text-base leading-7 text-slate-600">
                اكتب اسم النشاط أو الخدمة أو الوظيفة التي تبحث عنها وسنرتب لك النتائج الأكثر فائدة.
            </p>
        </div>

        <form method="GET" action="{{ route('search') }}" class="mt-7 rounded-2xl border border-slate-200 bg-white p-3 shadow-lg shadow-slate-200/70" role="search" aria-label="البحث العام في اسأل قلقيلية">
            <div class="grid gap-3 lg:grid-cols-[1fr_220px_auto]">
                <label class="relative block">
                    <span class="sr-only">اكتب عبارة البحث</span>
                    <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-extrabold text-slate-400" aria-hidden="true">بحث</span>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="مطعم، وظيفة محاسبة، صيدلية..." autofocus class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pr-16 pl-4 text-base font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
                </label>
                <label>
                    <span class="sr-only">المنطقة</span>
                    <select name="area" class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-extrabold text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100">
                        <option value="">كل المناطق</option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </label>
                <button type="submit" class="inline-flex h-14 items-center justify-center rounded-2xl bg-[#2563EB] px-8 text-base font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">بحث</button>
            </div>
        </form>
    </div>
</section>

{{-- Results / Empty state --}}
@if (request('q') || request('area'))

<section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- Summary --}}
    @php $total = $businesses->count() + $jobs->count(); @endphp
    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <h2 class="text-lg font-extrabold text-slate-950">
            @if ($total > 0)
                وجدنا {{ $total }} نتيجة{{ request('q') ? ' لـ "' . request('q') . '"' : '' }}
            @else
                لا توجد نتائج{{ request('q') ? ' لـ "' . request('q') . '"' : '' }}
            @endif
        </h2>
        <p class="mt-1 text-sm font-bold text-slate-500">تشمل النتائج الأعمال المحلية والوظائف المتاحة.</p>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="grid gap-4">

            {{-- Businesses --}}
            @if ($businesses->count())
            <div>
                <p class="mb-3 text-sm font-extrabold text-slate-500">الأعمال ({{ $businesses->count() }})</p>
                @foreach ($businesses as $business)
                <article class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                    @if ($business->cover_image)
                    <img src="{{ asset('images/businesses/' . $business->cover_image) }}" alt="{{ $business->title }}" class="h-40 w-full object-cover" />
                    @endif
                    <div class="p-5">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <p class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-extrabold text-[#2563EB]">عمل محلي</p>
                                <h3 class="mt-2 text-xl font-extrabold text-slate-950">{{ $business->title }}</h3>
                                <p class="mt-1 text-sm font-bold text-slate-500">
                                    {{ $business->category->name ?? '' }}
                                    @if ($business->area) · {{ $business->area->name }} @endif
                                    @if ($business->is_open) · مفتوح الآن @endif
                                </p>
                            </div>
                            @if ($business->avg_rating)
                            <span class="w-fit rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ number_format($business->avg_rating, 1) }}</span>
                            @endif
                        </div>
                        @if ($business->description)
                        <p class="mt-4 text-sm leading-7 text-slate-600 line-clamp-2">{{ $business->description }}</p>
                        @endif
                        <div class="mt-5 flex flex-wrap gap-2">
                            <a href="{{ route('businesses.show', $business->slug) }}" class="inline-flex rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">عرض الملف</a>
                            @if ($business->phone)
                            <a href="tel:{{ $business->phone }}" class="inline-flex rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">اتصال</a>
                            @endif
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @endif

            {{-- Jobs --}}
            @if ($jobs->count())
            <div>
                <p class="mb-3 text-sm font-extrabold text-slate-500">الوظائف ({{ $jobs->count() }})</p>
                @foreach ($jobs as $job)
                <article class="mb-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="inline-flex rounded-full bg-orange-50 px-3 py-1 text-xs font-extrabold text-[#EA580C]">وظيفة</p>
                            <h3 class="mt-2 text-xl font-extrabold text-slate-950">{{ $job->title }}</h3>
                            <p class="mt-1 text-sm font-bold text-slate-500">
                                {{ $job->business->title ?? '' }}
                                @if ($job->area) · {{ $job->area->name }} @endif
                                @if ($job->employment_type) · {{ __('employment.' . $job->employment_type) }} @endif
                            </p>
                        </div>
                        <span class="w-fit rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">التقديم مفتوح</span>
                    </div>
                    @if ($job->description)
                    <p class="mt-4 text-sm leading-7 text-slate-600 line-clamp-2">{{ $job->description }}</p>
                    @endif
                    <div class="mt-5 flex flex-wrap gap-2">
                        <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تفاصيل الوظيفة</a>
                        <a href="{{ route('jobs.index') }}" class="inline-flex rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">كل الوظائف</a>
                    </div>
                </article>
                @endforeach
            </div>
            @endif

            {{-- Empty results --}}
            @if ($total === 0)
            <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                <p class="text-4xl">🔍</p>
                <h3 class="mt-4 text-lg font-extrabold text-slate-950">لم نجد نتائج مطابقة</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">جرّب كلمات أبسط أو ابحث في تصنيف مختلف.</p>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('businesses.index') }}" class="inline-flex rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white">تصفح الأعمال</a>
                    <a href="{{ route('jobs.index') }}" class="inline-flex rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800">تصفح الوظائف</a>
                </div>
            </div>
            @endif

        </div>

        {{-- Sidebar --}}
        <aside class="grid h-fit gap-6 lg:sticky lg:top-24">
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" aria-labelledby="related-title">
                <h2 id="related-title" class="text-lg font-extrabold text-slate-950">بحث في تصنيف</h2>
                <div class="mt-4 grid gap-2">
                    @forelse ($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-extrabold text-slate-700 hover:bg-blue-50 hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <span>{{ $category->name }}</span>
                        <span class="text-xs text-slate-400">{{ $category->businesses_count ?? '' }}</span>
                    </a>
                    @empty
                    @foreach (['مطاعم وكافيهات', 'صيدليات وصحة', 'تعليم وتدريب', 'محلات تجارية', 'خدمات تقنية'] as $cat)
                    <span class="flex rounded-2xl bg-slate-50 px-4 py-3 text-sm font-extrabold text-slate-700">{{ $cat }}</span>
                    @endforeach
                    @endforelse
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-lg font-extrabold text-slate-950">لم تجد ما تبحث عنه؟</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600">جرّب كلمات أبسط أو اختر تصنيفاً مختلفاً.</p>
                <div class="mt-5 grid gap-2">
                    <a href="{{ route('businesses.index') }}" class="inline-flex w-full items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تصفح كل الأعمال</a>
                    <a href="{{ route('jobs.index') }}" class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">تصفح كل الوظائف</a>
                </div>
            </section>
        </aside>
    </div>

</section>

@else

{{-- Initial state (no search yet) --}}
<section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- Suggestions --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-sm font-extrabold text-[#16A34A]">اقتراحات</p>
        <h2 class="mt-2 text-2xl font-extrabold text-slate-950">ابحث عن</h2>
        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
            <a href="{{ route('search') }}?q=مطاعم" class="rounded-2xl border border-blue-100 bg-blue-50 p-4 hover:bg-blue-100 focus:outline-none focus:ring-4 focus:ring-blue-100">
                <h3 class="font-extrabold text-slate-950">مطاعم وكافيهات</h3>
                <p class="mt-1 text-sm font-bold text-slate-600">أماكن للأكل والجلسات داخل قلقيلية.</p>
            </a>
            <a href="{{ route('search') }}?q=صيدلية" class="rounded-2xl border border-green-100 bg-green-50 p-4 hover:bg-green-100 focus:outline-none focus:ring-4 focus:ring-green-100">
                <h3 class="font-extrabold text-slate-950">صيدليات وصحة</h3>
                <p class="mt-1 text-sm font-bold text-slate-600">صيدليات وعيادات قريبة.</p>
            </a>
            <a href="{{ route('search') }}?q=وظائف" class="rounded-2xl border border-orange-100 bg-orange-50 p-4 hover:bg-orange-100 focus:outline-none focus:ring-4 focus:ring-orange-100">
                <h3 class="font-extrabold text-slate-950">وظائف متاحة</h3>
                <p class="mt-1 text-sm font-bold text-slate-600">فرص عمل في قلقيلية والمناطق القريبة.</p>
            </a>
            <a href="{{ route('search') }}?q=تقنية" class="rounded-2xl border border-blue-100 bg-blue-50 p-4 hover:bg-blue-100 focus:outline-none focus:ring-4 focus:ring-blue-100">
                <h3 class="font-extrabold text-slate-950">خدمات تقنية</h3>
                <p class="mt-1 text-sm font-bold text-slate-600">صيانة أجهزة، هواتف، وحلول تقنية.</p>
            </a>
        </div>
    </div>

    {{-- Quick tags --}}
    <div class="mt-6 flex flex-wrap gap-2">
        @foreach (['مطعم', 'كافيه', 'صيدلية', 'طبيب', 'وظيفة', 'محاسب', 'مدرسة', 'بنك', 'هاتف', 'توصيل'] as $tag)
        <a href="{{ route('search') }}?q={{ $tag }}" class="rounded-2xl bg-slate-100 px-4 py-2.5 text-sm font-extrabold text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $tag }}</a>
        @endforeach
    </div>

    {{-- Transparency note --}}
    <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-4">
        <h3 class="text-sm font-extrabold text-slate-950">شفافية نتائج البحث</h3>
        <p class="mt-2 text-sm leading-6 text-slate-700">نتائج البحث تعتمد على بيانات الأعمال والوظائف المسجلة داخل منصة اسأل قلقيلية.</p>
    </div>

</section>

@endif

@endsection
