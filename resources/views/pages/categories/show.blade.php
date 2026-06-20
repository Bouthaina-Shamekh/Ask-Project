@php $active = 'categories'; @endphp
@extends('layouts.app')

@section('title', ($category->name ?? 'التصنيف') . ' في قلقيلية | اسأل قلقيلية')

@section('content')

{{-- ===== HERO ===== --}}
<section class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap items-center gap-2 text-sm font-bold text-slate-500" aria-label="مسار التنقل">
            <a href="{{ route('home') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">الرئيسية</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('categories.index') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">التصنيفات</a>
            <span aria-hidden="true">/</span>
            <span class="text-slate-950">{{ $category->name ?? 'مطاعم وكافيهات' }}</span>
        </nav>

        <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_360px] lg:items-end">
            <div>
                <p class="inline-flex w-fit items-center gap-2 rounded-2xl bg-blue-50 px-3 py-1.5 text-sm font-extrabold text-[#2563EB]">
                    <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
                    دليل {{ $category->name ?? 'المطاعم' }} المحلي
                </p>
                <h1 class="mt-4 text-3xl font-extrabold leading-tight text-slate-950 sm:text-5xl">
                    {{ $category->name ?? 'مطاعم وكافيهات' }} في قلقيلية
                </h1>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-600">
                    {{ $category->description ?? 'تصفح أفضل الأماكن ضمن هذا التصنيف في قلقيلية، قارن التقييمات وأوقات العمل، واختر المكان المناسب.' }}
                </p>
                <p class="mt-3 inline-flex rounded-2xl bg-green-50 px-3 py-1.5 text-xs font-extrabold text-[#16A34A]">
                    آخر تحديث للتصنيف: اليوم
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#places" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">تصفح الأماكن</a>
                    <a href="{{ route('businesses.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">أضف نشاطك</a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-2xl font-extrabold text-slate-950">{{ $businesses->total() ?: 214 }}</p>
                    <p class="mt-1 text-xs font-extrabold text-slate-500">مكان</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-2xl font-extrabold text-slate-950">{{ $businesses->where('is_open', true)->count() ?: 86 }}</p>
                    <p class="mt-1 text-xs font-extrabold text-slate-500">مفتوح الآن</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-2xl font-extrabold text-slate-950">
                        {{ $businesses->count() ? number_format($businesses->avg('avg_rating'), 1) : '4.6' }}
                    </p>
                    <p class="mt-1 text-xs font-extrabold text-slate-500">متوسط التقييم</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-2xl font-extrabold text-slate-950">{{ $businesses->sum('reviews_count') ?: '1,900' }}</p>
                    <p class="mt-1 text-xs font-extrabold text-slate-500">مراجعة</p>
                </div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50 p-4">
            <p class="text-sm leading-6 text-slate-700">يتم تحديث بيانات هذا التصنيف بناءً على الأنشطة المسجلة داخل منصة اسأل قلقيلية.</p>
        </div>
    </div>
</section>

{{-- ===== SUBCATEGORIES ===== --}}
<section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8" aria-labelledby="subcategories-title">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-extrabold text-[#16A34A]">تصنيفات فرعية</p>
            <h2 id="subcategories-title" class="mt-2 text-2xl font-extrabold text-slate-950">اختر نوع المكان</h2>
        </div>
    </div>
    <div class="mt-5 flex gap-2 overflow-x-auto pb-1">
        <a href="{{ route('categories.show', $category->slug ?? '#') }}" class="shrink-0 rounded-2xl bg-[#2563EB] px-4 py-2.5 text-sm font-extrabold text-white focus:outline-none focus:ring-4 focus:ring-blue-200">الكل</a>
        @if ($category->children && $category->children->count())
            @foreach ($category->children as $child)
            <a href="{{ route('categories.show', $child->slug) }}" class="shrink-0 rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-extrabold text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $child->name }}</a>
            @endforeach
        @else
            @foreach (['مطاعم شعبية', 'كافيهات', 'مشاوي', 'حلويات', 'وجبات سريعة', 'توصيل'] as $sub)
            <span class="shrink-0 rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-extrabold text-slate-700">{{ $sub }}</span>
            @endforeach
        @endif
    </div>
</section>

