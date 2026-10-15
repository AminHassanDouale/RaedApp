import './bootstrap';

/* ───────────────────────────────────────────────────────────────────────────
   Page-enter motion

   The CSS keyframe on `[data-page]` plays once on first paint. After a
   `wire:navigate` SPA transition Livewire morphs the DOM in place, so the
   element is not re-created and the animation would not replay on its own.
   Here we remove the class, force a reflow, and re-add it so every route
   change glides in. `prefers-reduced-motion` is handled entirely in CSS, so
   this stays a no-op cost for users who opt out.
   ─────────────────────────────────────────────────────────────────────────── */
function replayPageEnter() {
    const page = document.querySelector('[data-page]');
    if (!page) return;
    page.style.animation = 'none';
    // Force reflow so the removed animation is committed before re-adding it.
    void page.offsetWidth;
    page.style.animation = '';
}

document.addEventListener('livewire:navigated', replayPageEnter);
