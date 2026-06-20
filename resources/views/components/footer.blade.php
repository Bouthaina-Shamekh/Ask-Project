<footer class="bg-white">
  <div class="mx-auto grid max-w-7xl gap-8 border-t border-slate-200 px-4 pb-24 pt-12 sm:px-6 lg:grid-cols-[1.2fr_0.8fr_0.8fr] lg:px-8 lg:pb-12">
    <div>
      <div class="flex items-center gap-3">
        <span class="flex size-11 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
          <img src="{{ asset('images/ask-qalqilya-logo.svg') }}" alt="" class="h-full w-full object-contain p-1.5" />
        </span>
        <div>
          <p class="text-lg font-extrabold text-slate-950">اسأل قلقيلية</p>
          <p class="text-sm font-bold text-slate-500">دليل الأعمال والوظائف في المدينة</p>
        </div>
      </div>
      <p class="mt-4 max-w-md text-sm leading-6 text-slate-600">
        منصة محلية تساعد سكان قلقيلية والزوار على اكتشاف الخدمات الموثوقة وفرص العمل القريبة.
      </p>
    </div>
    <div>
      <h2 class="text-sm font-extrabold text-slate-950">روابط سريعة</h2>
      <div class="mt-4 grid gap-2 text-sm font-bold text-slate-600">
        <a href="{{ route('categories.index') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">التصنيفات</a>
        <a href="{{ route('businesses.index') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">الأعمال المميزة</a>
        <a href="{{ route('jobs.index') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">آخر الوظائف</a>
        <a href="{{ route('register') }}" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">أضف نشاطك</a>
      </div>
    </div>
    <div>
      <h2 class="text-sm font-extrabold text-slate-950">تواصل</h2>
      <div class="mt-4 grid gap-2 text-sm font-bold text-slate-600">
        <a href="mailto:hello@askqalqilya.ps" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">hello@askqalqilya.ps</a>
        <a href="tel:+970000000000" class="hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-blue-100">+970 00 000 0000</a>
        <span>قلقيلية، فلسطين</span>
      </div>
    </div>
  </div>
</footer>
