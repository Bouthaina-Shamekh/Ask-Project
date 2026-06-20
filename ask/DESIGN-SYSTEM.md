# نظام التصميم - اسأل قلقيلية

هذا المستند يوثق نظام الواجهة المستخدم في صفحات مشروع **Ask Qalqilya - اسأل قلقيلية** قبل تحويل الواجهات إلى Laravel Blade components.

الصفحات المغطاة:
`index.html`, `stores.html`, `store.html`, `category.html`, `search.html`, `jobs.html`, `job-single.html`, `login.html`, `register.html`, `business-dashboard.html`, `admin-dashboard.html`.

## 1. رؤية واجهة المشروع

اسأل قلقيلية منصة مدينة محلية تجمع بين دليل أعمال، وظائف، بحث، وصفحات إدارة لأصحاب الأعمال والإدارة.

الاتجاه البصري:

- منصة مدينة محلية موثوقة وسهلة الاستخدام.
- واجهة نظيفة وحديثة بدون زخرفة زائدة.
- Mobile-first: التجربة تبدأ من الهاتف.
- RTL-first: العربية هي اللغة الأساسية واتجاه القراءة من اليمين.
- Accessibility-first: عناوين واضحة، أزرار مفهومة، وحالات تركيز مرئية.
- مناسبة للصفحات العامة ولوحات التحكم.

المرجع الشعوري:

- بساطة Google Maps.
- ثراء Yelp في البطاقات والمراجعات.
- وضوح Apple.
- تنظيم Notion.

## 2. ألوان العلامة

الألوان الأساسية المعتمدة:

| الاستخدام | اللون | Tailwind |
| --- | --- | --- |
| Primary | `#2563EB` | `bg-[#2563EB]`, `text-[#2563EB]` |
| Secondary | `#16A34A` | `bg-[#16A34A]`, `text-[#16A34A]` |
| Accent | `#EA580C` | `bg-[#EA580C]`, `text-[#EA580C]` |
| Background | `#F8FAFC` | `bg-[#F8FAFC]` |
| Card | `#FFFFFF` | `bg-white` |

ألوان النص:

- العناوين القوية: `text-slate-950`
- النص الأساسي: `text-slate-700`
- النص الثانوي: `text-slate-500`
- الحدود: `border-slate-200`
- الخلفيات الهادئة: `bg-slate-50`

مثال:

```html
<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
  <h2 class="text-xl font-extrabold text-slate-950">عنوان القسم</h2>
  <p class="mt-2 text-sm leading-6 text-slate-600">نص مساعد واضح ومختصر.</p>
</section>
```

## 3. الخطوط

الخط الأساسي:

- Arabic: `Tajawal`
- English fallback: `Inter`

القاعدة العامة في الصفحات:

```html
<body class="bg-[#F8FAFC] text-slate-900 antialiased [font-family:Tajawal,Inter,sans-serif]">
```

استخدامات الخط:

| العنصر | الحجم والوزن المقترح |
| --- | --- |
| H1 | `text-3xl sm:text-4xl font-extrabold` |
| H2 | `text-2xl font-extrabold` أو `text-xl font-extrabold` |
| H3 | `text-base font-extrabold` |
| Body | `text-sm/leading-6` أو `text-base/leading-7` |
| Labels | `text-sm font-extrabold` |
| Small labels | `text-xs font-bold` أو `text-xs font-extrabold` |

## 4. نظام التخطيط

القواعد العامة:

- الحاوية الرئيسية: `max-w-7xl`
- هوامش أفقية: `px-4 sm:px-6 lg:px-8`
- نصف قطر العناصر: `rounded-2xl`
- ظل خفيف: `shadow-sm`
- حدود ناعمة: `border border-slate-200`
- الشبكات تبدأ عمودية على الهاتف ثم تتوسع على الشاشات الأكبر.

مثال تخطيط عام:

```html
<main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
  <div class="grid gap-6 lg:grid-cols-[280px_1fr]">
    ...
  </div>
</main>
```

قواعد mobile-first:

- استخدم `grid gap-4` افتراضياً.
- أضف `sm:grid-cols-2`, `lg:grid-cols-3`, `xl:grid-cols-4` حسب الحاجة.
- تجنب ضغط البطاقات أفقياً على الهاتف.

