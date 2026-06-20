# COMPONENT INVENTORY

مشروع: **Ask Qalqilya - اسأل قلقيلية**  
المرجع الأساسي: [DESIGN-SYSTEM.md](./DESIGN-SYSTEM.md)

هذا المستند يحصر مكونات الواجهة القابلة لإعادة الاستخدام قبل تحويل صفحات HTML إلى Laravel Blade components. الهدف منه مساعدة فريق التطوير على معرفة ما يجب بناؤه، أين يستخدم، ما الخصائص المطلوبة، وما أولوية التنفيذ.

## ملخص المكونات

| التصنيف | عدد المكونات | الأولوية العامة |
| --- | ---: | --- |
| Core UI Components | 4 | Critical |
| Navigation Components | 6 | Critical |
| Search Components | 2 | Critical / High |
| Business Components | 4 | Critical / High |
| Job Components | 3 | Critical / Medium |
| Category Components | 3 | High / Medium |
| Dashboard Components | 6 | Critical / High |
| Admin Components | 5 | Critical / High |
| Pagination Components | 1 | Critical |

إجمالي المكونات المقترحة: **34 مكوناً**

## 1. Core UI Components

### Button Component

| البند | التفاصيل |
| --- | --- |
| Purpose | نظام أزرار موحد في كامل المنصة |
| Blade Name | `x-button` |
| Priority | **Critical** |

Props:

- `variant`
- `size`
- `href`
- `type`
- `disabled`
- `loading`

Variants:

- `primary`
- `secondary`
- `success`
- `warning`
- `outline`

Used In:

- Homepage
- Search
- Stores
- Jobs
- Dashboards
- Auth pages

ملاحظات:

- إذا تم تمرير `href` يتم إخراج `<a>`.
- إذا لم يتم تمرير `href` يتم إخراج `<button>`.
- يجب الحفاظ على focus states من نظام التصميم.

مثال:

```blade
<x-button variant="primary" href="{{ route('stores.index') }}">
  تصفح المتاجر
</x-button>
```

---

### Badge Component

| البند | التفاصيل |
| --- | --- |
| Purpose | شارات الحالة والتصنيف والتمييز |
| Blade Name | `x-badge` |
| Priority | **Critical** |

Props:

- `variant`
- `size`

Variants:

- `featured`
- `active`
- `pending`
- `verified`
- `status`
- `category`

Used In:

- Business cards
- Job cards
- Store profile
- Category page
- Business dashboard
- Admin dashboard

مثال:

```blade
<x-badge variant="featured">مميز</x-badge>
```

---

### Card Component

| البند | التفاصيل |
| --- | --- |
| Purpose | حاوية موحدة للبطاقات والأقسام |
| Blade Name | `x-card` |
| Priority | **Critical** |

Props:

- `title`
- `description`
- `padding`
- `shadow`
- `as`

Used In:

- Public pages
- Business cards wrapper
- Dashboard widgets
- Auth cards

ملاحظات:

- الافتراضي: `rounded-2xl border border-slate-200 bg-white p-5 shadow-sm`
- يمكن استخدام `as="section"` أو `as="article"` حسب السياق الدلالي.

---

### Alert Component

| البند | التفاصيل |
| --- | --- |
| Purpose | رسائل التنبيه والثقة والحالات المهمة |
| Blade Name | `x-alert` |
| Priority | **High** |

Props:

- `variant`
- `title`
- `description`
- `actionText`
- `actionHref`

Variants:

- `info`
- `warning`
- `success`
- `danger`

Used In:

- Search trust message
- Category trust message
- Business dashboard alert
- Admin dashboard alert
- Auth validation placeholders

---

## 2. Navigation Components

### Navbar

| البند | التفاصيل |
| --- | --- |
| Blade | `partials/navbar.blade.php` |
| Used In | All public pages |
| Priority | **Critical** |

Pages:

- `index`
- `stores`
- `store`
- `search`
- `category`
- `jobs`
- `job-single`

Props / Data:

- `active`
- `showAuthLinks`
- `showBusinessCta`

---

### Footer

