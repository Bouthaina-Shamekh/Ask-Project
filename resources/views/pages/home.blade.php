@extends('layouts.app')

@section('title', 'اسأل قلقيلية | دليل الأعمال والوظائف في قلقيلية')
@section('meta_description', 'اسأل قلقيلية منصة محلية للبحث عن المحلات والخدمات والوظائف في قلقيلية، مع تقييمات ومعلومات تواصل واضحة.')
@php $active = 'home'; @endphp

@section('content')

{{-- Hero / Search --}}
<section id="search" class="border-b border-slate-200 bg-white">
  <div class="mx-auto grid max-w-7xl gap-8 px-4 py-8 sm:px-6 sm:py-12 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-16">
    <div class="flex flex-col justify-center">
      <p class="mb-3 inline-flex w-fit items-center gap-2 rounded-2xl bg-blue-50 px-3 py-1.5 text-sm font-extrabold text-[#2563EB]">
        <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
        اكتشف قلقيلية كما يستخدمها أهلها
      </p>
      <h1 class="max-w-3xl text-4xl font-extrabold leading-tight tracking-normal text-slate-950 sm:text-5xl lg:text-6xl">
        ابحث عن محل، خدمة، أو وظيفة داخل قلقيلية
      </h1>
      <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
        منصة مدينة تجمع الأعمال القريبة، الأماكن الأعلى تقييما، والفرص المحلية في تجربة بحث بسيطة وواضحة.
      </p>

      <form action="{{ route('search') }}" method="GET" class="mt-7 rounded-2xl border border-slate-200 bg-white p-3 shadow-lg shadow-slate-200/70" role="search" aria-label="البحث في دليل قلقيلية">
        <div class="grid gap-3 lg:grid-cols-[1fr_210px_auto]">
          <label class="relative block">
            <span class="sr-only">كلمة البحث</span>
            <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-extrabold text-slate-400" aria-hidden="true">بحث</span>
            <input type="search" name="q" placeholder="مثلا: طبيب أسنان، مطعم، كهربائي، محاسب..."
              class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pr-16 pl-4 text-base font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100" />
          </label>
          <label class="relative block">
            <span class="sr-only">الموقع</span>
            <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-extrabold text-slate-400" aria-hidden="true">موقع</span>
            <select name="area" class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 pr-16 pl-4 text-base font-extrabold text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100">
              <option>كل قلقيلية</option>
              @foreach($areas ?? [] as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
              @endforeach
            </select>
          </label>
          <button type="submit" class="inline-flex h-14 items-center justify-center rounded-2xl bg-[#2563EB] px-7 text-base font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">
            بحث
          </button>
        </div>
      </form>

      <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4" aria-label="إحصائيات اسأل قلقيلية">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <p class="text-2xl font-extrabold text-slate-950">{{ $stats['businesses'] ?? '1,240+' }}</p>
          <p class="mt-1 text-xs font-extrabold text-slate-500">نشاط محلي</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <p class="text-2xl font-extrabold text-slate-950">{{ $stats['jobs'] ?? '86' }}</p>
          <p class="mt-1 text-xs font-extrabold text-slate-500">وظيفة نشطة</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <p class="text-2xl font-extrabold text-slate-950">{{ $stats['reviews'] ?? '8,900+' }}</p>
          <p class="mt-1 text-xs font-extrabold text-slate-500">تقييم ومراجعة</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
          <p class="text-2xl font-extrabold text-slate-950">{{ $stats['users'] ?? '24k' }}</p>
          <p class="mt-1 text-xs font-extrabold text-slate-500">مستخدم نشط</p>
        </div>
      </div>

      <div class="mt-5 flex flex-wrap gap-2" aria-label="روابط بحث سريعة">
        <a href="{{ route('search', ['q' => 'مطاعم']) }}" class="rounded-2xl bg-slate-100 px-3 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-100">مطاعم وسط البلد</a>
        <a href="{{ route('search', ['q' => 'طبيب أسنان']) }}" class="rounded-2xl bg-slate-100 px-3 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-100">أطباء أسنان</a>
        <a href="{{ route('jobs.index') }}" class="rounded-2xl bg-slate-100 px-3 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-100">وظائف اليوم</a>
        <a href="{{ route('search', ['q' => 'فنيون']) }}" class="rounded-2xl bg-slate-100 px-3 py-2 text-sm font-extrabold text-slate-700 hover:bg-slate-200 focus:outline-none focus:ring-4 focus:ring-blue-100">فنيون قريبون</a>
      </div>
    </div>

    <aside class="rounded-2xl border border-slate-200 bg-[#F8FAFC] p-4 shadow-sm sm:p-5" aria-label="لوحة اكتشاف قلقيلية">
      <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex items-center justify-between gap-4">
          <div>
            <p class="text-sm font-extrabold text-[#2563EB]">خريطة قلقيلية</p>
            <h2 class="mt-1 text-xl font-extrabold text-slate-950">أماكن قريبة منك الآن</h2>
          </div>
          <span class="rounded-2xl bg-green-50 px-3 py-2 text-xs font-extrabold text-[#16A34A]">مباشر</span>
        </div>
        <div class="relative mt-4 h-80 overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
          <img src="{{ asset('images/hero/local-map-preview.jpg') }}" alt="معاينة خريطة وأماكن محلية في قلقيلية" class="absolute inset-0 h-full w-full object-cover opacity-80" />
          <div class="absolute inset-0 bg-white/30"></div>
          <div class="absolute inset-x-0 top-10 h-8 bg-white shadow-sm"></div>
          <div class="absolute inset-y-0 right-16 w-8 bg-white shadow-sm"></div>
          <div class="absolute inset-y-0 left-20 w-8 bg-white shadow-sm"></div>
          <div class="absolute inset-x-0 bottom-16 h-8 bg-white shadow-sm"></div>
          <div class="absolute right-16 top-10 h-8 w-32 rotate-45 rounded-full bg-blue-100"></div>
          <div class="absolute bottom-16 left-20 h-8 w-28 -rotate-45 rounded-full bg-green-100"></div>
          <div class="absolute right-6 top-5 rounded-2xl border border-slate-200 bg-white px-3 py-2 text-xs font-extrabold text-slate-700 shadow-md">شارع نابلس</div>
          <div class="absolute right-8 top-24 rounded-2xl bg-[#2563EB] px-3 py-2 text-xs font-extrabold text-white shadow-md">السوق الشعبي</div>
          <div class="absolute left-8 top-20 rounded-2xl bg-white px-3 py-2 text-xs font-extrabold text-slate-800 shadow-md">عيادات</div>
          <div class="absolute bottom-8 right-24 rounded-2xl bg-[#16A34A] px-3 py-2 text-xs font-extrabold text-white shadow-md">مطاعم</div>
          <div class="absolute bottom-24 left-8 rounded-2xl bg-[#EA580C] px-3 py-2 text-xs font-extrabold text-white shadow-md">وظائف</div>
          <div class="absolute right-1/2 top-1/2 flex size-12 -translate-y-1/2 translate-x-1/2 items-center justify-center rounded-full border-4 border-white bg-[#2563EB] text-sm font-extrabold text-white shadow-lg">أنت</div>
          <div class="absolute bottom-4 right-4 flex items-center gap-2 rounded-2xl border border-slate-200 bg-white/95 px-3 py-2 text-xs font-extrabold text-slate-600 shadow-sm">
            <span class="size-2 rounded-full bg-[#16A34A]" aria-hidden="true"></span>
            18 مكان مفتوح الآن
          </div>
        </div>
        <div class="mt-4 grid gap-3">
          @forelse($nearbyBusinesses ?? [] as $business)
            <a href="{{ route('businesses.show', $business->slug) }}" class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white p-3 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">
              <span>
                <span class="block text-sm font-extrabold text-slate-950">{{ $business->title }}</span>
                <span class="block text-xs font-bold text-slate-500">{{ $business->area->name ?? '' }} · {{ $business->distance ?? '' }}</span>
              </span>
              <span class="rounded-full bg-orange-50 px-2.5 py-1 text-xs font-extrabold text-[#EA580C]">{{ $business->avg_rating ?? '4.8' }}</span>
            </a>
          @empty
            <a href="{{ route('businesses.index') }}" class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white p-3 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">
              <span>
                <span class="block text-sm font-extrabold text-slate-950">مطعم أبو العبد</span>
                <span class="block text-xs font-bold text-slate-500">وسط البلد · 4 دقائق</span>
              </span>
              <span class="rounded-full bg-orange-50 px-2.5 py-1 text-xs font-extrabold text-[#EA580C]">4.8</span>
            </a>
            <a href="{{ route('businesses.index') }}" class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white p-3 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">
              <span>
                <span class="block text-sm font-extrabold text-slate-950">صيدلية الأقصى</span>
                <span class="block text-xs font-bold text-slate-500">مفتوحة · 6 دقائق</span>
              </span>
              <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
            </a>
          @endforelse
        </div>
      </div>
    </aside>
  </div>
</section>

{{-- Categories --}}
<section id="categories" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
  <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
    <div>
      <p class="text-sm font-extrabold text-[#2563EB]">تصنيفات شائعة</p>
      <h2 class="mt-2 text-2xl font-extrabold text-slate-950 sm:text-3xl">ابدأ من أكثر ما يبحث عنه الناس</h2>
    </div>
    <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
      كل التصنيفات <span aria-hidden="true">←</span>
    </a>
  </div>
  <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @forelse($categories ?? [] as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100">
        <div class="relative h-32 overflow-hidden bg-blue-50">
          @if($cat->image)
            <img src="{{ asset('storage/'.$cat->image) }}" alt="{{ $cat->name }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
          @endif
          <div class="absolute inset-0 bg-slate-950/25"></div>
          <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
            <span class="text-3xl font-extrabold text-white">{{ $cat->name }}</span>
            <span class="rounded-full bg-white px-3 py-1 text-xs font-extrabold text-slate-600">{{ $cat->businesses_count ?? 0 }} مكان</span>
          </div>
        </div>
        <div class="p-4">
          <h3 class="font-extrabold text-slate-950">{{ $cat->name }}</h3>
          <p class="mt-1 text-sm font-bold text-slate-500">{{ $cat->description }}</p>
        </div>
      </a>
    @empty
      {{-- Static fallback --}}
      @foreach([
        ['label'=>'مطاعم','title'=>'مطاعم وكافيهات','desc'=>'مشاوي، قهوة، وجبات عائلية، وتوصيل داخل المدينة.','img'=>'categories/restaurants-cafes.jpg','count'=>'214 مكان','bg'=>'bg-blue-50'],
        ['label'=>'صحة','title'=>'أطباء وعيادات','desc'=>'عيادات، صيدليات، مختبرات، ومواعيد عمل واضحة.','img'=>'categories/clinics.jpg','count'=>'98 خدمة','bg'=>'bg-green-50'],
        ['label'=>'صيانة','title'=>'صيانة وفنيون','desc'=>'كهرباء، سباكة، أجهزة منزلية، وخدمات طارئة.','img'=>'categories/technicians.jpg','count'=>'143 فني','bg'=>'bg-orange-50'],
        ['label'=>'تسوق','title'=>'محلات وتسوق','desc'=>'ملابس، أجهزة، بقالة، مكتبات، وهدايا.','img'=>'categories/retail.jpg','count'=>'310 محل','bg'=>'bg-blue-50'],
        ['label'=>'تعليم','title'=>'تعليم ودورات','desc'=>'لغات، حاسوب، تقوية مدرسية، ومهارات مهنية.','img'=>'categories/education.jpg','count'=>'57 مركز','bg'=>'bg-green-50'],
        ['label'=>'وظائف','title'=>'وظائف وفرص','desc'=>'دوام كامل، جزئي، تدريب، وفرص للطلاب.','img'=>'jobs/office-workspace.jpg','count'=>'86 فرصة','bg'=>'bg-orange-50'],
      ] as $item)
        <a href="{{ route('categories.index') }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-100">
          <div class="relative h-32 overflow-hidden {{ $item['bg'] }}">
            <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
            <div class="absolute inset-0 bg-slate-950/25"></div>
            <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
              <span class="text-3xl font-extrabold text-white">{{ $item['label'] }}</span>
              <span class="rounded-full bg-white px-3 py-1 text-xs font-extrabold text-slate-600">{{ $item['count'] }}</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-extrabold text-slate-950">{{ $item['title'] }}</h3>
            <p class="mt-1 text-sm font-bold text-slate-500">{{ $item['desc'] }}</p>
          </div>
        </a>
      @endforeach
    @endforelse
  </div>
</section>

{{-- Featured Businesses --}}
<section id="featured" class="border-y border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="text-sm font-extrabold text-[#16A34A]">أعمال مميزة</p>
        <h2 class="mt-2 text-2xl font-extrabold text-slate-950 sm:text-3xl">محلات وخدمات عليها طلب هذا الأسبوع</h2>
      </div>
      <a href="{{ route('businesses.index') }}" class="inline-flex items-center gap-2 text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
        تصفح الأعمال <span aria-hidden="true">←</span>
      </a>
    </div>
    <div class="mt-6 grid gap-4 lg:grid-cols-3">
      @forelse($featuredBusinesses ?? [] as $business)
        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
          <div class="relative h-40 overflow-hidden bg-blue-50">
            @if($business->image)
              <img src="{{ asset('storage/'.$business->image) }}" alt="{{ $business->title }}" class="h-full w-full object-cover" />
            @endif
            <div class="absolute inset-0 bg-slate-950/20"></div>
            <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
              <span class="text-2xl font-extrabold text-white">{{ $business->category->name ?? '' }}</span>
              <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">مفتوح</span>
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
            <p class="mt-3 text-sm leading-6 text-slate-600">{{ Str::limit($business->description, 80) }}</p>
            <div class="mt-5 grid grid-cols-2 gap-2">
              <a href="tel:{{ $business->phone }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">اتصال</a>
              <a href="{{ route('businesses.show', $business->slug) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">التفاصيل</a>
            </div>
          </div>
        </article>
      @empty
        {{-- Static fallback --}}
        @foreach([
          ['name'=>'مطعم أبو العبد','cat'=>'مشاوي','area'=>'وسط البلد','desc'=>'مناسب للعائلات، جلسات داخلية، وتوصيل قريب داخل المدينة.','rating'=>'4.8','img'=>'businesses/restaurant-interior.jpg','status'=>'مفتوح','status_class'=>'bg-green-50 text-[#16A34A]','btn2'=>'الاتجاهات'],
          ['name'=>'عيادة د. سامر للأسنان','cat'=>'عيادة','area'=>'شارع نابلس','desc'=>'حجز مسبق، خدمات تجميل أسنان، وساعات عمل مسائية.','rating'=>'4.9','img'=>'categories/clinics.jpg','status'=>'مفتوح','status_class'=>'bg-green-50 text-[#16A34A]','btn2'=>'حجز'],
          ['name'=>'كهرباء الأمانة','cat'=>'صيانة','area'=>'جميع أحياء قلقيلية','desc'=>'خدمة طوارئ، فواتير واضحة، وفنيون موثقون.','rating'=>'4.7','img'=>'categories/technicians.jpg','status'=>'24/7','status_class'=>'bg-orange-50 text-[#EA580C]','btn2'=>'رسالة'],
        ] as $item)
          <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
            <div class="relative h-40 overflow-hidden bg-blue-50">
              <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover" />
              <div class="absolute inset-0 bg-slate-950/20"></div>
              <div class="absolute inset-x-4 bottom-4 flex items-end justify-between gap-3">
                <span class="text-2xl font-extrabold text-white">{{ $item['cat'] }}</span>
                <span class="rounded-full px-3 py-1 text-xs font-extrabold {{ $item['status_class'] }}">{{ $item['status'] }}</span>
              </div>
            </div>
            <div class="p-5">
              <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                  <h3 class="truncate text-lg font-extrabold text-slate-950">{{ $item['name'] }}</h3>
                  <p class="mt-1 text-sm font-bold text-slate-500">{{ $item['cat'] }} · {{ $item['area'] }}</p>
                </div>
                <span class="shrink-0 rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $item['rating'] }}</span>
              </div>
              <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['desc'] }}</p>
              <div class="mt-5 grid grid-cols-2 gap-2">
                <a href="tel:+970000000000" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-3 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">اتصال</a>
                <a href="{{ route('businesses.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-3 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">{{ $item['btn2'] }}</a>
              </div>
            </div>
          </article>
        @endforeach
      @endforelse
    </div>
  </div>
</section>

{{-- Latest Jobs --}}
<section id="jobs" class="mx-auto grid max-w-7xl gap-6 px-4 py-12 sm:px-6 lg:grid-cols-[0.85fr_1.15fr] lg:px-8">
  <div>
    <p class="text-sm font-extrabold text-[#EA580C]">آخر الوظائف</p>
    <h2 class="mt-2 text-2xl font-extrabold text-slate-950 sm:text-3xl">فرص عمل محلية محدثة</h2>
    <p class="mt-4 max-w-xl text-base leading-7 text-slate-600">بطاقات مختصرة تعرض نوع الدوام، الموقع، والخبرة المطلوبة ليسهل على الباحث عن عمل اتخاذ القرار بسرعة.</p>
    <a href="{{ route('jobs.index') }}" class="mt-6 inline-flex items-center justify-center rounded-2xl bg-[#16A34A] px-5 py-3 text-sm font-extrabold text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-200">
      تصفح الوظائف
    </a>
  </div>
  <div class="grid gap-3">
    @forelse($latestJobs ?? [] as $job)
      <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h3 class="text-lg font-extrabold text-slate-950">{{ $job->title }}</h3>
            <p class="mt-1 text-sm font-bold text-slate-500">{{ $job->business->title ?? '' }} · {{ $job->area->name ?? '' }}</p>
            <div class="mt-3 flex flex-wrap gap-2">
              @if($job->employment_type)
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-700">{{ __('employment.'.$job->employment_type) }}</span>
              @endif
              @if($job->experience_level)
                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-700">{{ __('experience.'.$job->experience_level) }}</span>
              @endif
              @if($job->created_at->isToday())
                <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">جديد اليوم</span>
              @endif
            </div>
          </div>
          <a href="{{ route('jobs.show', $job->slug) }}" class="inline-flex shrink-0 items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">التفاصيل</a>
        </div>
      </article>
    @empty
      @foreach([
        ['title'=>'محاسب/ة بدوام كامل','company'=>'شركة مواد غذائية','area'=>'منطقة السوق','tags'=>['دوام كامل','خبرة سنتين'],'new'=>true],
        ['title'=>'موظف مبيعات معرض','company'=>'معرض أجهزة كهربائية','area'=>'شارع نابلس','tags'=>['دوام مسائي','خبرة مبيعات'],'new'=>false],
        ['title'=>'مصمم/ة سوشيال ميديا','company'=>'مكتب دعاية وإعلان','area'=>'عمل هجين','tags'=>['جزئي','Portfolio مطلوب'],'new'=>false],
      ] as $item)
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
          <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
              <h3 class="text-lg font-extrabold text-slate-950">{{ $item['title'] }}</h3>
              <p class="mt-1 text-sm font-bold text-slate-500">{{ $item['company'] }} · {{ $item['area'] }}</p>
              <div class="mt-3 flex flex-wrap gap-2">
                @foreach($item['tags'] as $tag)
                  <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-700">{{ $tag }}</span>
                @endforeach
                @if($item['new'])
                  <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">جديد اليوم</span>
                @endif
              </div>
            </div>
            <a href="{{ route('jobs.index') }}" class="inline-flex shrink-0 items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-extrabold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">التفاصيل</a>
          </div>
        </article>
      @endforeach
    @endforelse
  </div>
</section>

{{-- Top Rated --}}
<section id="top-rated" class="border-y border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <p class="text-sm font-extrabold text-[#2563EB]">الأعلى تقييما</p>
        <h2 class="mt-2 text-2xl font-extrabold text-slate-950 sm:text-3xl">أماكن يثق بها سكان قلقيلية</h2>
      </div>
      <a href="{{ route('businesses.index') }}" class="inline-flex items-center gap-2 text-sm font-extrabold text-[#2563EB] hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
        عرض الترتيب الكامل <span aria-hidden="true">←</span>
      </a>
    </div>
    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      @forelse($topRated ?? [] as $i => $business)
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
          <div class="flex items-center justify-between gap-3">
            <span class="rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $business->avg_rating ?? '4.9' }}</span>
            <span class="text-xs font-extrabold text-slate-400">#{{ $i+1 }}</span>
          </div>
          <h3 class="mt-4 text-lg font-extrabold text-slate-950">{{ $business->title }}</h3>
          <p class="mt-1 text-sm font-bold text-slate-500">{{ $business->category->name ?? '' }} · {{ $business->area->name ?? '' }}</p>
          <p class="mt-4 text-sm leading-6 text-slate-600">{{ Str::limit($business->description, 70) }}</p>
        </article>
      @empty
        @foreach([
          ['name'=>'صيدلية الأقصى','cat'=>'صيدليات','area'=>'وسط البلد','rating'=>'4.9','rank'=>'الأول','desc'=>'خدمة سريعة وتوفر جيد للأدوية الأساسية.'],
          ['name'=>'مخبز قلقيلية المركزي','cat'=>'مخابز','area'=>'منطقة السوق','rating'=>'4.9','rank'=>'مميز','desc'=>'مخبوزات يومية وأسعار واضحة للعائلات.'],
          ['name'=>'مركز النور للتدريب','cat'=>'تعليم ودورات','area'=>'شارع الواد','rating'=>'4.8','rank'=>'موصى به','desc'=>'دورات حاسوب ولغات بمواعيد مناسبة للطلاب.'],
          ['name'=>'محلات البركة للخضار','cat'=>'مواد غذائية','area'=>'السوق الشعبي','rating'=>'4.8','rank'=>'شائع','desc'=>'منتجات يومية وأسعار محدثة باستمرار.'],
        ] as $item)
          <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between gap-3">
              <span class="rounded-full bg-orange-50 px-3 py-1 text-sm font-extrabold text-[#EA580C]">{{ $item['rating'] }}</span>
              <span class="text-xs font-extrabold text-slate-400">{{ $item['rank'] }}</span>
            </div>
            <h3 class="mt-4 text-lg font-extrabold text-slate-950">{{ $item['name'] }}</h3>
            <p class="mt-1 text-sm font-bold text-slate-500">{{ $item['cat'] }} · {{ $item['area'] }}</p>
            <p class="mt-4 text-sm leading-6 text-slate-600">{{ $item['desc'] }}</p>
          </article>
        @endforeach
      @endforelse
    </div>
  </div>
</section>

{{-- CTA for business owners --}}
<section id="owner" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
  <div class="grid gap-6 rounded-2xl border border-slate-200 bg-slate-950 p-6 text-white shadow-sm sm:p-8 lg:grid-cols-[1fr_auto] lg:items-center">
    <div>
      <p class="text-sm font-extrabold text-blue-200">لأصحاب الأعمال</p>
      <h2 class="mt-2 text-2xl font-extrabold sm:text-3xl">اجعل نشاطك ظاهرا عندما يبحث الناس في قلقيلية</h2>
      <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300">
        أضف بيانات العمل، أوقات الدوام، الصور، أرقام التواصل، والموقع. بطاقة واضحة تزيد الثقة وتختصر الطريق على العملاء.
      </p>
    </div>
    <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
      <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-[#2563EB] px-5 py-3 text-sm font-extrabold text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">أضف نشاطك مجانا</a>
      <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-700 px-5 py-3 text-sm font-extrabold text-white hover:bg-slate-900 focus:outline-none focus:ring-4 focus:ring-slate-600">أعلن عن وظيفة</a>
    </div>
  </div>
</section>

@endsection