## 5. الأزرار

كل الأزرار يجب أن تكون واضحة، قابلة للمس، ولها focus state.

### Primary

```html
<a class="inline-flex h-12 items-center justify-center rounded-2xl bg-[#2563EB] px-5 text-sm font-extrabold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
  إجراء أساسي
</a>
```

### Secondary / Outline

```html
<a class="inline-flex h-12 items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 text-sm font-extrabold text-slate-800 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-blue-100">
  إجراء ثانوي
</a>
```

### Success

```html
<button class="rounded-2xl bg-[#16A34A] px-4 py-2 text-sm font-extrabold text-white focus:outline-none focus:ring-4 focus:ring-green-100">
  قبول
</button>
```

### Warning / Accent

```html
<a class="inline-flex h-11 items-center justify-center rounded-2xl bg-[#EA580C] px-5 text-sm font-extrabold text-white hover:bg-orange-700 focus:outline-none focus:ring-4 focus:ring-orange-100">
  عرض المهام
</a>
```

### Disabled

```html
<button disabled class="inline-flex h-12 cursor-not-allowed items-center justify-center rounded-2xl border border-slate-200 bg-slate-100 px-4 text-sm font-extrabold text-slate-400">
  Google (قريباً)
</button>
```

## 6. البطاقات

### Standard Card

```html
<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
  ...
</section>
```

### Business Card

تستخدم في المتاجر والتصنيفات:

- صورة أو placeholder بصري.
- اسم النشاط.
- التصنيف والمنطقة.
- التقييم وعدد المراجعات.
- الحالة: مفتوح / مغلق / موثق.
- أزرار: اتصال، اتجاهات، الملف.

### Job Card

تستخدم في الوظائف:

- عنوان الوظيفة.
- الشركة.
- المنطقة.
- نوع الدوام.
- الراتب مع ملاحظة: `الراتب معلن`, `قابل للتفاوض`, `حسب الخبرة`.
- أزرار: تقديم، التفاصيل.

### Dashboard Stat Card

```html
<article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
  <p class="text-sm font-bold text-slate-500">مشاهدات هذا الأسبوع</p>
  <p class="mt-2 text-3xl font-extrabold text-slate-950">248</p>
</article>
```

### Alert Card

```html
<section class="rounded-2xl border border-orange-200 bg-orange-50 p-5 shadow-sm">
  <p class="text-xs font-extrabold text-[#EA580C]">تنبيه</p>
  <h2 class="mt-2 text-xl font-extrabold text-slate-950">يوجد عناصر تحتاج مراجعة</h2>
</section>
```

### CTA Card

تستخدم لدعوة أصحاب الأعمال، نشر الوظائف، الترقية، أو إكمال الملف.

## 7. الشارات Badges

### Active / Open

```html
<span class="rounded-full bg-green-50 px-3 py-1 text-xs font-extrabold text-[#16A34A]">
  مفتوح الآن
</span>
```

### Featured

```html
<span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-extrabold text-[#EA580C]">
  مميز
</span>
```

### Pending

```html
<span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-extrabold text-[#EA580C]">
  قيد المراجعة
</span>
```

### Verified / Status

```html
<span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-extrabold text-[#2563EB]">
  موثق
</span>
```

### Category Labels

```html
<span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-700">
  مطاعم وكافيهات
</span>
```

## 8. النماذج

### Inputs

```html
<label for="email" class="text-sm font-extrabold text-slate-950">البريد الإلكتروني</label>
<input
  id="email"
  name="email"
  type="email"
  class="mt-2 h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-base font-bold text-slate-900 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-blue-100"
/>
```

### Selects

```html
<select class="h-12 rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-100">
  <option>الأحدث</option>
</select>
```

### Checkboxes

```html
<label class="flex items-start gap-3 rounded-2xl bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700">
  <input type="checkbox" class="mt-1 size-4 accent-[#2563EB]" />
  <span>أوافق على الشروط</span>
</label>
```

### Radio Cards

```html
<label class="rounded-2xl border border-orange-200 bg-orange-50 p-4 shadow-sm">
  <span class="mb-3 inline-flex rounded-full bg-white px-3 py-1 text-xs font-extrabold text-[#EA580C]">
    الأكثر استخداماً لأصحاب الأعمال
  </span>
  <span class="flex items-center gap-3">
    <input type="radio" name="account_type" class="size-4 accent-[#2563EB]" />
    <span class="font-extrabold text-slate-950">صاحب نشاط</span>
  </span>
</label>
```

