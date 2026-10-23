# Structure — RaedApp

Directory map and where things live. See [backend.md](backend.md) / [frontend.md](frontend.md)
for detail.

## Top level
```
RaedApp/
├── app/                     # PHP (see below)
├── bootstrap/app.php         # Laravel 12 config: middleware, routing, CSRF exemptions
├── config/                   # app, auth, billing, mail, services, permission, sanctum, …
├── database/
│   ├── migrations/           # schema (driver-aware where destructive)
│   ├── seeders/              # DatabaseSeeder + PetitsFutesSeeder + per-domain seeders
│   ├── factories/
│   └── database.sqlite       # local DB (gitignored)
├── lang/{fr,en,ar}/          # i18n (nav + enums translated in all 3; fr is complete)
├── public/
│   ├── images/logoraedapp.png        # brand logo (swap to rebrand)
│   ├── build/                        # Vite output (gitignored, deploy-time)
│   ├── robots.txt, sitemap.xml, llms.txt
│   └── google06ceb00644acfa96.html   # Google Search Console verification
├── resources/
│   ├── css/app.css           # Tailwind 4 + DaisyUI + brand theme + motion system
│   ├── js/app.js             # page-enter re-trigger on wire:navigate
│   └── views/                # Blade (see below)
├── routes/{web,api,console}.php
├── docker-compose.yml        # prod MySQL 8 container (created on server)
├── architecture.md design.md frontend.md backend.md structure.md CLAUDE.md
└── composer.json / package.json / vite.config.js / phpunit.xml
```

## `app/`
```
app/
├── Actions/          # single-purpose writes (RecordPayment, CreateEnrollment, …) — 6
├── Channels/         # WhatsAppChannel (custom `whatsapp` notification channel)
├── Console/Commands/ # tasks:dispatch, ProvisionSchool, TestWhatsApp, …
├── Enums/            # InvoiceStatus, PaymentStatus, … — 15
├── Exports/          # Excel exports (Tasks/Sheets)
├── Http/
│   ├── Controllers/  # Api/, Finance/, DMoneyPayment, Webhook, Contact (non-Livewire only)
│   └── Middleware/   # EnsureSchoolIsActive (school.active), SetLocale
├── Mail/             # Mailables
├── Models/           # Eloquent — 41
├── Notifications/    # 5 (mail/database/whatsapp)
├── Providers/        # AppServiceProvider (Gate::before, singletons, whatsapp channel), VoltServiceProvider
├── Services/         # InvoiceService, WhatsAppService, BillingApiService, … — 7
└── Traits/           # BelongsToSchool, HasUuid, HasReference, Auditable, HasAttachments
```
**No `app/Livewire/`** — pages are single-file Volt components under `resources/views/livewire/`.

## `resources/views/`
```
views/
├── welcome.blade.php          # PUBLIC LANDING — standalone CDN Tailwind v3 + Alpine (NOT the build)
├── layouts/                   # app, platform, teacher, monitor, guardian, student, caissier, guest, empty
├── livewire/
│   ├── admin/                 # /admin panel: academic/, students/, teachers/, guardians/,
│   │                          #   enrollments/, attendance/, timetable/, assessments/,
│   │                          #   report-cards/, finance/, announcements/, messages/, reports/,
│   │                          #   scheduled-tasks/, settings/, billing/, dashboard/
│   ├── platform/              # /platform super-admin (schools, users, plans, settings)
│   ├── portals/               # teacher/ monitor/ guardian/ student/ caissier/
│   ├── profile/               # profile pages per role
│   └── pages/auth/            # login, register (Volt routes)
├── emails/                    # email templates (payment, tasks, contact-confirmation)
├── exports/                   # PDF/XLSX blade (invoices, payments receipt)
└── pdf/, errors/, components/, payment/
```
Views mirror the route tree in `routes/web.php`. Models referenced by `{uuid}`.

## Key config files
- `bootstrap/app.php` — middleware aliases (`role`, `permission`, `school.active`), CSRF exempt `webhooks/billing`, redirect logic.
- `config/billing.php` — D-Money gateway (`BILLING_API_URL`).
- `config/services.php` — `openwa.*` (WhatsApp), `google.analytics_id` (GA4).
- `config/app.php` — locale/fallback = `fr`.
- `resources/css/app.css` — brand DaisyUI theme override + motion system.

## Commands
```
composer dev      # server + queue + pail + vite
composer setup    # first-time install
composer test     # PHPUnit (tests/Feature + tests/Unit)
php artisan migrate:fresh --seed
npm run dev / build
./vendor/bin/pint
php artisan tasks:dispatch
```
