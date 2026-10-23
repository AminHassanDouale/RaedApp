# Design — RaedApp

Brand, visual language, and motion system. Philosophy follows the **apple-design** +
**Emil Kowalski** skills (Apple WWDC fluid-interface principles, translated to the web).

> Companion: [frontend.md](frontend.md) (implementation) · [architecture.md](architecture.md)

## Brand
- **Name:** RaedApp (formerly "ScolApp" — fully rebranded; emails/seed logins/billing default use `raedapp.com`, prod domain is `raedapp.tech`).
- **Logo:** `public/images/logoraedapp.png` — a graduation-cap mark. Used platform-wide
  (nav, sidebars, footer, login shell, `School` logo fallback, payment email, favicon).
  **Swap this one file to rebrand the app.** (`logo_RaedApp.svg` / `favicon.svg` exist but are
  superseded by the PNG.)

## Color palette — violet → fuchsia → cyan
| Role | Hex | oklch (DaisyUI) |
|------|-----|-----------------|
| **Primary** — violet | `#7c3aed` / `#8b5cf6` | `oklch(55% 0.24 294)` |
| **Secondary** — fuchsia | `#d946ef` | `oklch(66% 0.26 322)` |
| **Accent** — cyan | `#22d3ee` / `#06b6d4` | `oklch(72% 0.13 215)` |

The **DaisyUI theme is overridden** in `resources/css/app.css` — `[data-theme=light],[data-theme=dark]`
redefine `--color-primary/secondary/accent` + softer radii (`--radius-box:1rem` etc.). This is
**unlayered + last in source**, so it beats DaisyUI's defaults and re-skins *every* `btn-primary`,
`text-primary`, `badge`, ring, and card across all portals at once.

## Motion system (apple-design + Emil Kowalski)
Lives in `resources/css/app.css` (`@theme` tokens + `@layer components`) and `resources/js/app.js`.
Principles: fast, decelerating (**ease-out**), interruptible, invisible when working; **everything
collapses under `prefers-reduced-motion`** (one global guard).

- **Tokens:** `--ease-out-quad/cubic/expo`, `--ease-spring`; `--duration-fast/base/slow` (140/220/360ms).
- **`[data-page]`** — page-enter (fade + 6px rise) on first paint; re-triggered on `wire:navigate` by app.js (does NOT replay on Livewire component updates).
- **`.stagger`** — staggered rise-in for card/KPI grids (nth-child delays).
- **`.btn`** — tactile `:active` press (translateY + scale .98) + smooth ease-out hover.
- **`.hover-lift`** — opt-in lift + shadow for clickable cards.
- Reduced-motion guard disables all of the above.

## Public landing page (liinks-inspired light SaaS)
`resources/views/welcome.blade.php` — **standalone** (CDN Tailwind v3 + Alpine, NOT the app build).
Light lavender theme, brand purple, Inter + **Caveat** (handwritten annotations).
Section order: Nav → Hero (phone mockup + annotations) → Trust bar → Advantages → Features (3-up)
→ Portals → Stats → **Testimonials** (`#avis`) → Pricing → **Comparison** → FAQ → Contact → Footer.

**Landing-only interactions** (Alpine, all reduced-motion + `pointer:fine` gated): scroll-progress
bar, hero pointer-parallax (via `translate`, composes with float keyframes), magnetic CTAs, 3D card
tilt, button sheen, reveal-on-scroll, count-up stats.

## Typography
- **App:** Instrument Sans (bunny.net).
- **Landing:** Inter (400–900) + Caveat (annotations).
- Tracking tightens on large headings (`-0.02em`), body near 0 (apple §15).

## App theme (authenticated portals)
- DaisyUI **light** theme (layouts set `data-theme="light"`), recolored to the brand palette (above).
- Dashboards use **gradient-tile KPI cards** (`bg-gradient-to-br from-… to-…`) + `.stagger` entrance — consistent across all 7 role dashboards and the finance "Suivi" + academic index.
- Each portal has its own layout in `resources/views/layouts/` with a language switcher + dynamic `dir` (RTL for `ar`).

## Design principles applied (apple-design)
Craft (every value deliberate), Simplicity (not minimalism — hierarchy via spacing/contrast),
Response (feedback on pointer-down), Materials/depth (translucent nav, soft shadows),
Reduced-motion accessibility. Avoid: `transition: all`, `ease-in` on UI, `scale(0)` entrances,
animating width/height, over-animating (reserve flow/overshoot for the hero signature only).