{{-- ===== SEARCH FORM ===== --}}
<section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8" aria-label="بحث داخل التصنيف">
    <form method="GET" action="{{ route('categories.show', $category->slug ?? '#') }}" class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm" role="search">
        <div class="grid gap-3 lg:grid-cols-[1fr_220px_180px_auto]">
            <label class="relative block">
                <span class="sr-only">ابحث داخل التصنيف</span>
                <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-extrabold text-slate-400" aria-hidden="true">بحث</span>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="اسم المكان أو الخدمة..." class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pr-16 pl-4 text-base font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
            </label>
            <label>
                <span class="sr-only">المنطقة</span>
                <select name="area" class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-extrabold text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100">
                    <option value="">كل المناطق</option>
                    @if (isset($areas))
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    @else
                        <option>وسط البلد</option>
                        <option>شارع نابلس</option>
                        <option>منطقة السوق</option>
                    @endif
                </select>
            </label>
            <label class="flex h-14 items-center justify-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-extrabold text-slate-700">
                <input type="checkbox" name="open_now" value="1" class="size-4 accent-[#2563EB]" {{ request('open_now') ? 'checked' : '' }} />
                مفتوح الآن
            </label>
            <button type="submit" class="inline-flex h-14 items-center justify-center rounded-2xl bg-[#2563EB] px-7 text-base font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">بحث</button>
        </div>
    </form>
</section>

{{-- ===== FEATURED PLACES ===== --}}
<section class="border-y border-slate-200 bg-white" aria-labelledby="featured-title">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-extrabold text-[#EA580C]">أماكن مميزة</p>
                <h2 id="featured-title" class="mt-2 text-2xl font-extrabold text-slate-950">اختيارات بارزة في التصنيف</h2>
            </div>
            <a href="#places" class="text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">عرض كل النتائج</a>
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-3">
            @php
                $featured = $businesses->where('is_featured', true)->take(3);
                if ($featured->isEmpty()) {
                    $featured = $businesses->sortByDesc('avg_rating')->take(3);
                }
            @endphp

            @forelse ($featured as $biz)
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="relative h-40 overflow-hidden bg-slate-100">
                    @if ($biz->cover_image)
                    <img src="{{ asset('images/businesses/' . $biz->cover_image) }}" alt="{{ $biz->title }}" class="h-full w-full object-cover" />
                    @else
                    <div class="h-full w-full bg-gradient-to-br from-blue-100 to-slate-200"></div>
                    @endif
                    <div class="absolute inset-0 bg-slate-950/20"></div>
                    <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
                        <span class="text-2xl font-extrabold text-white">{{ $biz->category->name ?? $category->name }}</span>
                        @if ($biz->is_open)
                        <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
                        @else
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-600">مغلق</span>
                        @endif
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            @if ($biz->is_featured)
                            <span class="mb-2 inline-flex rounded-full bg-orange-50 px-3 py-1 text-xs font-extrabold text-[#EA580C]">مميز</span>
                            @endif
                            <h3 class="text-lg font-extrabold text-slate-950">{{ $biz->title }}</h3>
                            <p class="mt-1 text-sm font-bold text-slate-500">{{ $biz->area->name ?? '' }}</p>
                        </div>
                        @if ($biz->avg_rating)
                        <span class="rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ number_format($biz->avg_rating, 1) }}</span>
                        @endif
                    </div>
                    @if ($biz->description)
                    <p class="mt-3 text-sm leading-6 text-slate-600 line-clamp-2">{{ $biz->description }}</p>
                    @endif
                    <div class="mt-5 grid grid-cols-2 gap-2">
                        @if ($biz->phone)
                        <a href="tel:{{ $biz->phone }}" class="inline-flex justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white">اتصال</a>
                        @else
                        <span class="inline-flex justify-center rounded-2xl bg-slate-100 px-3 py-3 text-sm font-extrabold text-slate-400">اتصال</span>
                        @endif
                        <a href="{{ route('businesses.show', $biz->slug) }}" class="inline-flex justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800">عرض الملف</a>
                    </div>
                </div>
            </article>

            @empty
            {{-- Fallback featured --}}
            @foreach ([
                ['name' => 'مطعم أبو العبد', 'area' => 'وسط البلد', 'type' => 'مشاوي', 'rating' => '4.8', 'open' => true, 'img' => 'restaurant-interior.jpg', 'desc' => 'مشاوي ومأكولات شعبية مناسبة للعائلات.', 'featured' => true],
                ['name' => 'كافيه القلعة',   'area' => 'حي النقار',  'type' => 'كافيه',  'rating' => '4.8', 'open' => false, 'img' => 'cafe-interior.jpg',       'desc' => 'قهوة وحلويات وجلسات هادئة للشباب والعائلات.', 'featured' => true],
                ['name' => 'مطعم الزيتون',   'area' => 'منطقة السوق','type' => 'عائلي',  'rating' => '4.5', 'open' => true,  'img' => 'restaurant-food.jpg',     'desc' => 'وجبات عائلية وصواني مناسبات بأسعار واضحة.', 'featured' => false],
            ] as $f)
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="relative h-40 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/businesses/' . $f['img']) }}" alt="{{ $f['name'] }}" class="h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-slate-950/20"></div>
                    <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
                        <span class="text-2xl font-extrabold text-white">{{ $f['type'] }}</span>
                        @if ($f['open'])
                        <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
                        @else
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-600">مغلق</span>
                        @endif
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            @if ($f['featured'])
                            <span class="mb-2 inline-flex rounded-full bg-orange-50 px-3 py-1 text-xs font-extrabold text-[#EA580C]">مميز</span>
                            @endif
                            <h3 class="text-lg font-extrabold text-slate-950">{{ $f['name'] }}</h3>
                            <p class="mt-1 text-sm font-bold text-slate-500">{{ $f['area'] }}</p>
                        </div>
                        <span class="rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $f['rating'] }}</span>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $f['desc'] }}</p>
                    <div class="mt-5 grid grid-cols-2 gap-2">
                        <a href="tel:+970000000000" class="inline-flex justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white">اتصال</a>
                        <span class="inline-flex justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800">عرض الملف</span>
                    </div>
                </div>
            </article>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ===== FILTERS + RESULTS ===== --}}
