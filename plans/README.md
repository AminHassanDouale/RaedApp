# Motion & design improvement — RaedApp

Baseline commit: `495122c`. Bar: Emil Kowalski's animation philosophy + Apple's
motion principles (fast, decelerating, interruptible, invisible when it works;
everything collapses under `prefers-reduced-motion`).

## Applied (global — touches every view)

| # | Area | Change | Files |
| - | ---- | ------ | ----- |
| 1 | Motion tokens | Easing (`--ease-out-quad/cubic/expo`, `--ease-spring`) + duration scale (`--duration-fast/base/slow`) as `@theme` tokens | `resources/css/app.css` |
| 2 | Accessibility | Global `prefers-reduced-motion: reduce` guard — one authoritative off-switch for all motion incl. the welcome-page blobs | `resources/css/app.css` |
| 3 | Page enter | `[data-page]` fade + 6px rise on first paint, re-triggered after every `wire:navigate` (does not replay on Livewire component updates) | `app.css`, `resources/js/app.js`, 7 portal layouts |
| 4 | Entrance stagger | `.stagger` utility (rise-in with incremental delay) applied to KPI/stat grids on all 7 dashboards | `app.css` + `*/dashboard*.blade.php` |
| 5 | Button press | `.btn` gets tactile `active:` press (translateY + scale 0.98) and smooth ease-out hover (replaces `transition-all`) | `app.css` |
| 6 | Hover polish | Colour-only transitions for `.menu`/`.tabs`/`.table tbody tr`; `.hover-lift` utility for clickable cards; dropdown `transform-origin: top` | `app.css` |

Status: **DONE** — verified via `npm run build` (bundle contains the keyframes,
`[data-page]` rule, `.stagger`, tokens, and the reduced-motion guard).

## Available but opt-in (per-view polish, not yet applied everywhere)

These are intentionally left as utilities so views adopt them deliberately:

- **`hover-lift`** — add to clickable cards (e.g. student/invoice cards that link
  somewhere). Do *not* add to static dashboard chart cards (they aren't interactive).
- **`stagger`** — add to any list/grid that renders a fresh set on load (e.g.
  announcement lists, message threads, table-less card lists). Keep off paginated
  tables where rows morph in place.

## Deliberately NOT done (by design)

- No entrance animation on `wire:model.live` filter/search results — re-animating
  on every keystroke is the classic feel-breaking mistake. Page-enter is scoped to
  navigation only.
- No motion added to keyboard-driven or high-frequency actions.
