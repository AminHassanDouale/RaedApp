# CLAUDE.md

Guidance for working in this repository. Read this first.

## What this is

**RaedApp** — a multi-tenant SaaS **school management platform** (SMS) for schools in
Djibouti / French-speaking regions. One Laravel app serves many schools; the UI is in
**French** (routes, labels, UI strings), with locale switching for `fr` / `en` / `ar`.

Formerly branded "ScolApp" (the billing API and seed emails still use `scolapp.com`).

## Stack

- **PHP 8.2+**, **Laravel 12** (slim skeleton — no `app/Http/Kernel.php`; config lives in `bootstrap/app.php`)
- **Livewire 4** + **Volt** — pages are **single-file Volt components** (`.blade.php` with a `<?php use Livewire\Volt\Component; new class extends Component {...} ?>` header). There is **no `app/Livewire/` directory.**
- **Mary UI** (`robsontenorio/mary`) components + **Tailwind CSS 4** + **DaisyUI** (via Vite)
- **spatie/laravel-permission** (RBAC), **spatie/laravel-activitylog** (audit), **spatie/laravel-medialibrary**
- **barryvdh/laravel-dompdf** (PDFs), **maatwebsite/excel** (XLSX exports), **laravel/sanctum** (API)
- SQLite by default (`DB_CONNECTION=sqlite`); database driver for queue / cache / sessions

## Commands

```bash
composer dev          # runs server + queue + pail (logs) + vite concurrently — the main dev loop
composer setup        # install + key:gen + migrate + npm install + build (first-time)
composer test         # config:clear then artisan test (PHPUnit; tests/Feature + tests/Unit)
php artisan migrate:fresh --seed   # rebuild DB with full demo data
npm run dev / build   # vite
./vendor/bin/pint     # code style (Laravel Pint) — run before committing PHP
php artisan tasks:dispatch         # fire due ScheduledTasks (scheduled every minute)
```

Tests use PHPUnit (not Pest, despite the pest plugin allow entry). Default test DB is in-memory SQLite (`phpunit.xml`).

## Architecture & conventions