| البند | التفاصيل |
| --- | --- |
| Blade | `partials/footer.blade.php` |
| Priority | **Critical** |

Used In:

- All public pages
- Auth pages if needed

---

### Mobile Bottom Navigation

| البند | التفاصيل |
| --- | --- |
| Blade | `partials/mobile-nav.blade.php` |
| Priority | **High** |

Props:

- `active`

Items:

- الرئيسية
- الأعمال
- البحث
- الوظائف
- الحساب

---

### Dashboard Sidebar

| البند | التفاصيل |
| --- | --- |
| Blade | `partials/dashboard-sidebar.blade.php` |
| Priority | **Critical** |

Used In:

- `business-dashboard`

Props:

- `business`
- `active`

---

### Admin Sidebar

| البند | التفاصيل |
| --- | --- |
| Blade | `partials/admin-sidebar.blade.php` |
| Priority | **Critical** |

Used In:

- `admin-dashboard`

Props:

- `active`
- `role`

---

### Topbar

| البند | التفاصيل |
| --- | --- |
| Blade | `partials/topbar.blade.php` |
| Priority | **Critical** |

Used In:

- Business dashboard
- Admin dashboard

Props:

- `title`
- `subtitle`
- `badge`
- `actionText`
- `actionHref`
- `mobileMenuLabel`

---

## 3. Search Components

### Search Form

| البند | التفاصيل |
| --- | --- |
| Blade | `x-search-form` |
| Priority | **Critical** |

Props:

- `placeholder`
- `category`
- `area`
- `buttonText`
- `variant`

Used In:

- Homepage
- Search Page
- Category Page
- Stores Page
- Jobs Page

ملاحظات:

- يجب أن يدعم RTL.
- يجب أن تكون labels متاحة لقارئات الشاشة.
- حقول البحث الكبيرة في الصفحة الرئيسية هي التجربة الأساسية.

---

### Filter Chips

| البند | التفاصيل |
| --- | --- |
| Blade | `x-filter-chip` |
| Priority | **High** |

Props:

- `active`
- `label`
- `href`

Used In:

- Search filters
- Jobs filters
- Category filters
- Mobile dashboard navigation

---

## 4. Business Components

### Business Card

| البند | التفاصيل |
| --- | --- |
| Blade | `x-business-card` |
| Priority | **Critical** |

Props:

- `name`
- `category`
- `rating`
- `reviews`
- `status`
- `image`
- `location`
- `description`
- `featured`
- `href`
- `phoneHref`
- `directionsHref`

Used In:

- `stores`
- `search`
- `category`
- related businesses
- similar businesses

ملاحظات:

- يجب أن يدعم تخطيط أزرار مختلف على الهاتف لزيادة دقة اللمس.
- placeholder الصورة يبقى اختيارياً حتى تتوفر صور حقيقية.

---

### Business Hero

| البند | التفاصيل |
| --- | --- |
| Blade | `x-business-hero` |
| Used In | `store.html` |
| Priority | **High** |

Props:

- `business`
- `coverImage`
- `logo`
- `rating`
- `verified`
- `status`
- `address`
- `lastUpdated`

---

### Business Gallery

| البند | التفاصيل |
| --- | --- |
| Blade | `x-business-gallery` |
| Priority | **Medium** |

Props:

- `images`
- `featuredLayout`

Used In:

- `store`
- `business-dashboard`

---

### Business Reviews

| البند | التفاصيل |
| --- | --- |
| Blade | `x-business-reviews` |
| Priority | **High** |

Props:

- `rating`
- `reviewsCount`
- `reviews`
- `showWriteButton`

Used In:

- `store`
- `business-dashboard`
- `admin-dashboard`

---

## 5. Job Components

### Job Card

| البند | التفاصيل |
| --- | --- |
| Blade | `x-job-card` |
| Priority | **Critical** |

Props:

- `title`
- `company`
- `salary`
- `salaryNote`
- `location`
- `employmentType`
- `experience`
- `postedAt`
- `expiresAt`
- `featured`
- `href`
- `applyHref`

Used In:

- `jobs`
- `search`
- `job-single`
- similar jobs
- dashboard jobs widgets

---

### Job Hero

