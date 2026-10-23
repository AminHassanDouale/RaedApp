# Frontend — RaedApp

How the UI is built. See [design.md](design.md) for the visual system, [backend.md](backend.md)
for data, [structure.md](structure.md) for where files live.

## Two distinct frontends (important)
1. **The app** (authenticated portals) — **Livewire 4 Volt** components + **Mary UI** + **Tailwind 4 + DaisyUI**, compiled by **Vite** (`resources/css/app.css`, `resources/js/app.js`). This is the real build.
2. **The public landing** — `resources/views/welcome.blade.php` (route `/`). **Standalone page using CDN Tailwind v3 + Alpine** with its own inline `<style>`/`<script>`. It does **NOT** use the Vite build, DaisyUI, Mary UI, or the app's Tailwind 4 config. **Edit its inline CSS/JS directly** — the app's utility classes/tokens don't apply there. ⚠️ Classic trap.

## Volt component shape
```php
<?php
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
new #[Layout('layouts.app')] class extends Component {
    public function mount(): void { /* ... */ }
    public function with(): array { /* data for the view, scoped by school_id */ }
}
?>
<div> {{-- Mary UI + Tailwind/DaisyUI markup --}} </div>
```
Views mirror the route tree under `resources/views/livewire/{admin,platform,portals,profile,pages}/`.
Routes reference models by **`uuid`**, not auto-increment id.

## Layouts (per portal)
`resources/views/layouts/`: `app` (admin), `platform`, `teacher`, `monitor`, `guardian`,
`student`, `caissier`, `guest` (login/register split-screen), `empty` (print/PDF).
All carry the **FR/EN/ع language switcher** + dynamic `dir` (RTL for `ar`). The `guest` layout
has a top-right switcher; `empty` has `dir` for Arabic invoice prints.

## i18n
- **French is the default** (`config/app.php` locale/fallback = `fr`; `users.ui_lang` defaults `fr`).
- Switch fr / en / ar (Arabic = RTL) via `route('locale.switch', $code)` → saved to `User::$ui_lang`, resolved per request by `SetLocale` middleware.
- Lang files in `lang/{fr,en,ar}/`. **Navigation + enums are fully translated in all 3** (97 nav keys each). Most body text is **hardcoded French by design** — switching EN/AR flips direction + menu + enums, not hardcoded copy.

## Motion system (app build)
`resources/css/app.css`: `@theme` ease/duration tokens, `[data-page]` page-enter, `.stagger`,
`.btn` press, `.hover-lift`, brand focus rings, and a global `prefers-reduced-motion` guard.
`resources/js/app.js`: re-triggers `[data-page]` on `livewire:navigated`. See [design.md](design.md).

## Build & assets
- `composer dev` — server + queue + pail + vite concurrently (main dev loop).
- `npm run dev` / `npm run build` — Vite. **Rebuild after editing `app.css`/`app.js`** (the compiled hash changes; `public/build` is gitignored and is a deploy-time artifact).
- **Gotcha:** a stale `public/hot` file points `@vite` at a dead dev server → all CSS/JS 404. Delete it to serve the production build.
- The landing (`welcome.blade.php`) is CDN-rendered → **no build needed** for landing changes.

## Landing page specifics
- Head has full **SEO**: meta/keywords/canonical/hreflang, Open Graph, Twitter, **JSON-LD** (`Organization` + `SoftwareApplication` + `FAQPage`), and **GA4** (`@if(config('services.google.analytics_id'))` → set `GA_MEASUREMENT_ID` in `.env`).
- Interactions (Alpine `site()`): `reveal`/`reveal-left`/`reveal-right` on scroll, `.counter` count-up, scroll-progress bar, `_parallax`/`_magnetic`/`_tilt` (gated behind `(hover:hover) and (pointer:fine)` + reduced-motion), contact form POSTs to `route('contact.store')`.
- Public SEO files in `public/`: `robots.txt`, `sitemap.xml`, `llms.txt`, `google06ceb00644acfa96.html` (Search Console verification; meta tag also in head).

## Conventions
- French for all user-facing strings + route segments (`/eleves`, `/factures`, `/emploi-du-temps`).
- Use Mary UI components (`x-card`, `x-button`, `x-modal`, `x-input`, `x-select`, `x-table`, `x-header`, `x-badge`, `x-drawer`, `x-datepicker`) + DaisyUI classes.
- For toggles/checkboxes in Blade use `@checked(...)` (Blade), **not** Alpine `:checked="…"` (which is a no-op outside an `x-data` scope — this was a real bug fixed in `academic/subjects`).
- Run `./vendor/bin/pint` before committing PHP.