### Helper Text

```html
<p class="mt-2 text-xs font-bold text-slate-500">يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل.</p>
```

### Error / Success Placeholders

استخدم التعليقات في صفحات المصادقة لتحويلها لاحقاً إلى رسائل Laravel validation:

```html
<!-- Validation Error Example -->
<!-- Success Message Example -->
```

## 9. التنقل

### Public Navbar

يستخدم في الصفحات العامة:

- شعار المنصة.
- روابط رئيسية: الرئيسية، الأعمال، الوظائف، البحث.
- CTA لأصحاب الأعمال.
- تسجيل الدخول / إنشاء حساب.

### Auth Navbar

أبسط من النافبار العام:

- الشعار.
- رابط العودة للرئيسية أو تسجيل الدخول.

### Dashboard Sidebar

لأصحاب الأعمال:

- بيانات النشاط.
- روابط إدارة: بيانات النشاط، الصور، الخدمات، أوقات العمل، الوظائف، المراجعات، الاشتراك.
- رابط تسجيل الخروج.

### Admin Sidebar

للإدارة:

- نظرة عامة.
- طلبات المتاجر.
- المتاجر المعتمدة.
- التصنيفات.
- الوظائف.
- الاشتراكات.
- المراجعات.
- المستخدمون.
- البلاغات.
- إعدادات المنصة.

### Mobile Bottom Navigation

للصفحات العامة:

- Home
- Businesses
- Search
- Jobs
- Account

### Mobile Dashboard Chips

في لوحات التحكم:

```html
<nav class="flex gap-2 overflow-x-auto pb-1 lg:hidden">
  <a class="shrink-0 rounded-full bg-blue-50 px-4 py-2 text-sm font-extrabold text-[#2563EB]">نظرة عامة</a>
</nav>
```

## 10. الجداول وقوائم البيانات

تستخدم الجداول في لوحة الإدارة بصيغة responsive list:

- على desktop: صفوف تشبه الجدول باستخدام CSS Grid.
- على mobile: تتحول إلى بطاقات متكدسة.
- الإجراءات تكون واضحة: قبول، رفض، عرض.

مثال:

```html
<article class="grid gap-4 p-4 lg:grid-cols-[1.2fr_1fr_0.8fr_1fr_0.8fr_0.8fr_1.3fr] lg:items-center">
  <div>
    <p class="text-xs font-bold text-slate-500 lg:hidden">اسم النشاط</p>
    <p class="font-extrabold text-slate-950">مطعم أبو العبد</p>
  </div>
</article>
```

## 11. مكونات لوحات التحكم

المكونات المشتركة بين `business-dashboard.html` و `admin-dashboard.html`:

- Topbar ثابت أعلى الصفحة.
- Sidebar على desktop.
- Mobile chips على الهاتف.
- Stats cards.
- Attention alerts.
- Completion / data quality cards.
- Subscription cards.
- Activity log.
- Quick actions.

قواعد UX:

- اجعل أول شاشة توضح ما يحتاج انتباه.
- لا تستخدم مصطلحات تقنية.
- اجعل الأزرار الإدارية واضحة وآمنة.
- لا تضع الكثير من الإجراءات في بطاقة واحدة.

## 12. مكونات الصفحات العامة

### Hero

- عنوان واضح.
- بحث كبير ومركزي.
- رسالة ثقة أو مؤشرات اجتماعية.
- لا تستخدم زخارف مبالغ بها.

### Search Bar

- حقل بحث كبير.
- زر واضح.
- دعم أمثلة عربية داخل placeholder.

### Category Section

- بطاقات أو chips واضحة.
- ألوان هادئة.
- قابلية لمس جيدة على الهاتف.

### Business Results

- صورة أو placeholder.
- الاسم، التصنيف، المنطقة.
- التقييم والحالة.
- أزرار اتصال واتجاهات وملف.

### Job Results

- عنوان الوظيفة.
- الشركة.
- الراتب.
- نوع الدوام.
- أزرار تقديم وتفاصيل.

### Reviews