| البند | التفاصيل |
| --- | --- |
| Blade | `x-job-hero` |
| Priority | **Medium** |

Used In:

- `job-single`

Props:

- `job`
- `featured`
- `applicationStatus`

---

### Similar Jobs

| البند | التفاصيل |
| --- | --- |
| Blade | `x-similar-jobs` |
| Priority | **Medium** |

Props:

- `jobs`
- `title`

Used In:

- `job-single`

---

## 6. Category Components

### Category Card

| البند | التفاصيل |
| --- | --- |
| Blade | `x-category-card` |
| Priority | **High** |

Props:

- `title`
- `description`
- `count`
- `href`
- `variant`

Used In:

- Homepage
- Search
- Category related sections

---

### Category Hero

| البند | التفاصيل |
| --- | --- |
| Blade | `x-category-hero` |
| Priority | **Medium** |

Props:

- `title`
- `description`
- `stats`
- `lastUpdated`

Used In:

- `category`

---

### Related Categories

| البند | التفاصيل |
| --- | --- |
| Blade | `x-related-categories` |
| Priority | **Medium** |

Props:

- `categories`

Used In:

- `category`
- `search`

---

## 7. Dashboard Components

### Stat Card

| البند | التفاصيل |
| --- | --- |
| Blade | `x-stat-card` |
| Priority | **Critical** |

Props:

- `label`
- `value`
- `note`
- `variant`

Used In:

- Business dashboard
- Admin dashboard

---

### Profile Completion

| البند | التفاصيل |
| --- | --- |
| Blade | `x-profile-completion` |
| Priority | **High** |

Props:

- `percentage`
- `items`
- `missingItems`
- `actionHref`

Used In:

- Business dashboard

---

### Quick Actions

| البند | التفاصيل |
| --- | --- |
| Blade | `x-quick-actions` |
| Priority | **High** |

Props:

- `actions`
- `title`

Used In:

- Business dashboard
- Admin dashboard

---

### Subscription Card

| البند | التفاصيل |
| --- | --- |
| Blade | `x-subscription-card` |
| Priority | **High** |

Props:

- `plan`
- `status`
- `expiresAt`
- `currentFeatures`
- `upgradeFeatures`
- `upgradeHref`

Used In:

- Business dashboard

---

### Activity Log

| البند | التفاصيل |
| --- | --- |
| Blade | `x-activity-log` |
| Priority | **Medium** |

Props:

- `items`
- `title`

Used In:

- Admin dashboard
- Future business dashboard history

---

### Data Quality Card

| البند | التفاصيل |
| --- | --- |
| Blade | `x-data-quality-card` |
| Priority | **Medium** |

Props:

- `items`
- `actionHref`

Used In:

- Admin dashboard

---

## 8. Admin Components

### Store Approval Queue

| البند | التفاصيل |
| --- | --- |
| Blade | `x-store-approval-queue` |
| Priority | **Critical** |

Props:

- `stores`
- `showGuidance`

Used In:

- Admin dashboard

Actions:

- قبول
- رفض
- عرض

---

### Featured Stores Widget

| البند | التفاصيل |
| --- | --- |
| Blade | `x-featured-stores-widget` |
| Priority | **High** |

Props:

- `stores`
- `count`
- `actionHref`

Used In:

- Admin dashboard

---

### Jobs Moderation Widget

| البند | التفاصيل |
| --- | --- |
| Blade | `x-jobs-moderation-widget` |
| Priority | **High** |

Props:

- `jobs`
- `activeCount`
- `pendingCount`

Actions:

- اعتماد
- رفض
- عرض

---

### Reviews Reports Widget

| البند | التفاصيل |
| --- | --- |
| Blade | `x-reviews-reports-widget` |
| Priority | **High** |

Props:

- `reviews`
- `reportedCount`

Actions:

- إخفاء
- إبقاء
- مراجعة

---

### Platform Health Widget

| البند | التفاصيل |
| --- | --- |
| Blade | `x-platform-health-widget` |
| Priority | **Medium** |

Props:

- `status`
- `message`
- `lastSync`

Used In:

- Admin dashboard

---

