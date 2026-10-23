# Architecture — RaedApp

High-level architecture of **RaedApp**, a multi-tenant SaaS school-management platform
(SMS) for schools in Djibouti / French-speaking Africa. Formerly "ScolApp".

> Companion docs: [design.md](design.md) · [frontend.md](frontend.md) ·
> [backend.md](backend.md) · [structure.md](structure.md) · [CLAUDE.md](CLAUDE.md)

## Stack
- **PHP 8.2+** (prod runs 8.4), **Laravel 12** (slim skeleton — config in `bootstrap/app.php`, no `app/Http/Kernel.php`).
- **Livewire 4 + Volt** — pages are single-file Volt components (`.blade.php` with a `<?php use Livewire\Volt\Component; new class … ?>` header). **No `app/Livewire/` dir.**
- **Mary UI** (`robsontenorio/mary`) + **Tailwind CSS 4** + **DaisyUI**, compiled via **Vite**.
- **spatie/laravel-permission** (RBAC), **spatie/laravel-activitylog** (audit), **spatie/laravel-medialibrary**.
- **barryvdh/laravel-dompdf** (PDF), **maatwebsite/excel** (XLSX), **laravel/sanctum** (API).
- DB: **SQLite** locally (default), **MySQL 8 (Docker)** in production. Queue / cache / sessions use the DB driver.

## Multi-tenancy (critical)
Every tenant-owned model has a `school_id`. The `App\Traits\BelongsToSchool` trait:
- auto-fills `school_id` from `auth()->user()->school_id` on create;
- provides a `forSchool($id?)` scope (defaults to current user's school).

**There is NO global tenant scope** — queries are *not* auto-filtered. Always scope tenant
data yourself (`->forSchool()` / `->where('school_id', $sid)`). Volt components usually read
`auth()->user()->school_id` directly.

`EnsureSchoolIsActive` middleware (alias `school.active`) gates authenticated routes: blocks
blocked users, logs out users with no school, redirects on suspended school (`is_active=false`)
or expired subscription (`hasValidSubscription()`). **Super-admin bypasses everything** via
`Gate::before` in `AppServiceProvider`.

## Roles & portals
Defined in `database/seeders/RolePermissionSeeder.php` (authoritative map). 9 roles → portals:
- `super-admin` → `/platform` (SaaS operator; all abilities via `Gate::before`)
- `admin`, `director`, `accountant` → `/admin` (school admin panel; `can:` gated per section)
- `teacher` → `/teacher`, `monitor` → `/monitor`, `guardian` → `/guardian`,
  `student` → `/student`, `caissier` → `/caissier`
- `User::portalRoute()` maps a role to its home dashboard (used by the login redirect).
- Portal roles are blocked from `/admin` by `role:` middleware (except `caissier`, which keeps `invoices.*`/`payments.*`/`billing.view`).

## Request lifecycle / middleware
- Global web: `SetLocale` (resolves fr/en/ar from session → `User::$ui_lang` → config).
- Route guards: `auth`, `school.active`, `role:…`, `can:…` (Spatie).
- CSRF-exempt: `webhooks/billing` (see `bootstrap/app.php`).

## Integrations
- **D-Money / Billing API** — `config/billing.php`, `App\Services\BillingApiService`, `App\Models\DmoneyTransaction`. Gateway host from `BILLING_API_URL` (default `api.raedapp.com`). Create payment → poll notify. Gated by `DMONEY_ENABLED`. Webhook `POST /webhooks/billing` (verified via `BILLING_WEBHOOK_SECRET`).
- **WhatsApp** — `App\Services\WhatsAppService` + `App\Channels\WhatsAppChannel` (custom `whatsapp` notification channel). OpenWA-style gateway via `OPENWA_*` env. **Production gateway: `https://wa.sahansolution.com/api`** (same shape as OpenWA). See [backend.md](backend.md).
- **Email** — Mailables in `app/Mail/`, Blade in `resources/views/emails/`. Prod SMTP: **Hostinger** (`smtp.hostinger.com:465`, auth as `contact@raedapp.tech`, from `noreply@raedapp.tech`). SPF+DKIM+DMARC configured on the domain.
- **Scheduled tasks** — `tasks:dispatch` runs every minute (`routes/console.php`), powers the `ScheduledTask` system (recurring automated notifications).

## Deployment (production)
- **Server (VPS):** `root@187.124.32.203` (Ubuntu 24.04, Hostinger). App at `/var/www/raedapp`.
- **Domain:** `https://raedapp.tech` (A record `@` → `187.124.32.203`; `www` CNAME → root). HTTPS via Let's Encrypt (`certbot --nginx`, auto-renew).
- **Web:** nginx vhost `/etc/nginx/sites-available/raedapp.tech` → root `/var/www/raedapp/public`, PHP-FPM **`php8.4-fpm.sock`** (composer deps require ≥ 8.4; the box also has 8.3-fpm for other sites).
- **Database:** **MySQL 8 in Docker** (not SQLite) — `docker-compose.yml` in project root, container `raedapp-db`, bound to `127.0.0.1:3307`, DB/user `raedapp`, data in named volume. Laravel on host connects via `pdo_mysql` (installed `php8.4-mysql`).
- **Queue worker:** systemd unit `raedapp-queue.service` running `php8.4 artisan queue:work` as `www-data` (required — most notifications are `ShouldQueue`).
- **Deploy flow:** `git pull && composer install --no-dev -o && npm run build && php artisan migrate --force && php artisan optimize && chown -R www-data:www-data storage bootstrap/cache`.
- **Repos:** `origin` = `github.com/AminHassanDouale/scolapp_v2` (old), `raedapp` = `github.com/AminHassanDouale/RaedApp` (current, `main`).

### Deployment gotchas (learned)
- Deploy commands run as **root** → re-`chown www-data` `storage` + `bootstrap/cache` or the app 500s.
- The vhost must point at **php8.4-fpm** (8.3 triggers Composer "requires ≥ 8.4").
- Docker MySQL only applies env passwords on **first volume init** — a password mismatch needs `docker compose down -v` to re-init.
- `public/hot` (stale Vite dev-server pointer) breaks asset loading → delete it to serve the built assets.