<section id="places" class="mx-auto max-w-7xl scroll-mt-24 px-4 py-12 sm:px-6 lg:px-8">

    {{-- Mobile quick filters --}}
    <div class="lg:hidden" aria-label="فلاتر سريعة">
        <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
            <div class="flex gap-2 overflow-x-auto pb-1">
                <a href="?open_now=1" class="shrink-0 rounded-2xl {{ request('open_now') ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">مفتوح الآن</a>
                <a href="?sort=rating" class="shrink-0 rounded-2xl {{ request('sort') === 'rating' ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">الأعلى تقييما</a>
                <a href="?sort=newest" class="shrink-0 rounded-2xl {{ request('sort') === 'newest' ? 'bg-[#2563EB] text-white' : 'border border-slate-200 bg-white text-slate-700' }} px-4 py-2.5 text-sm font-extrabold">الأحدث</a>
            </div>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-[280px_1fr]">

        {{-- Desktop sidebar filters --}}
        <aside class="hidden lg:block">
            <form method="GET" action="{{ route('categories.show', $category->slug ?? '#') }}" class="sticky top-24 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm" aria-label="فلاتر التصنيف">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-lg font-extrabold text-slate-950">الفلاتر</h2>
                    <a href="{{ route('categories.show', $category->slug ?? '#') }}" class="text-sm font-extrabold text-[#2563EB]">مسح الكل</a>
                </div>
                <fieldset class="mt-6">
                    <legend class="text-sm font-extrabold text-slate-950">خيارات</legend>
                    <div class="mt-3 grid gap-2">
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="checkbox" name="open_now" value="1" class="size-4 accent-[#2563EB]" {{ request('open_now') ? 'checked' : '' }} /> مفتوح الآن
                        </label>
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="checkbox" name="top_rated" value="1" class="size-4 accent-[#2563EB]" {{ request('top_rated') ? 'checked' : '' }} /> الأعلى تقييما
                        </label>
                    </div>
                </fieldset>
                <fieldset class="mt-6">
                    <legend class="text-sm font-extrabold text-slate-950">الترتيب</legend>
                    <div class="mt-3 grid gap-2">
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="radio" name="sort" value="rating" class="size-4 accent-[#2563EB]" {{ request('sort', 'rating') === 'rating' ? 'checked' : '' }} /> الأعلى تقييماً
                        </label>
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="radio" name="sort" value="newest" class="size-4 accent-[#2563EB]" {{ request('sort') === 'newest' ? 'checked' : '' }} /> الأحدث
                        </label>
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="radio" name="sort" value="views" class="size-4 accent-[#2563EB]" {{ request('sort') === 'views' ? 'checked' : '' }} /> الأكثر زيارة
                        </label>
                    </div>
                </fieldset>
                @if (isset($areas) && $areas->count())
                <fieldset class="mt-6">
                    <legend class="text-sm font-extrabold text-slate-950">المنطقة</legend>
                    <div class="mt-3 grid gap-2">
                        @foreach ($areas as $area)
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="checkbox" name="areas[]" value="{{ $area->id }}" class="size-4 accent-[#2563EB]" {{ in_array($area->id, (array) request('areas', [])) ? 'checked' : '' }} /> {{ $area->name }}
                        </label>
                        @endforeach
                    </div>
                </fieldset>
                @else
                <fieldset class="mt-6">
                    <legend class="text-sm font-extrabold text-slate-950">المنطقة</legend>
                    <div class="mt-3 grid gap-2">
                        @foreach (['وسط البلد', 'شارع نابلس', 'منطقة السوق'] as $a)
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3 text-sm font-bold text-slate-700">
                            <input type="checkbox" class="size-4 accent-[#2563EB]" /> {{ $a }}
                        </label>
                        @endforeach
                    </div>
                </fieldset>
                @endif
                <button type="submit" class="mt-6 w-full rounded-2xl bg-[#2563EB] py-3 text-sm font-extrabold text-white hover:bg-blue-700">تطبيق الفلاتر</button>
            </form>
        </aside>

        {{-- Results --}}
        <div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h2 class="text-lg font-extrabold text-slate-950">
                    {{ $businesses->total() ?: $businesses->count() ?: 214 }} مكان ضمن {{ $category->name ?? 'هذا التصنيف' }}
                </h2>
                <p class="mt-1 text-sm font-bold text-slate-500">مرتبة حسب الصلة، التقييم، وحالة الدوام.</p>
            </div>

            @forelse ($businesses as $business)
                @if ($loop->first)
                <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @endif

                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-950">{{ $business->title }}</h3>
                            <p class="mt-1 text-sm font-bold text-slate-500">{{ $business->category->name ?? '' }}{{ $business->area ? ' · ' . $business->area->name : '' }}</p>
                        </div>
                        @if ($business->is_open)
                        <span class="shrink-0 rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
                        @else
                        <span class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-600">مغلق</span>
                        @endif
                    </div>
                    @if ($business->avg_rating)
                    <p class="mt-3 text-sm font-bold text-slate-500">{{ number_format($business->avg_rating, 1) }} · {{ $business->reviews_count ?? 0 }} مراجعة</p>
                    @endif
                    @if ($business->description)
                    <p class="mt-3 text-sm leading-6 text-slate-600 line-clamp-2">{{ $business->description }}</p>
                    @endif
                    <div class="mt-5 grid grid-cols-2 gap-2 sm:grid-cols-3">
                        @if ($business->phone)
                        <a href="tel:{{ $business->phone }}" class="inline-flex justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white">اتصال</a>
                        @else
                        <span class="inline-flex justify-center rounded-2xl bg-slate-100 px-3 py-3 text-sm font-extrabold text-slate-400">اتصال</span>
                        @endif
                        <a href="{{ route('businesses.show', $business->slug) }}" class="inline-flex justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800">الملف</a>
                        <a href="{{ route('businesses.show', $business->slug) }}" class="col-span-2 inline-flex justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800 sm:col-span-1">الاتجاهات</a>
                    </div>
                </article>

                @if ($loop->last)
                </div>
                @endif

            @empty
            {{-- Fallback results --}}
            <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ([
                    ['name' => 'مطعم أبو العبد',  'sub' => 'مشاوي · وسط البلد',         'rating' => '4.8', 'reviews' => 128, 'price' => '25-45 شيكل',  'open' => true,  'desc' => 'وجبات مشاوي ومقبلات وتوصيل قريب.'],
                    ['name' => 'كافيه القلعة',    'sub' => 'كافيهات · حي النقار',        'rating' => '4.8', 'reviews' => 96,  'price' => '15-35 شيكل',  'open' => false, 'desc' => 'قهوة وحلويات وجلسات هادئة.'],
                    ['name' => 'مطعم الزيتون',    'sub' => 'وجبات عائلية · منطقة السوق', 'rating' => '4.5', 'reviews' => 74,  'price' => '30-60 شيكل',  'open' => true,  'desc' => 'وجبات وصواني عائلية ومناسبات.'],
                    ['name' => 'شاورما البلد',    'sub' => 'وجبات سريعة · شارع نابلس',   'rating' => '4.6', 'reviews' => 112, 'price' => '10-25 شيكل',  'open' => true,  'desc' => 'شاورما ووجبات سريعة للطلاب والموظفين.'],
                    ['name' => 'حلويات الربيع',   'sub' => 'حلويات · وسط البلد',         'rating' => '4.7', 'reviews' => 88,  'price' => '20-50 شيكل',  'open' => true,  'desc' => 'حلويات شرقية وطلبات مناسبات.'],
                    ['name' => 'كافيه البلد',     'sub' => 'كافيهات · منطقة السوق',      'rating' => '4.4', 'reviews' => 51,  'price' => '12-30 شيكل',  'open' => false, 'desc' => 'قهوة ومشروبات باردة وجلسات قصيرة.'],
                ] as $item)
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-extrabold text-slate-950">{{ $item['name'] }}</h3>
                            <p class="mt-1 text-sm font-bold text-slate-500">{{ $item['sub'] }}</p>
                        </div>
                        @if ($item['open'])
                        <span class="shrink-0 rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
                        @else
                        <span class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-600">مغلق</span>
                        @endif
                    </div>
                    <p class="mt-3 text-sm font-bold text-slate-500">{{ $item['rating'] }} · {{ $item['reviews'] }} مراجعة · {{ $item['price'] }}</p>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['desc'] }}</p>
                    <div class="mt-5 grid grid-cols-2 gap-2 sm:grid-cols-3">
                        <a href="tel:+970000000000" class="inline-flex justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white">اتصال</a>
                        <span class="inline-flex justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800">الملف</span>
                        <span class="col-span-2 inline-flex justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800 sm:col-span-1">الاتجاهات</span>
                    </div>
                </article>
                @endforeach
            </div>
            @endforelse

            {{-- Pagination --}}
            @if ($businesses->hasPages())
            <nav class="mt-8 flex items-center justify-center gap-2" aria-label="صفحات النتائج">
                {{ $businesses->links() }}
            </nav>
            @endif
        </div>
    </div>