## 9. Pagination Components

### Pagination

| البند | التفاصيل |
| --- | --- |
| Blade | `x-pagination` |
| Priority | **Critical** |

Props:

- `paginator`
- `currentPage`
- `totalPages`
- `baseUrl`

Used In:

- `stores`
- `jobs`
- `category`

ملاحظات:

- يجب دعم RTL.
- يجب أن تكون روابط الصفحات قابلة للوصول بلوحة المفاتيح.
- استخدم `aria-current="page"` للصفحة الحالية.

---

## 10. Laravel Build Order

### Phase 1: Layouts

الأولوية: **Critical**

- `layouts/public-layout.blade.php`
- `layouts/auth-layout.blade.php`
- `layouts/dashboard-layout.blade.php`
- `layouts/admin-layout.blade.php`

الهدف:

- تثبيت `html lang="ar" dir="rtl"`.
- تحميل الخطوط وملف CSS.
- تجهيز slots للمحتوى والـ title والـ meta.

### Phase 2: Partials

الأولوية: **Critical**

- `partials/navbar.blade.php`
- `partials/footer.blade.php`
- `partials/mobile-nav.blade.php`
- `partials/dashboard-sidebar.blade.php`
- `partials/admin-sidebar.blade.php`
- `partials/topbar.blade.php`

### Phase 3: Core UI Components

الأولوية: **Critical**

- `x-button`
- `x-badge`
- `x-card`
- `x-alert`
- `x-pagination`

سبب البدء بها:

- تستخدم في كل الصفحات تقريباً.
- تقلل تكرار Tailwind classes مبكراً.

### Phase 4: Business Components

الأولوية: **Critical / High**

- `x-business-card`
- `x-business-hero`
- `x-business-gallery`
- `x-business-reviews`

### Phase 5: Job Components

الأولوية: **Critical / Medium**

- `x-job-card`
- `x-job-hero`
- `x-similar-jobs`

### Phase 6: Dashboard Components

الأولوية: **Critical / High**

- `x-stat-card`
- `x-profile-completion`
- `x-quick-actions`
- `x-subscription-card`
- `x-activity-log`
- `x-data-quality-card`

### Phase 7: Admin Components

الأولوية: **Critical / High**

- `x-store-approval-queue`
- `x-featured-stores-widget`
- `x-jobs-moderation-widget`
- `x-reviews-reports-widget`
- `x-platform-health-widget`

### Phase 8: Page Conversion

حوّل الصفحات بهذا الترتيب:

1. `index`
2. `stores`
3. `store`
4. `search`
5. `category`
6. `jobs`
7. `job-single`
8. `login`
9. `register`
10. `business-dashboard`
11. `admin-dashboard`

## مصفوفة الأولويات

| Priority | معنى الأولوية | أمثلة |
| --- | --- | --- |
| **Critical** | يجب بناؤه أولاً لأنه مستخدم على نطاق واسع أو يؤثر على تحويل معظم الصفحات | Button, Badge, Card, Navbar, Business Card, Job Card |
| **High** | مهم لتجربة المستخدم أو صفحات رئيسية محددة | Alert, Mobile Nav, Business Reviews, Profile Completion |
| **Medium** | مفيد وقابل لإعادة الاستخدام لكن يمكن بناؤه بعد المكونات الأساسية | Gallery, Similar Jobs, Activity Log, Platform Health |

## ملاحظات تنفيذية

- لا تبدأ بتحويل الصفحات قبل بناء layouts والـ partials الأساسية.
- استخرج الألوان والتباعد والـ radius من `DESIGN-SYSTEM.md`.
- لا تنقل HTML كما هو فقط؛ الهدف هو تقليل التكرار عبر Blade props وslots.
- حافظ على Arabic labels داخل المكونات، واجعل النصوص قابلة للتمرير كـ slots عند الحاجة.
- كل مكون تفاعلي يجب أن يحافظ على focus state.
- أي مكون يعرض روابط حالية يجب أن يدعم `aria-current`.
- كل مكونات القوائم والجداول يجب أن تراعي mobile-first وتحول الجدول إلى بطاقات عند الحاجة.