### Multi-tenancy (critical)
Every tenant-owned model carries a `school_id`. The `App\Traits\BelongsToSchool` trait:
- auto-fills `school_id` from `auth()->user()->school_id` on create, and
- provides a `forSchool($id?)` query scope (defaults to the current user's school).

**There is no global tenant scope** — queries are *not* auto-filtered. When writing queries,
you must scope by school yourself (`->forSchool()` or `->where('school_id', $sid)`). Volt
components typically read `auth()->user()->school_id` directly. Always scope tenant data.

`EnsureSchoolIsActive` middleware (alias `school.active`) gates authenticated routes: blocks
blocked users, logs out users with no school, and redirects when the school is suspended
(`is_active=false`) or the subscription is expired (`hasValidSubscription()`). Super-admin bypasses all of this.

### Roles, permissions & portals
Defined in `database/seeders/RolePermissionSeeder.php` (read it for the authoritative map).

- **`super-admin`** — SaaS platform operator. `Gate::before` in `AppServiceProvider` grants
  it **all abilities** (no permission needed). Lives under `/platform`.
- **School-level** (admin panel `/admin`): `admin`, `director`, `accountant`.
- **Portal roles** (each has its own route prefix, layout, and dashboard):
  `teacher` → `/teacher`, `monitor` → `/monitor`, `guardian` → `/guardian`,
  `student` → `/student`, `caissier` → `/caissier`.

Routes are gated by `role:` and `can:` middleware (Spatie). Each `/admin` section guards with a
permission like `can:students.view`. `User::portalRoute()` maps a role to its home dashboard
(used by the login redirect). Portal roles are blocked from `/admin` by role middleware, so they
don't carry admin permissions (except `caissier`, which keeps `invoices.*`/`payments.*`/`billing.view`).

### Layout per portal
Each portal has a dedicated Blade layout in `resources/views/layouts/`
(`app`, `platform`, `teacher`, `monitor`, `guardian`, `student`, `caissier`, `guest`, `empty`).
Volt components declare theirs with `#[Layout('layouts.app')]`.

### Code organization (`app/`)
- **`Models/`** — Eloquent models. Shared traits in `app/Traits/`: `BelongsToSchool`, `HasUuid`
  (public `uuid` for route keys), `HasReference` (human reference codes), `Auditable` (activitylog),
  `HasAttachments`. Routes use `{uuid}`, not auto-increment ids.
- **`Enums/`** — PHP enums for statuses/types (e.g. `InvoiceStatus`, `PaymentStatus`,
  `AttendanceStatus`, `EnrollmentStatus`, `ReportCardStatus`). Prefer these over magic strings.
- **`Actions/`** — single-purpose write operations (`RecordPaymentAction`, `CreateEnrollmentAction`,
  `GenerateReportCardAction`, `SyncDmoneyPayment`, …). Wired as singletons in `AppServiceProvider`.
- **`Services/`** — domain services (`InvoiceService`, `AttendanceService`, `ReportCardService`,
  `EnrollmentService`, `BillingApiService`, `WhatsAppService`, `CredentialsNotifier`).
- **`Http/Controllers/`** — only for non-Livewire flows: PDF/XLSX exports (`Finance/`), receipts,
  D-Money payment callbacks, webhooks, contact form, and the Sanctum API (`Api/AuthController`).
- **`Notifications/`** + **`Channels/WhatsAppChannel`** — a custom `whatsapp` notification channel
  (registered in `AppServiceProvider::boot`). `User::routeNotificationForWhatsApp()` resolves the
  number, bridging to the linked `Guardian` record for parent portal accounts.
- **`Console/Commands/`** — `tasks:dispatch` (runs every minute, powers the ScheduledTask system),
  `ProvisionSchool`, `SeedSchoolAcademics`, `SeedSchoolTestUsers`, `TestWhatsApp`.

### Volt component shape
```php
<?php
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.app')] class extends Component {
    public function mount(): void { /* ... */ }
    public function with(): array { /* data passed to the view, scoped by school_id */ }
}
?>
<div> {{-- Mary UI + Tailwind/DaisyUI markup --}} </div>
```
Views mirror the route tree under `resources/views/livewire/{admin,platform,portals,profile,pages}/`.

## Integrations

- **D-Money / Billing API** (`config/billing.php`, `BillingApiService`, `app/Models/DmoneyTransaction`):
  payment gateway at `api.scolapp.com`. Create payment → poll notify endpoint for status.
  Gated by `DMONEY_ENABLED`. Guardian portal pays invoices through it; callbacks at
  `/guardian/paiement/{succes,annule}`.
- **Webhook** `POST /webhooks/billing` — **CSRF-exempt** (see `bootstrap/app.php`), verified via
  `BILLING_WEBHOOK_SECRET`. Handled by `WebhookController`.
- **WhatsApp** via OpenWA gateway (`OPENWA_*` env, `WhatsAppService`). Used for notifications.
- **Email** — Mailables in `app/Mail/`, Blade templates in `resources/views/emails/`.

## Domain model (high level)

School → AcademicYear → AcademicCycle → Grade → SchoolClass. Students enroll (`Enrollment`) into a
class for a year; Guardians link to Students. Finance: `FeeSchedule`/`FeeItem` → `StudentFeePlan`
→ `Invoice` → `Payment` (+ `PaymentAllocation`, `PaymentFollowup`) / `Expense`. Academics:
`Subject`, `Assessment` → `StudentScore` → `ReportCard` (+ subjects, approval workflow, templates).
Attendance: `AttendanceSession` → `AttendanceEntry`. Timetable: `TimetableTemplate`/`TimetableEntry`
/`TimetableOverride`, `Room`. Comms: `Announcement`, `Message`/`MessageThread`/`MessageRecipient`,
`CarnetEntry`. Plus `ScheduledTask` (recurring automated notifications).

## Local demo data

`php artisan migrate:fresh --seed` creates "École Démo RaedApp" (pro plan) with test logins
(all password `password`): `admin@scolapp.com` (super-admin), `directeur@scolapp.com` (admin),
`proviseur@scolapp.com` (director), `comptable@scolapp.com` (accountant),
`caissier@scolapp.com`, `surveillant@scolapp.com`, plus generated teacher/guardian/student
accounts (see the table printed at the end of `DatabaseSeeder`).

## Conventions to follow

- **French** for all user-facing strings, route segments (`/eleves`, `/factures`, `/emploi-du-temps`), and labels.
- Scope every tenant query by `school_id`. Never trust an unscoped `Model::find()` for tenant data.
- Use existing Enums and Actions/Services rather than inlining business logic in Volt components.
- Reference models in routes/links by `uuid`.
- Run `./vendor/bin/pint` before committing.