</section>

{{-- ===== LOCAL GUIDE ===== --}}
<section class="border-y border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <p class="text-sm font-extrabold text-[#2563EB]">دليل محلي</p>
        <h2 class="mt-2 text-2xl font-extrabold text-slate-950">كيف تختار المكان المناسب في قلقيلية؟</h2>
        <div class="mt-5 grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl bg-slate-50 p-5">
                <h3 class="font-extrabold text-slate-950">راجع التقييمات</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">اقرأ آراء الزوار حول جودة الخدمة والنظافة وسرعة الاستجابة.</p>
            </article>
            <article class="rounded-2xl bg-slate-50 p-5">
                <h3 class="font-extrabold text-slate-950">تأكد من أوقات العمل</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">اختر الأماكن المفتوحة الآن أو التي تناسب وقت زيارتك.</p>
            </article>
            <article class="rounded-2xl bg-slate-50 p-5">
                <h3 class="font-extrabold text-slate-950">اختر حسب المنطقة والخدمة</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">قارن بين وسط البلد، السوق، وخيارات التوصيل أو الزيارة العائلية.</p>
            </article>
        </div>
    </div>
</section>

{{-- ===== RELATED CATEGORIES ===== --}}
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8" aria-labelledby="related-title">
    <h2 id="related-title" class="text-2xl font-extrabold text-slate-950">تصنيفات مرتبطة</h2>
    <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        @if (isset($relatedCategories) && $relatedCategories->count())
            @foreach ($relatedCategories as $rel)
            <a href="{{ route('categories.show', $rel->slug) }}" class="rounded-2xl border border-slate-200 bg-white p-5 font-extrabold text-slate-950 shadow-sm hover:border-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $rel->name }}</a>
            @endforeach
        @else
            @foreach (['حلويات', 'خدمات التوصيل', 'مواد غذائية', 'مناسبات وضيافة'] as $rel)
            <a href="{{ route('categories.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 font-extrabold text-slate-950 shadow-sm hover:border-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $rel }}</a>
            @endforeach
        @endif
    </div>
</section>

@endsection