- ملخص تقييم.
- بطاقات مراجعات.
- أزرار الرد أو كتابة مراجعة عند الحاجة.

### Map Placeholder

- خريطة ثابتة أو placeholder بصري بدون مكتبات خارجية.

### Related Items

- أعمال مشابهة.
- وظائف مشابهة.
- تصنيفات ذات صلة.

## 13. قواعد الوصول Accessibility

- صفحة واحدة = `h1` واحد.
- استخدم `section`, `header`, `main`, `footer`, `nav`, `aside`.
- أضف `aria-label` للتنقلات عندما لا يكون السياق كافياً.
- استخدم `aria-current="page"` للرابط الحالي.
- كل العناصر التفاعلية تحتاج focus state:
  `focus:outline-none focus:ring-4 focus:ring-blue-100`
- لا تستخدم أزرار بأيقونات فقط.
- لا تعتمد على اللون وحده لتوصيل المعنى.
- حافظ على حجم لمس مريح: `h-11` أو `h-12` أو `h-14`.

## 14. قواعد RTL

- كل صفحة تبدأ بـ:

```html
<html lang="ar" dir="rtl">
```

- النصوص العربية هي الافتراضية.
- استخدم `text-right` عند الحاجة فقط، لأن RTL يعالج الاتجاه غالباً.
- راع المسافات في النماذج والبطاقات من اليمين.
- في البيانات المختلطة مثل الهاتف أو التاريخ، حافظ على وضوح القراءة.
- تجنب اختصارات إنجليزية غير ضرورية داخل الواجهة.

## 15. خطة التحويل إلى Laravel Blade

### Layouts

- `layouts/public-layout.blade.php`
- `layouts/auth-layout.blade.php`
- `layouts/dashboard-layout.blade.php`
- `layouts/admin-layout.blade.php`

### Partials

- `partials/navbar.blade.php`
- `partials/footer.blade.php`
- `partials/mobile-nav.blade.php`
- `partials/dashboard-sidebar.blade.php`
- `partials/admin-sidebar.blade.php`
- `partials/topbar.blade.php`

### Components

- `components/button.blade.php`
- `components/badge.blade.php`
- `components/card.blade.php`
- `components/search-form.blade.php`
- `components/business-card.blade.php`
- `components/job-card.blade.php`
- `components/stat-card.blade.php`
- `components/alert-card.blade.php`
- `components/pagination.blade.php`

مثال Button component:

```blade
<x-button variant="primary" href="{{ route('stores.index') }}">
  تصفح المتاجر
</x-button>
```

مثال Badge component:

```blade
<x-badge variant="featured">مميز</x-badge>
```

## 16. ملاحظات Tailwind CSS v4

الحالة الحالية:

- الصفحات تستخدم Tailwind CSS v4 عبر browser CDN لأغراض التصميم والنمذجة.

عند التحويل إلى Laravel:

- استخدم Vite + Tailwind CSS v4.
- انقل تهيئة الخطوط والألوان إلى ملف CSS الرئيسي.
- استخرج التكرار إلى Blade components.
- حوّل الألوان المتكررة إلى `@theme` tokens.

مثال مقترح:

```css
@theme {
  --color-brand-primary: #2563EB;
  --color-brand-secondary: #16A34A;
  --color-brand-accent: #EA580C;
  --color-brand-bg: #F8FAFC;
}
```

ثم يمكن استخدام:

```html
<button class="bg-brand-primary text-white">
  حفظ
</button>
```

## 17. قواعد Do / Don't

### Do

- حافظ على البساطة.
- استخدم تسميات عربية واضحة.
- اجعل CTA الأساسي واضحاً.
- حافظ على spacing ثابت بين الأقسام.
- استخدم `rounded-2xl`, `shadow-sm`, `border-slate-200`.
- حضر الكود للتحويل إلى Blade components.
- اختبر الهاتف أولاً.

### Don't

- لا تضف ألواناً عشوائية خارج النظام.
- لا تستخدم مكتبات أيقونات بدون حاجة.
- لا تكدس البطاقات بمعلومات كثيرة.
- لا تكسر RTL.
- لا تستخدم ظلالاً قوية أو تأثيرات زجاجية.
- لا تستخدم gradients كثيرة أو neon effects.
- لا تجعل الإجراءات المهمة غير واضحة.
