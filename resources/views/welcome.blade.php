<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="T6i8BoKlXo1erZxpC-sPsDh6-UuMh53M_h1xkGJMtfw" />
    @php
        $seoTitle = 'RaedApp — Logiciel de gestion scolaire tout-en-un';
        $seoDesc  = "RaedApp est la plateforme de gestion scolaire nouvelle génération pour les écoles de Djibouti et d'Afrique francophone : inscriptions, présences, notes & bulletins, finances et communication réunies. Paiement en ligne de la scolarité (D-Money, Waafi, CAC Pay, Exim Pay) et notifications Email + WhatsApp automatiques.";
        $seoUrl   = url('/');
        $seoImg   = asset('images/logoraedapp.png');
        $gaId     = config('services.google.analytics_id');
        $jsonLd   = [
            '@context' => 'https://schema.org',
            '@graph'   => [
                [
                    '@type' => 'Organization', '@id' => $seoUrl.'#org',
                    'name' => 'RaedApp', 'url' => $seoUrl, 'logo' => $seoImg,
                    'email' => 'contact@raedapp.com', 'areaServed' => 'DJ', 'description' => $seoDesc,
                ],
                [
                    '@type' => 'SoftwareApplication', 'name' => 'RaedApp',
                    'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web',
                    'url' => $seoUrl, 'image' => $seoImg, 'description' => $seoDesc,
                    'publisher' => ['@id' => $seoUrl.'#org'],
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD', 'description' => 'Essai gratuit — tarifs sur devis'],
                ],
                [
                    '@type' => 'FAQPage',
                    'mainEntity' => [
                        ['@type'=>'Question','name'=>"Faut-il installer un logiciel ou du matériel ?",'acceptedAnswer'=>['@type'=>'Answer','text'=>"Non. RaedApp est 100% en ligne, accessible depuis n'importe quel navigateur, ordinateur ou téléphone."]],
                        ['@type'=>'Question','name'=>"Comment les parents paient-ils la scolarité ?",'acceptedAnswer'=>['@type'=>'Answer','text'=>"En ligne en un clic (D-Money, Waafi, CAC Pay, Exim Pay) ou au guichet. Chaque paiement génère un reçu PDF envoyé par Email et WhatsApp."]],
                        ['@type'=>'Question','name'=>"L'application est-elle disponible en arabe ?",'acceptedAnswer'=>['@type'=>'Answer','text'=>"Oui : interface complète en français, arabe (affichage de droite à gauche) et anglais."]],
                    ],
                ],
            ],
        ];
    @endphp
    <meta name="description" content="{{ $seoDesc }}">
    <meta name="keywords" content="gestion scolaire, logiciel école, logiciel de gestion scolaire, SMS école, Djibouti, paiement scolarité en ligne, D-Money, Waafi, CAC Pay, bulletins scolaires, présences, notes, école numérique, RaedApp">
    <meta name="author" content="RaedApp">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
    <meta name="theme-color" content="#7c3aed">
    <link rel="canonical" href="{{ $seoUrl }}">
    <link rel="alternate" hreflang="fr" href="{{ $seoUrl }}">
    <link rel="alternate" hreflang="x-default" href="{{ $seoUrl }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logoraedapp.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logoraedapp.png') }}">
    <title>{{ $seoTitle }}</title>

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="RaedApp">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDesc }}">
    <meta property="og:url" content="{{ $seoUrl }}">
    <meta property="og:image" content="{{ $seoImg }}">
    <meta property="og:image:alt" content="RaedApp — logiciel de gestion scolaire">

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDesc }}">
    <meta name="twitter:image" content="{{ $seoImg }}">

    {{-- Structured data (schema.org JSON-LD) --}}
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Google Analytics (GA4) — set GA_MEASUREMENT_ID in .env to activate --}}
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json($gaId));
    </script>
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"','ui-sans-serif','system-ui'] },
                    colors: {
                        brand: { 50:'#f3effe',100:'#ede9fe',200:'#ddd6fe',300:'#c4b5fd',400:'#a78bfa',500:'#8b5cf6',600:'#7c3aed',700:'#6d28d9' },
                        ink: '#171225',
                    },
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary:#7c3aed; --ink:#171225; --muted:#5b5570; --line:#ecebf3;
            --ease-out: cubic-bezier(0.22, 1, 0.36, 1);
            --ease-back: cubic-bezier(0.34, 1.4, 0.5, 1);
        }
        * { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        html, body { max-width: 100%; }
        body { background: #ffffff; color: var(--ink); }
        ::selection { background: #ddd6fe; color: #4c1d95; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f6f5fb; }
        ::-webkit-scrollbar-thumb { background: #ddd6fe; border-radius: 6px; }
        ::-webkit-scrollbar-thumb:hover { background: #c4b5fd; }
        h1,h2,h3 { letter-spacing: -0.03em; }
        .text-muted { color: var(--muted); }

        /* Subtle hero wash — mostly white, faint violet top glow (Swiss-minimal) */
        .hero-wash {
            background:
                radial-gradient(760px 420px at 50% -8%, rgba(167,139,250,0.20), transparent 60%),
                linear-gradient(180deg, #faf9ff 0%, #ffffff 42%);
        }
        .blob { position:absolute; border-radius:50%; filter: blur(70px); opacity:.42; pointer-events:none; }

        /* Pill buttons */
        .pill { border-radius:9999px; transition: transform .18s var(--ease-out), box-shadow .3s, background-position .5s, background-color .2s, color .2s, border-color .2s; }
        .btn-primary {
            position:relative; overflow:hidden; color:#fff;
            background: linear-gradient(100deg,#7c3aed,#8b5cf6 55%,#a855f7);
            background-size:200% 100%; box-shadow: 0 10px 26px -10px rgba(124,58,237,0.55);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 18px 38px -12px rgba(124,58,237,0.6); background-position:100% 0; }
        .btn-primary:active { transform: translateY(0) scale(.98); }
        .btn-outline { background:#fff; color:var(--ink); border:1px solid var(--line); }
        .btn-outline:hover { border-color:#c4b5fd; transform: translateY(-2px); box-shadow:0 10px 24px -14px rgba(124,58,237,0.4); }
        .btn-outline:active { transform: translateY(0) scale(.98); }

        /* Cards */
        .card { background:#fff; border:1px solid var(--line); box-shadow: 0 1px 2px rgba(23,18,37,0.04); }
        .card-lift { transition: transform .35s var(--ease-out), box-shadow .35s var(--ease-out), border-color .3s; }
        .card-lift:hover { transform: translateY(-5px); box-shadow: 0 24px 50px -22px rgba(124,58,237,0.26); border-color:#e3dcfb; }

        /* Scroll reveal — slight scale/overshoot (back.out feel) */
        .reveal { opacity:0; transform: translateY(26px) scale(.985); transition: opacity .6s ease, transform .65s var(--ease-back); }
        .reveal.in { opacity:1; transform:none; }

        .scroll-progress { height:100%; transform-origin:left center; transform:scaleX(var(--sp,0)); will-change:transform; }
        [data-tilt],[data-magnetic]{ will-change: transform; }
        [x-cloak]{ display:none !important; }

        /* App-window frame for the demo video */
        .win { background:#ffffff; border:1px solid var(--line); box-shadow: 0 40px 90px -36px rgba(76,29,149,0.4); }
        .win-bar { background:#faf9fe; border-bottom:1px solid var(--line); }
        .win-dot { width:11px; height:11px; border-radius:50%; }
        .play-btn { box-shadow: 0 20px 45px -12px rgba(0,0,0,0.55); }
        .play-ring::before {
            content:''; position:absolute; inset:-10px; border-radius:50%;
            border:2px solid rgba(255,255,255,0.6); animation: playpulse 2.4s var(--ease-out) infinite;
        }
        @keyframes playpulse { 0%{ transform:scale(.9); opacity:.7 } 70%{ transform:scale(1.35); opacity:0 } 100%{ opacity:0 } }

        /* Input -> output automation cards */
        .io-in  { background:#f6f5fb; border:1px solid var(--line); }
        .io-out { background:#f6f0ff; border:1px solid #e7dcfb; }
        .io-arrow { color:#a78bfa; }

        /* Stepnum */
        .stepnum { width:44px; height:44px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:17px; color:#fff; background:linear-gradient(135deg,#7c3aed,#a855f7); box-shadow:0 10px 24px -10px rgba(124,58,237,0.6); }

        /* Calculator range */
        input[type=range].slider { -webkit-appearance:none; appearance:none; height:8px; border-radius:9999px; background:linear-gradient(90deg,#7c3aed,#a855f7); outline:none; }
        input[type=range].slider::-webkit-slider-thumb { -webkit-appearance:none; appearance:none; width:26px; height:26px; border-radius:50%; background:#fff; border:3px solid #7c3aed; box-shadow:0 4px 12px rgba(124,58,237,.4); cursor:pointer; }
        input[type=range].slider::-moz-range-thumb { width:26px; height:26px; border-radius:50%; background:#fff; border:3px solid #7c3aed; box-shadow:0 4px 12px rgba(124,58,237,.4); cursor:pointer; }

        /* Marquee */
        .marquee { overflow:hidden; -webkit-mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent); mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent); }
        .marquee-track { display:flex; gap:3.5rem; width:max-content; animation: scrollx 28s linear infinite; }
        @keyframes scrollx { to { transform: translateX(-50%); } }
        @media (hover:hover){ .marquee:hover .marquee-track { animation-play-state: paused; } }

        /* Hero entrance */
        .hero-rise { opacity:0; transform: translateY(22px); transition: opacity .8s var(--ease-out), transform .8s var(--ease-out); }
        body.is-ready .hero-rise { opacity:1; transform:none; }

        @media (prefers-reduced-motion: reduce) {
            *,*::before,*::after { animation-duration:.001ms !important; animation-iteration-count:1 !important; transition-duration:.001ms !important; }
            .reveal, .hero-rise { opacity:1 !important; transform:none !important; }
            .marquee-track { animation:none !important; }
            .play-ring::before { display:none; }
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden" x-data="site()" x-init="init()">

{{-- Scroll progress --}}
<div class="fixed top-0 inset-x-0 h-[3px] z-[60] pointer-events-none" aria-hidden="true">
    <div class="scroll-progress" style="background:linear-gradient(90deg,#7c3aed,#a855f7,#22d3ee);"></div>
</div>

{{-- ══════════════ NAV ══════════════ --}}
<nav class="fixed top-0 inset-x-0 z-50 px-4 transition-all duration-500" :class="scrolled ? 'pt-3' : 'pt-5'">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between gap-4 bg-white/85 backdrop-blur-xl rounded-full pl-5 pr-3 py-2.5 border border-[#ecebf3]" :class="scrolled ? 'shadow-[0_10px_30px_-14px_rgba(23,18,37,0.2)]' : ''">
            <a href="#top" class="flex items-center gap-2.5 shrink-0">
                <img src="{{ asset('images/logoraedapp.png') }}" alt="RaedApp" class="h-8 w-8">
                <span class="font-extrabold text-lg text-ink">Raed<span class="text-brand-600">App</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-1 text-sm font-medium text-muted">
                <a href="#demo"            class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Démo</a>
                <a href="#fonctionnalites" class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Fonctionnalités</a>
                <a href="#portails"        class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Portails</a>
                <a href="#calcul"          class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Vos gains</a>
                <a href="#faq"             class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">FAQ</a>
            </div>
            <div class="hidden lg:flex items-center gap-2">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-muted hover:text-ink px-4 py-2.5 rounded-full transition">Se connecter</a>
                <a href="#contact" data-magnetic="0.25" class="pill btn-primary text-sm font-semibold px-5 py-2.5">Demander une démo</a>
            </div>
            <button @click="mobileOpen=!mobileOpen" class="lg:hidden p-2 text-ink" aria-label="Menu">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div x-show="mobileOpen" x-cloak x-transition class="lg:hidden mt-2 bg-white rounded-2xl p-4 space-y-1 shadow-xl border border-[#ecebf3]">
            <a href="#demo" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Démo</a>
            <a href="#fonctionnalites" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Fonctionnalités</a>
            <a href="#portails" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Portails</a>
            <a href="#calcul" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Vos gains</a>
            <a href="#faq" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">FAQ</a>
            <div class="pt-2 flex gap-2">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-full border border-[#ecebf3] font-semibold text-sm">Connexion</a>
                <a href="#contact" @click="mobileOpen=false" class="flex-1 text-center btn-primary pill py-2.5 font-semibold text-sm">Démo</a>
            </div>
        </div>
    </div>
</nav>

{{-- ══════════════ HERO ══════════════ --}}
<section id="top" class="hero-wash relative overflow-hidden pt-36 lg:pt-44 pb-20">
    <div class="blob" style="width:360px;height:360px;background:#c4b5fd;top:-120px;left:50%;transform:translateX(-50%);"></div>

    <div class="relative max-w-3xl mx-auto px-5 text-center">
        <a href="#demo" class="hero-rise inline-flex items-center gap-2 bg-white border border-[#ecebf3] text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-7 shadow-sm hover:border-brand-200 transition" style="transition-delay:.05s">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nouveau — l'application en action
        </a>
        <h1 class="text-[2.6rem] leading-[1.05] sm:text-6xl sm:leading-[1.03] font-extrabold text-ink hero-rise" style="transition-delay:.12s">
            Toute votre école,<br>dans <span class="text-brand-600">une seule application</span>
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-muted max-w-2xl mx-auto leading-relaxed hero-rise" style="transition-delay:.2s">
            Inscriptions, présences, notes et finances réunies — et la scolarité encaissée en ligne, avec des parents prévenus par Email et WhatsApp, automatiquement.
        </p>
        <div class="mt-9 flex flex-col sm:flex-row gap-3 justify-center items-center hero-rise" style="transition-delay:.28s">
            <a href="#contact" data-magnetic="0.28" class="pill btn-primary font-semibold px-7 py-4 w-full sm:w-auto">Demander une démo gratuite</a>
            <a href="#demo" class="pill btn-outline group inline-flex items-center gap-3 font-semibold px-6 py-4 w-full sm:w-auto justify-center">
                <span class="w-7 h-7 rounded-full bg-brand-600 text-white flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-3.5 h-3.5 ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6 4l10 6-10 6V4z"/></svg>
                </span>
                Regarder la démo
            </a>
        </div>
        <p class="mt-6 text-xs text-muted hero-rise" style="transition-delay:.34s">
            Sans installation &nbsp;·&nbsp; FR · العربية · EN &nbsp;·&nbsp; Paiement en ligne
        </p>
    </div>

    {{-- Hero media: the framed demo video (centerpiece) --}}
    <div id="demo" class="relative max-w-4xl mx-auto px-5 mt-16 hero-rise" style="transition-delay:.42s">
        <div class="win rounded-[22px] overflow-hidden">
            <div class="win-bar flex items-center gap-2 px-4 py-3">
                <span class="win-dot" style="background:#ff5f57"></span>
                <span class="win-dot" style="background:#febc2e"></span>
                <span class="win-dot" style="background:#28c840"></span>
                <span class="ml-3 flex items-center gap-2 text-xs text-muted font-medium">
                    <img src="{{ asset('images/logoraedapp.png') }}" class="w-4 h-4" alt=""> app.raedapp.com — Démonstration
                </span>
            </div>
            {{-- Auto-cycling product tour (uselipo-style). No video file needed —
                 the dock at the bottom highlights each feature in turn and swaps the window. --}}
            @php $dock=[
                ['Élèves','sky','<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                ['Présences','amber','<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="m9 16 2 2 4-4"/>'],
                ['Bulletins','violet','<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8M8 17h5"/>'],
                ['Paiements','emerald','<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>'],
                ['Communication','rose','<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>'],
            ]; @endphp
            <div class="relative bg-[#f6f5fb] px-5 py-8 sm:px-8 sm:py-10" x-data="demo()" x-init="start()"
                 @mouseenter="stop()" @mouseleave="start()">
                {{-- floating app window --}}
                <div class="mx-auto max-w-sm bg-white rounded-2xl border border-[#ecebf3] shadow-[0_30px_60px_-30px_rgba(23,18,37,0.4)] overflow-hidden">
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-[#ecebf3]">
                        <img src="{{ asset('images/logoraedapp.png') }}" class="w-4 h-4" alt="">
                        <span class="text-sm font-bold text-ink" x-text="titles[active]">Élèves</span>
                        <span class="ml-auto flex items-center gap-1.5 text-[11px] font-semibold text-emerald-600"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> En direct</span>
                    </div>
                    <div class="relative min-h-[262px] overflow-hidden">
                        {{-- 0 — Élèves --}}
                        <div x-show="active===0" x-cloak x-transition.opacity.duration.450ms class="absolute inset-0 p-4 sm:p-5 space-y-2.5">
                            @foreach([['FA','Fatima Ahmed','6ème A','Inscrit','emerald'],['OD','Omar Diriye','5ème B','Inscrit','emerald'],['IH','Idris Hassan','CM2','En attente','amber']] as $r)
                            <div class="flex items-center gap-3 rounded-xl border border-[#ecebf3] px-3 py-2.5">
                                <span class="w-9 h-9 rounded-full bg-brand-100 text-brand-700 text-xs font-bold flex items-center justify-center shrink-0">{{ $r[0] }}</span>
                                <div class="flex-1 min-w-0"><p class="text-sm font-semibold text-ink truncate">{{ $r[1] }}</p><p class="text-xs text-muted">{{ $r[2] }}</p></div>
                                <span class="text-[11px] font-bold px-2 py-1 rounded-full bg-{{ $r[4] }}-50 text-{{ $r[4] }}-600">{{ $r[3] }}</span>
                            </div>
                            @endforeach
                        </div>
                        {{-- 1 — Présences --}}
                        <div x-show="active===1" x-cloak x-transition.opacity.duration.450ms class="absolute inset-0 p-4 sm:p-5 space-y-2.5">
                            <p class="text-xs font-semibold text-muted">6ème A · Appel du jour</p>
                            @foreach([['Fatima Ahmed','Présent',true],['Amina Hassan','Absent',false],['Omar Diriye','Présent',true]] as $r)
                            <div class="flex items-center gap-3 rounded-xl border border-[#ecebf3] px-3 py-2.5">
                                <span class="w-2.5 h-2.5 rounded-full {{ $r[2] ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
                                <p class="flex-1 text-sm font-semibold text-ink">{{ $r[0] }}</p>
                                <span class="text-[11px] font-bold {{ $r[2] ? 'text-emerald-600' : 'text-red-600' }}">{{ $r[1] }}</span>
                            </div>
                            @endforeach
                            <div class="flex items-center gap-2.5 rounded-xl bg-emerald-50 border border-emerald-100 px-3 py-2.5">
                                <span class="w-7 h-7 rounded-full bg-white text-emerald-600 flex items-center justify-center shrink-0"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>
                                <p class="text-xs font-semibold text-emerald-700">Parent d'Amina notifié par WhatsApp</p>
                            </div>
                        </div>
                        {{-- 2 — Bulletins --}}
                        <div x-show="active===2" x-cloak x-transition.opacity.duration.450ms class="absolute inset-0 p-4 sm:p-5 space-y-2">
                            <p class="text-xs font-semibold text-muted mb-0.5">Fatima Ahmed · Trimestre 2</p>
                            @foreach([['Mathématiques','16'],['Français','14'],['Sciences','15']] as $g)
                            <div class="flex items-center justify-between rounded-xl border border-[#ecebf3] px-3 py-2.5">
                                <p class="text-sm font-semibold text-ink">{{ $g[0] }}</p>
                                <span class="text-sm font-bold text-brand-600">{{ $g[1] }}<span class="text-xs text-muted">/20</span></span>
                            </div>
                            @endforeach
                            <div class="flex items-center justify-between rounded-xl bg-brand-600 text-white px-3 py-3">
                                <p class="text-sm font-bold">Moyenne générale</p>
                                <span class="text-sm font-extrabold">15,0/20 · Bulletin publié ✓</span>
                            </div>
                        </div>
                        {{-- 3 — Paiements --}}
                        <div x-show="active===3" x-cloak x-transition.opacity.duration.450ms class="absolute inset-0 p-4 sm:p-5">
                            <div class="rounded-2xl border border-[#ecebf3] p-4">
                                <div class="flex items-center justify-between">
                                    <div><p class="text-sm font-bold text-ink">Scolarité — Trim. 2</p><p class="text-xs text-muted">Fatima Ahmed · 6ème A</p></div>
                                    <span class="text-[11px] font-bold px-2 py-1 rounded-full bg-emerald-50 text-emerald-600">Payé</span>
                                </div>
                                <p class="text-2xl font-extrabold text-ink mt-3">45 000 <span class="text-sm font-bold">FDJ</span></p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="text-[11px] font-bold px-2 py-1 rounded-full bg-brand-50 text-brand-600">D-Money</span>
                                    <span class="text-[11px] text-muted">il y a 2 min</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 rounded-xl bg-emerald-50 border border-emerald-100 px-3 py-2.5 mt-3">
                                <span class="w-7 h-7 rounded-full bg-white text-emerald-600 flex items-center justify-center shrink-0"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>
                                <p class="text-xs font-semibold text-emerald-700">Reçu PDF envoyé par Email + WhatsApp</p>
                            </div>
                        </div>
                        {{-- 4 — Communication (WhatsApp) --}}
                        <div x-show="active===4" x-cloak x-transition.opacity.duration.450ms class="absolute inset-0 p-4 sm:p-5">
                            <div class="rounded-2xl p-3 h-full" style="background:#e5ddd5;">
                                <div class="max-w-[88%] ml-auto bg-[#dcf8c6] rounded-xl rounded-tr-sm px-3 py-2 shadow-sm">
                                    <p class="text-[11px] font-bold text-emerald-800 mb-0.5">École Démo RaedApp</p>
                                    <p class="text-xs text-ink leading-relaxed">Bonjour 👋 La note de Fatima est disponible — moyenne <b>15/20</b>. Le reçu de scolarité est en pièce jointe.</p>
                                    <p class="text-[10px] text-slate-500 text-right mt-1">09:41 ✓✓</p>
                                </div>
                                <div class="max-w-[75%] ml-auto bg-[#dcf8c6] rounded-xl px-3 py-2 mt-2 shadow-sm flex items-center gap-2">
                                    <span class="w-8 h-8 rounded bg-red-500 text-white text-[9px] flex items-center justify-center font-bold shrink-0">PDF</span>
                                    <p class="text-xs text-ink truncate">recu_scolarite_T2.pdf</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- dock --}}
                <div class="mt-7 flex justify-center">
                    <div class="inline-flex items-end gap-2 bg-white/90 backdrop-blur rounded-2xl border border-[#ecebf3] shadow-[0_14px_36px_-16px_rgba(23,18,37,0.3)] px-2.5 py-2.5">
                        @foreach($dock as $i => $d)
                        <button type="button" @click="go({{ $i }})" aria-label="{{ $d[0] }}"
                                class="relative w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-300 cursor-pointer bg-{{ $d[1] }}-50 text-{{ $d[1] }}-600"
                                :class="active==={{ $i }} ? '-translate-y-1.5 ring-2 ring-brand-500 shadow-lg' : 'hover:-translate-y-0.5 opacity-80 hover:opacity-100'">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $d[2] !!}</svg>
                            <span x-show="active==={{ $i }}" x-cloak x-transition class="absolute -top-9 left-1/2 -translate-x-1/2 whitespace-nowrap bg-ink text-white text-[11px] font-semibold px-2.5 py-1 rounded-lg shadow">{{ $d[0] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ PROOF BAR ══════════════ --}}
<section class="bg-white border-y border-[#ecebf3]">
    <div class="max-w-6xl mx-auto px-5 py-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @php $proof = [
                ['<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>','Sécurité renforcée','Accès par rôles & audit'],
                ['<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/>','Simple à utiliser','Prise en main en 1 jour'],
                ['<circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z"/>','FR · العربية · EN','Chacun sa langue'],
                ['<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>','Paiement en ligne','D-Money · Waafi · CAC Pay'],
            ]; @endphp
            @foreach($proof as $p)
            <div class="reveal flex items-center gap-3">
                <span class="w-11 h-11 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $p[0] !!}</svg>
                </span>
                <div><p class="font-bold text-sm text-ink leading-tight">{{ $p[1] }}</p><p class="text-xs text-muted">{{ $p[2] }}</p></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ INPUT → OUTPUT (automation) ══════════════ --}}
<section id="fonctionnalites" class="bg-white py-24">
    <div class="max-w-5xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <span class="inline-block bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">L'automatisation en action</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-ink leading-tight">Vous faites un geste.<br>RaedApp fait <span class="text-brand-600">le reste.</span></h2>
            <p class="mt-4 text-muted">Chaque action du quotidien déclenche automatiquement la bonne suite — zéro ressaisie, zéro oubli.</p>
        </div>

        <style>
            .flow-conn{ color:#a78bfa; }
            .flow-chev{ display:inline-flex; opacity:.22; animation: chevflow 2.4s linear infinite; animation-delay: calc(var(--o,0s) + var(--d,0s)); }
            @keyframes chevflow{ 0%{opacity:.18; transform:translateX(-3px)} 18%{opacity:1; transform:translateX(2px)} 46%,100%{opacity:.18; transform:translateX(-3px)} }
            .flow-outic{ display:inline-flex; animation: flowpop 2.4s ease infinite; animation-delay: var(--o,0s); }
            @keyframes flowpop{ 0%,30%{transform:scale(1)} 39%{transform:scale(1.18)} 50%{transform:scale(1)} 100%{transform:scale(1)} }
            .flow-ping{ position:relative; }
            .flow-ping::before{ content:''; position:absolute; inset:0; border-radius:inherit; border:2px solid #a78bfa; opacity:0; animation: flowping 2.4s ease infinite; animation-delay: var(--o,0s); }
            @keyframes flowping{ 0%,30%{transform:scale(1); opacity:0} 39%{opacity:.6} 72%{transform:scale(1.9); opacity:0} 100%{opacity:0} }
            .flow-out::after{ content:''; position:absolute; inset:0; border-radius:inherit; pointer-events:none; opacity:0; background:radial-gradient(circle at 82% 10%, rgba(124,58,237,.14), transparent 60%); animation: flowflash 2.4s ease infinite; animation-delay: var(--o,0s); }
            @keyframes flowflash{ 0%,30%{opacity:0} 40%{opacity:1} 72%{opacity:0} 100%{opacity:0} }
            .flow:hover .flow-chev, .flow:hover .flow-outic, .flow:hover .flow-ping::before, .flow:hover .flow-out::after{ animation-duration: 1.2s; }
            @media (max-width:639px){ .flow-conn{ transform: rotate(90deg); margin: .25rem 0; } }
            @media (prefers-reduced-motion: reduce){
                .flow-chev{ opacity:.6; animation:none; transform:none; }
                .flow-outic, .flow-out::after{ animation:none; }
                .flow-ping::before{ display:none; }
            }
        </style>
        <div class="space-y-5">
            @php $flows = [
                ['<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m22 8-5 5M17 8l5 5"/>','Vous marquez une absence','en un clic depuis le portail','Le parent reçoit un message','par <b>WhatsApp</b> et Email, instantanément','<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>','~2 s'],
                ['<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>','Vous enregistrez un paiement','à la caisse ou en ligne','Un reçu PDF part automatiquement','au parent, par <b>Email + WhatsApp</b>','<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>','Reçu PDF'],
                ['<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>','L\'enseignant saisit les notes','matière par matière','Le bulletin est généré & publié','visible par les parents en <b>un clic</b>','<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="m9 15 2 2 4-4"/>','0 ressaisie'],
                ['<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>','Une échéance approche','sans que vous y pensiez','Un rappel de paiement part','relance <b>automatique</b> des impayés','<path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>','Relance auto'],
                ['<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/>','Vous inscrivez un élève','avec son responsable','Les accès sont créés','<b>parent &amp; élève</b> reçoivent leurs identifiants','<circle cx="7.5" cy="15.5" r="5.5"/><path d="m21 2-9.6 9.6M15.5 7.5l3 3L22 7l-3-3"/>','Instantané'],
            ]; @endphp
            @foreach($flows as $i => $f)
            <div class="flow reveal card card-lift rounded-2xl p-5 sm:p-6 grid sm:grid-cols-[1fr_auto_1fr] items-center gap-4" style="transition-delay: {{ $i*70 }}ms; --o: {{ $i*0.35 }}s">
                <div class="io-in rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-7 h-7 rounded-lg bg-white border border-[#ecebf3] text-ink flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $f[0] !!}</svg>
                        </span>
                        <p class="text-[11px] font-bold uppercase tracking-widest text-muted">Vous faites</p>
                    </div>
                    <p class="font-bold text-ink">{{ $f[1] }}</p>
                    <p class="text-sm text-muted">{{ $f[2] }}</p>
                </div>
                <div class="flow-conn flex items-center justify-center gap-0.5">
                    <span class="flow-chev" style="--d:0s"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg></span>
                    <span class="flow-chev" style="--d:.16s"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg></span>
                    <span class="flow-chev" style="--d:.32s"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg></span>
                </div>
                <div class="io-out flow-out rounded-xl p-4 relative">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600">RaedApp fait</p>
                        <span class="flow-ping w-8 h-8 rounded-lg bg-white text-brand-600 flex items-center justify-center shrink-0">
                            <span class="flow-outic"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $f[5] !!}</svg></span>
                        </span>
                    </div>
                    <p class="font-bold text-ink">{{ $f[3] }}</p>
                    <p class="text-sm text-muted">{!! $f[4] !!}</p>
                    <span class="inline-flex items-center gap-1 mt-3 text-[11px] font-bold text-brand-700 bg-white border border-[#e7dcfb] rounded-full px-2 py-0.5">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M11 1 3 11h5l-1 8 8-10h-5l1-8z"/></svg> {{ $f[6] }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        <p class="text-center text-sm text-muted mt-8 reveal">…et des dizaines d'autres automatismes, <span class="text-ink font-semibold">sans jamais y penser.</span></p>

        {{-- payment marquee --}}
        <div class="mt-14 reveal">
            <p class="text-center text-xs font-semibold tracking-widest uppercase text-muted mb-5">Encaissez la scolarité en ligne</p>
            <div class="marquee">
                <div class="marquee-track">
                    @foreach(['D-Money','Waafi','CAC Pay','Exim Pay','Espèces','Virement','D-Money','Waafi','CAC Pay','Exim Pay','Espèces','Virement'] as $pay)
                    <span class="flex items-center gap-2 text-muted font-bold text-lg shrink-0"><span class="w-2.5 h-2.5 rounded-full bg-brand-400"></span>{{ $pay }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ EVERYDAY TOOLS (bento) ══════════════ --}}
<section class="bg-[#faf9ff] border-y border-[#ecebf3] py-24">
    <div class="max-w-5xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <span class="inline-block bg-white border border-[#ecebf3] text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">Plus que de la gestion</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-ink">Les petits outils du quotidien</h2>
            <p class="mt-4 text-muted">Des détails qui font gagner du temps — à chaque heure de la journée.</p>
        </div>

        <style>
            .mock{ position:relative; height:9.5rem; border-radius:16px; overflow:hidden; background:#f6f5fb; border:1px solid #ecebf3; }
            /* A — timetable "now" line */
            .edt-line{ position:absolute; left:10px; right:10px; height:2px; background:#7c3aed; box-shadow:0 0 10px 1px rgba(124,58,237,.6); border-radius:2px; top:12%; animation: edtline 3.4s ease-in-out infinite; }
            @keyframes edtline{ 0%{ top:12%; opacity:0 } 12%{ opacity:1 } 88%{ opacity:1 } 100%{ top:86%; opacity:0 } }
            /* B — announcement */
            .anno-card{ animation: annoin 3.8s ease-in-out infinite; }
            @keyframes annoin{ 0%,8%{ opacity:0; transform:translateY(-14px) scale(.96) } 18%,74%{ opacity:1; transform:translateY(0) scale(1) } 86%,100%{ opacity:0; transform:translateY(-14px) scale(.96) } }
            .anno-bell{ transform-origin:top center; animation: annobell 3.8s ease-in-out infinite; }
            @keyframes annobell{ 0%,15%{ transform:rotate(0) } 19%{ transform:rotate(-16deg) } 23%{ transform:rotate(13deg) } 27%{ transform:rotate(-8deg) } 31%,100%{ transform:rotate(0) } }
            /* C — receipt scan + stamp */
            .rec-scan{ position:absolute; left:0; right:0; height:14px; top:0; background:linear-gradient(180deg, rgba(5,150,105,.28), transparent); border-top:2px solid #059669; animation: recscan 3.2s ease-in-out infinite; }
            @keyframes recscan{ 0%{ top:0; opacity:0 } 10%{ opacity:1 } 82%{ top:calc(100% - 14px); opacity:1 } 90%,100%{ opacity:0 } }
            .rec-done{ opacity:0; transform:scale(.4); animation: recdone 3.2s ease infinite; }
            @keyframes recdone{ 0%,62%{ opacity:0; transform:scale(.4) } 70%{ opacity:1; transform:scale(1.18) } 78%,94%{ opacity:1; transform:scale(1) } 100%{ opacity:0; transform:scale(.4) } }
            /* D — language switch */
            .lw{ opacity:0; animation: langword 6s ease infinite; }
            .lw-0{ animation-delay:0s } .lw-1{ animation-delay:2s } .lw-2{ animation-delay:4s }
            @keyframes langword{ 0%{ opacity:0; transform:translateY(6px) } 4%{ opacity:1; transform:translateY(0) } 28%{ opacity:1; transform:translateY(0) } 33%{ opacity:0; transform:translateY(-6px) } 100%{ opacity:0 } }
            .lp{ animation: langpill 6s ease infinite; }
            .lp-0{ animation-delay:0s } .lp-1{ animation-delay:2s } .lp-2{ animation-delay:4s }
            @keyframes langpill{ 0%{ background:transparent; color:#5b5570 } 4%,28%{ background:#0891b2; color:#fff } 33%,100%{ background:transparent; color:#5b5570 } }
            @media (prefers-reduced-motion: reduce){
                .edt-line,.anno-card,.anno-bell,.rec-scan,.rec-done,.lw,.lp{ animation:none; }
                .rec-scan{ display:none; } .rec-done{ opacity:1; transform:none; }
                .anno-card{ opacity:1; transform:none; }
                .lw-0{ opacity:1 } .lw-1,.lw-2{ opacity:0 }
                .lp-0{ background:#0891b2; color:#fff }
            }
        </style>

        <div class="grid md:grid-cols-2 gap-5">
            {{-- A — Emploi du temps --}}
            <div class="reveal card card-lift rounded-3xl p-5" style="transition-delay:0ms">
                <div class="mock p-3">
                    <div class="grid grid-cols-5 gap-1.5 h-full">
                        @foreach(['violet','sky','emerald','amber','rose'] as $c)
                        <div class="flex flex-col gap-1.5">
                            <div class="h-1.5 rounded bg-[#ded7f0]"></div>
                            <div class="flex-1 rounded bg-{{ $c }}-100 border border-{{ $c }}-200"></div>
                            <div class="flex-1 rounded bg-{{ $c }}-50"></div>
                        </div>
                        @endforeach
                    </div>
                    <div class="edt-line"></div>
                </div>
                <div class="flex items-center gap-2 mt-5">
                    <span class="w-9 h-9 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center shrink-0"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></span>
                    <h3 class="font-bold text-ink">Emploi du temps</h3>
                    <span class="ml-auto text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full">Inclus</span>
                </div>
                <p class="text-sm text-muted mt-2">Cours, salles et enseignants organisés — sans conflit, à jour en direct.</p>
            </div>

            {{-- B — Annonces --}}
            <div class="reveal card card-lift rounded-3xl p-5" style="transition-delay:80ms">
                <div class="mock flex items-center justify-center p-4">
                    <div class="anno-card flex items-center gap-3 bg-white border border-[#ecebf3] rounded-xl shadow-md px-3 py-2.5 w-full max-w-[15rem]">
                        <span class="anno-bell w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></span>
                        <div class="min-w-0"><p class="text-xs font-bold text-ink">Nouvelle annonce</p><p class="text-[11px] text-muted truncate">Sortie pédagogique vendredi</p></div>
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-5">
                    <span class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg></span>
                    <h3 class="font-bold text-ink">Annonces &amp; carnet</h3>
                    <span class="ml-auto text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full">Inclus</span>
                </div>
                <p class="text-sm text-muted mt-2">Une info à partager ? Elle arrive aussitôt aux parents et aux élèves.</p>
            </div>

            {{-- C — Reçus PDF --}}
            <div class="reveal card card-lift rounded-3xl p-5" style="transition-delay:160ms">
                <div class="mock flex items-center justify-center p-4">
                    <div class="relative w-32 bg-white border border-[#ecebf3] rounded-lg p-3 shadow-sm">
                        <div class="flex items-center gap-1.5 mb-2">
                            <span class="w-6 h-6 rounded bg-red-500 text-white text-[8px] flex items-center justify-center font-bold shrink-0">PDF</span>
                            <div class="h-1.5 flex-1 rounded bg-[#ecebf3]"></div>
                        </div>
                        <div class="space-y-1.5">
                            <div class="h-1.5 rounded bg-[#eceaf2]"></div>
                            <div class="h-1.5 rounded bg-[#eceaf2] w-4/5"></div>
                            <div class="h-1.5 rounded bg-[#eceaf2]"></div>
                            <div class="h-1.5 rounded bg-[#eceaf2] w-2/3"></div>
                        </div>
                        <div class="rec-scan"></div>
                        <span class="rec-done absolute bottom-1 right-1 w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-5">
                    <span class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg></span>
                    <h3 class="font-bold text-ink">Reçus PDF</h3>
                    <span class="ml-auto text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full">Auto</span>
                </div>
                <p class="text-sm text-muted mt-2">Chaque paiement génère son reçu PDF, prêt à envoyer par Email &amp; WhatsApp.</p>
            </div>

            {{-- D — Multi-langue --}}
            <div class="reveal card card-lift rounded-3xl p-5" style="transition-delay:240ms">
                <div class="mock flex flex-col items-center justify-center gap-3 p-4">
                    <div class="flex items-center gap-1 bg-white border border-[#ecebf3] rounded-full p-1 text-[11px] font-bold text-muted">
                        <span class="lp lp-0 px-2.5 py-1 rounded-full">FR</span>
                        <span class="lp lp-1 px-2.5 py-1 rounded-full">ع</span>
                        <span class="lp lp-2 px-2.5 py-1 rounded-full">EN</span>
                    </div>
                    <div class="relative h-8 w-full">
                        <span class="lw lw-0 absolute inset-0 flex items-center justify-center text-xl font-extrabold text-ink">Bonjour 👋</span>
                        <span class="lw lw-1 absolute inset-0 flex items-center justify-center text-xl font-extrabold text-ink" dir="rtl">مرحبا 👋</span>
                        <span class="lw lw-2 absolute inset-0 flex items-center justify-center text-xl font-extrabold text-ink">Hello 👋</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-5">
                    <span class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z"/></svg></span>
                    <h3 class="font-bold text-ink">Multi-langue</h3>
                    <span class="ml-auto text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded-full">FR · ع · EN</span>
                </div>
                <p class="text-sm text-muted mt-2">Français, arabe (droite à gauche) et anglais — chacun choisit sa langue.</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ CALCULATOR ══════════════ --}}
<section id="calcul" class="bg-[#faf9ff] border-y border-[#ecebf3] py-24">
    <div class="max-w-4xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-12 reveal">
            <span class="inline-block bg-white border border-[#ecebf3] text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">Estimez vos gains</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-ink">Combien RaedApp vous fait gagner ?</h2>
            <p class="mt-4 text-muted">Déplacez le curseur selon la taille de votre école.</p>
        </div>

        <div class="reveal card rounded-3xl p-7 sm:p-10" x-data="{ s: 300 }">
            <div class="flex items-center justify-between mb-3">
                <label for="eleves" class="font-bold text-ink">Nombre d'élèves</label>
                <span class="text-2xl font-extrabold text-brand-600" x-text="(+s).toLocaleString('fr-FR')"></span>
            </div>
            <input id="eleves" type="range" min="50" max="2000" step="10" x-model.number="s" class="slider w-full">
            <div class="flex justify-between text-xs text-muted mt-2"><span>50</span><span>2 000</span></div>

            <div class="grid sm:grid-cols-3 gap-4 mt-8">
                <div class="io-out rounded-2xl p-5 text-center">
                    <p class="text-3xl font-extrabold text-brand-600" x-text="Math.round(s*0.1).toLocaleString('fr-FR') + ' h'"></p>
                    <p class="text-sm text-muted mt-1">de paperasse économisées / mois</p>
                </div>
                <div class="io-out rounded-2xl p-5 text-center">
                    <p class="text-3xl font-extrabold text-brand-600" x-text="(s*5).toLocaleString('fr-FR')"></p>
                    <p class="text-sm text-muted mt-1">notifications auto / mois (Email + WhatsApp)</p>
                </div>
                <div class="io-out rounded-2xl p-5 text-center">
                    <p class="text-3xl font-extrabold text-brand-600" x-text="(+s).toLocaleString('fr-FR')"></p>
                    <p class="text-sm text-muted mt-1">parents qui paient en ligne</p>
                </div>
            </div>
            <p class="text-center text-xs text-muted mt-6">Estimation indicative, à affiner avec votre établissement.</p>
            <div class="text-center mt-6">
                <a href="#contact" class="pill btn-primary inline-block font-semibold px-7 py-3.5">Obtenir mon estimation précise</a>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ PORTALS ══════════════ --}}
<section id="portails" class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-5">
        @php $portals = [
            ['<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>','Plateforme','SaaS','Opérateur de la plateforme','Pilotez toutes les écoles clientes depuis une console unique.',['Tableau de bord global','Toutes les écoles clientes','Plans & abonnements','Facturation SaaS','Comptes & rôles','Paramètres & journal d\'audit']],
            ['<rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01M16 6h.01M8 10h.01M16 10h.01"/>','Administration','Complet','Niveau école','Gérez toute votre école, de l\'inscription à la finance.',['Élèves & inscriptions','Enseignants & responsables','Présences & bulletins','Finances & recouvrement','Annonces & messagerie','Rapports & paramètres']],
            ['<path d="M2 3h20"/><path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"/><path d="m7 21 5-5 5 5"/>','Enseignant','Ses classes','Portail enseignant','Tout pour vos cours, rien de superflu.',['Son emploi du temps','Ses classes & élèves','Saisie des présences','Notes & évaluations','Bulletins de ses matières','Messagerie parents']],
            ['<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>','Surveillant','Vie scolaire','Portail surveillant','Le suivi des présences au quotidien.',['Appel & présences','Suivi des absences','Retards & justificatifs','Liste des élèves','Planning de surveillance','Alerte parents (WhatsApp)']],
            ['<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>','Parent','Ses enfants','Portail parent','Suivez la scolarité de vos enfants en temps réel.',['Mes enfants','Emploi du temps','Notes & bulletins','Présences & absences','Factures & paiement en ligne','Messagerie & annonces']],
            ['<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>','Élève','Consultation','Portail élève','Votre scolarité, toujours à portée de main.',['Emploi du temps','Ses notes','Ses bulletins','Ses présences','Ses retards','Annonces de l\'école']],
            ['<path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1z"/><path d="M8 7h8M8 11h8M8 15h5"/>','Caissier','Guichet','Portail caissier','L\'encaissement au guichet, simplifié.',['Encaisser au guichet','Paiement en ligne','Émission de factures','Reçus PDF','Suivi des impayés','Rapport de caisse']],
        ]; @endphp
        <div x-data="portals()" x-init="start()" @mouseenter="stop()" @mouseleave="start()"
             class="grid lg:grid-cols-2 gap-10 lg:gap-14 items-start">

            {{-- LEFT: heading + option list --}}
            <div class="reveal">
                <span class="inline-block bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">7 portails dédiés</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-ink leading-tight">Chacun son espace,<br>une seule vérité</h2>
                <p class="mt-4 text-muted">Chaque utilisateur voit exactement ce dont il a besoin — ni plus, ni moins.</p>

                <div class="mt-8 space-y-2.5">
                    @foreach($portals as $i => $p)
                    <button type="button" @click="go({{ $i }})"
                            class="w-full text-left flex items-center gap-3 rounded-2xl border px-4 py-3 transition cursor-pointer"
                            :class="active==={{ $i }} ? 'border-brand-500 bg-brand-50 shadow-[0_10px_26px_-14px_rgba(124,58,237,0.55)]' : 'border-[#ecebf3] bg-white hover:border-brand-200'">
                        <span class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-colors"
                              :class="active==={{ $i }} ? 'bg-brand-600 text-white' : 'bg-brand-50 text-brand-600'">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $p[0] !!}</svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="font-bold text-ink text-sm leading-tight">{{ $p[1] }}</p>
                            <p class="text-xs text-muted truncate">{{ $p[3] }}</p>
                        </div>
                        <svg x-show="active==={{ $i }}" x-cloak class="w-4 h-4 text-brand-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- RIGHT: preview panel --}}
            <div class="reveal relative card rounded-3xl overflow-hidden min-h-[440px] lg:sticky lg:top-24">
                @foreach($portals as $i => $p)
                <div x-show="active==={{ $i }}" x-cloak x-transition.opacity.duration.400ms class="absolute inset-0 p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-2.5 py-1 rounded-full">{{ $p[3] }}</span>
                        <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full whitespace-nowrap">✓ {{ $p[2] }}</span>
                    </div>
                    <div class="flex items-center gap-3 mt-5">
                        <span class="w-11 h-11 rounded-xl bg-brand-600 text-white flex items-center justify-center shrink-0"><svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $p[0] !!}</svg></span>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-muted">Portail</p>
                            <h3 class="text-xl font-extrabold text-ink leading-tight">{{ $p[1] }}</h3>
                        </div>
                    </div>
                    <p class="text-muted text-sm mt-3">{{ $p[4] }}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mt-5">
                        @foreach(array_slice($p[5], 0, 3) as $cap)
                        <div class="flex items-center gap-2.5 rounded-xl border border-[#ecebf3] bg-[#faf9ff] px-3 py-2.5">
                            <span class="w-6 h-6 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>
                            <p class="text-sm font-semibold text-ink">{{ $cap }}</p>
                        </div>
                        @endforeach
                        <div class="flex items-center gap-2.5 rounded-xl border border-dashed border-brand-300 bg-brand-50 px-3 py-2.5">
                            <span class="w-6 h-6 rounded-md bg-brand-600 text-white flex items-center justify-center shrink-0"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg></span>
                            <p class="text-sm font-bold text-brand-700">+{{ count($p[5]) - 3 }} modules</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- legend --}}
        <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mt-12 text-xs font-medium text-muted reveal">
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/></svg>Multi-écoles</span>
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="7.5" cy="15.5" r="5.5"/><path d="m21 2-9.6 9.6M15.5 7.5l3 3L22 7l-3-3"/></svg>Accès par rôle</span>
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>Données cloisonnées</span>
            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20z"/></svg>FR · ع · EN</span>
        </div>
    </div>
</section>

{{-- ══════════════ STATS ══════════════ --}}
<section class="bg-brand-600 py-16">
    <div class="max-w-5xl mx-auto px-5 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center text-white">
        @foreach([['99','%','Moins de paperasse'],['2',' canaux','Email + WhatsApp'],['4','','Solutions de paiement'],['7','','Portails dédiés']] as $s)
        <div class="reveal">
            <p class="text-4xl sm:text-5xl font-extrabold counter" data-count="{{ $s[0] }}" data-suffix="{{ $s[1] }}">0</p>
            <p class="mt-2 text-sm text-white/80">{{ $s[2] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ══════════════ TESTIMONIALS ══════════════ --}}
<section id="avis" class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <span class="inline-block bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">Ils nous font confiance</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-ink leading-tight">Adopté par les écoles,<br><span class="text-brand-600">plébiscité par les familles</span></h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['Depuis RaedApp, nous avons divisé par trois le temps passé sur la comptabilité. Les relances d\'impayés partent toutes seules.','MO','Mariam Osman','Comptable'],
                ['Les parents reçoivent le reçu sur WhatsApp en quelques secondes. Fini les justificatifs papier perdus.','AD','Ahmed Diriye','Directeur'],
                ['Je saisis les notes en ligne et les bulletins se génèrent automatiquement. Un gain de temps énorme.','AH','Amina Hassan','Enseignante'],
                ['Payer la scolarité en ligne avec D-Money, c\'est si simple. Et je suis les absences de mon fils en direct.','FA','Fatouma Ali','Parent d\'élève'],
                ['La console multi-écoles nous permet de piloter nos 3 établissements depuis un seul endroit.','KA','Khadija Abdi','Proviseure'],
                ['Interface en arabe et en français : toute l\'équipe l\'a prise en main en une journée.','OW','Omar Warsame','Surveillant'],
            ] as $t)
            <div class="reveal card card-lift rounded-2xl p-6">
                <div class="flex gap-0.5 text-amber-400 mb-3">
                    @for($i=0;$i<5;$i++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.9 3.1 1.1-6.6L.4 6.9l6.6-1L10 0l3 5.9 6.6 1-4.8 4.6 1.1 6.6z"/></svg>@endfor
                </div>
                <p class="text-muted leading-relaxed mb-5 text-[15px]">« {{ $t[0] }} »</p>
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 font-bold text-sm flex items-center justify-center shrink-0">{{ $t[1] }}</span>
                    <div><p class="font-semibold text-ink text-sm">{{ $t[2] }}</p><p class="text-xs text-muted">{{ $t[3] }}</p></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ FAQ ══════════════ --}}
<section id="faq" class="bg-[#faf9ff] border-y border-[#ecebf3] py-24">
    <div class="max-w-3xl mx-auto px-5">
        <div class="text-center mb-12 reveal">
            <span class="inline-block bg-white border border-[#ecebf3] text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">Questions fréquentes</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-ink">Tout ce que vous devez savoir</h2>
            <p class="mt-4 text-muted">Des réponses rapides — pour en savoir plus, contactez-nous.</p>
        </div>

        @php $faqs=[
            ['Faut-il installer un logiciel ou du matériel ?','Non. RaedApp est 100% en ligne — accessible depuis n\'importe quel navigateur, ordinateur ou téléphone. Aucune installation, aucune maintenance de votre côté.'],
            ['Comment les parents paient-ils la scolarité ?','En ligne en un clic (D-Money, Waafi, CAC Pay, Exim Pay) ou au guichet (espèces, virement, chèque, mobile money). Chaque paiement génère un reçu PDF envoyé par Email et WhatsApp.'],
            ['Les notifications WhatsApp sont-elles vraiment automatiques ?','Oui. Absences, factures, reçus, rappels d\'échéance et relances d\'impayés partent automatiquement — par Email et WhatsApp — sans aucune action manuelle.'],
            ['L\'application est-elle disponible en arabe ?','Oui : interface complète en français, arabe (affichage de droite à gauche) et anglais. Chaque utilisateur choisit sa langue.'],
            ['Mes données scolaires et financières sont-elles sécurisées ?','Absolument. Accès par rôles (chacun ne voit que ce qui le concerne), connexions chiffrées (HTTPS) et journal d\'audit de chaque action sensible.'],
            ['Combien de temps pour démarrer ?','Quelques jours. Nous configurons vos cycles, classes, frais et utilisateurs, puis vos équipes et parents reçoivent leurs accès.'],
            ['Peut-on gérer plusieurs écoles ?','Oui. La console multi-écoles pilote plusieurs établissements, avec abonnements et facturation centralisés — idéal pour les groupes scolaires.'],
            ['Peut-on connecter nos outils existants ?','Oui. RaedApp expose une API REST sécurisée et des webhooks, et s\'intègre aux passerelles de paiement, WhatsApp, email et services tiers à la demande.'],
        ]; @endphp

        <div class="space-y-3">
            @foreach($faqs as $i => $q)
            <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }" class="reveal card rounded-2xl overflow-hidden">
                <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-4 text-left px-5 py-4 cursor-pointer" :class="open ? 'bg-brand-50/50' : ''">
                    <span class="font-semibold text-ink text-sm sm:text-base">{{ $q[0] }}</span>
                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-all duration-300"
                          :class="open ? 'bg-brand-600 text-white rotate-45' : 'bg-brand-50 text-brand-600'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2.5" d="M12 5v14M5 12h14"/></svg>
                    </span>
                </button>
                <div x-show="open" x-collapse x-cloak>
                    <p class="px-5 pb-5 text-muted text-sm leading-relaxed">{{ $q[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ CTA + CONTACT ══════════════ --}}
<section id="contact" class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-5 grid lg:grid-cols-2 gap-12 items-center">
        <div class="reveal">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-ink leading-tight">Prêt à digitaliser<br>votre école ?</h2>
            <p class="mt-5 text-muted leading-relaxed">Demandez une démonstration gratuite. Nous vous montrons RaedApp en action, adapté à votre établissement.</p>
            <div class="mt-8 space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    </div>
                    <div><p class="text-xs text-muted uppercase tracking-widest">Email</p><p class="font-semibold text-ink">contact@raedapp.com</p></div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div><p class="text-xs text-muted uppercase tracking-widest">WhatsApp</p><p class="font-semibold text-ink">Réponse rapide, 7j/7</p></div>
                </div>
            </div>
        </div>
        <div class="reveal">
            <div class="card rounded-3xl p-8">
                <h3 class="text-lg font-extrabold text-ink mb-6">Envoyer un message</h3>
                <form @submit.prevent="submitContact()" class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="text" x-model="contact.name" required placeholder="Nom complet" class="w-full rounded-xl border border-[#ecebf3] px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                        <input type="email" x-model="contact.email" required placeholder="Email" class="w-full rounded-xl border border-[#ecebf3] px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    </div>
                    <input type="text" x-model="contact.school" placeholder="Nom de votre école" class="w-full rounded-xl border border-[#ecebf3] px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    <input type="tel" x-model="contact.phone" placeholder="Téléphone (+253 …)" class="w-full rounded-xl border border-[#ecebf3] px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    <textarea x-model="contact.message" required rows="3" placeholder="Votre message…" class="w-full rounded-xl border border-[#ecebf3] px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition resize-none"></textarea>
                    <button type="submit" :disabled="contactSent || contactLoading" class="btn-primary pill w-full py-3.5 font-semibold flex items-center justify-center gap-2 cursor-pointer">
                        <template x-if="contactLoading"><svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.4 0 0 5.4 0 12h4z"/></svg></template>
                        <template x-if="!contactLoading && !contactSent"><span>Envoyer le message</span></template>
                        <template x-if="contactSent && !contactLoading"><span>✅ Message envoyé !</span></template>
                    </button>
                    <p x-show="contactSent" x-cloak class="text-center text-emerald-600 text-sm">Merci ! Un email de confirmation vous a été envoyé.</p>
                    <p x-show="contactError" x-cloak x-text="contactError" class="text-center text-red-500 text-sm"></p>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ FOOTER ══════════════ --}}
<footer class="bg-ink text-white pt-14 pb-8">
    <div class="max-w-6xl mx-auto px-5">
        <div class="grid md:grid-cols-4 gap-10 mb-10">
            <div>
                <div class="flex items-center gap-2.5 mb-4">
                    <img src="{{ asset('images/logoraedapp.png') }}" alt="RaedApp" class="h-8 w-8">
                    <span class="font-extrabold text-lg">Raed<span class="text-brand-400">App</span></span>
                </div>
                <p class="text-sm text-white/55 leading-relaxed">La plateforme de gestion scolaire nouvelle génération, pensée pour Djibouti et l'Afrique.</p>
            </div>
            <div>
                <p class="font-semibold text-sm mb-4">Produit</p>
                <ul class="space-y-2.5 text-sm text-white/55">
                    <li><a href="#demo" class="hover:text-white transition">Démo</a></li>
                    <li><a href="#fonctionnalites" class="hover:text-white transition">Fonctionnalités</a></li>
                    <li><a href="#portails" class="hover:text-white transition">Portails</a></li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-sm mb-4">Paiement</p>
                <ul class="space-y-2.5 text-sm text-white/55"><li>D-Money</li><li>Waafi</li><li>CAC Pay</li><li>Exim Pay</li></ul>
            </div>
            <div>
                <p class="font-semibold text-sm mb-4">Compte</p>
                <ul class="space-y-2.5 text-sm text-white/55">
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Se connecter</a></li>
                    <li><a href="#contact" class="hover:text-white transition">Demander une démo</a></li>
                    <li><a href="#faq" class="hover:text-white transition">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-white/45">
            <p>© {{ date('Y') }} RaedApp. Tous droits réservés.</p>
            <p class="flex items-center gap-2">Fait avec <span class="text-brand-400">♥</span> pour les écoles.</p>
        </div>
    </div>
</footer>

<script>
    // Auto-cycling demo tour (hero)
    function demo() {
        return {
            active: 0,
            count: 5,
            timer: null,
            titles: ['Élèves','Présences','Bulletins','Paiements','Communication'],
            start() {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
                this.stop();
                this.timer = setInterval(() => { this.active = (this.active + 1) % this.count; }, 3200);
            },
            stop() { if (this.timer) { clearInterval(this.timer); this.timer = null; } },
            go(i) { this.active = i; this.start(); }
        };
    }

    // Portals tabbed showcase
    function portals() {
        return {
            active: 0,
            count: 7,
            timer: null,
            start() {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
                this.stop();
                this.timer = setInterval(() => { this.active = (this.active + 1) % this.count; }, 3600);
            },
            stop() { if (this.timer) { clearInterval(this.timer); this.timer = null; } },
            go(i) { this.active = i; this.start(); }
        };
    }

    function site() {
        return {
            scrolled: false,
            mobileOpen: false,
            contact: { name:'', email:'', school:'', phone:'', message:'' },
            contactLoading: false, contactSent: false, contactError: '',

            init() {
                requestAnimationFrame(() => requestAnimationFrame(() => document.body.classList.add('is-ready')));

                const onScroll = () => { this.scrolled = window.scrollY > 20; };
                window.addEventListener('scroll', onScroll, { passive:true }); onScroll();

                const io = new IntersectionObserver((e) => {
                    e.forEach(x => { if (x.isIntersecting) { x.target.classList.add('in'); io.unobserve(x.target); } });
                }, { threshold:0.12, rootMargin:'0px 0px -60px 0px' });
                document.querySelectorAll('.reveal').forEach(el => io.observe(el));

                const cio = new IntersectionObserver((e) => {
                    e.forEach(x => {
                        if (!x.isIntersecting) return;
                        const el = x.target, target = parseInt(el.dataset.count,10)||0, suffix = el.dataset.suffix||'';
                        let cur = 0; const step = Math.max(1, Math.ceil(target/40));
                        const t = setInterval(() => { cur += step; if (cur>=target){cur=target;clearInterval(t);} el.textContent = cur.toLocaleString('fr-FR') + suffix; }, 26);
                        cio.unobserve(el);
                    });
                }, { threshold:0.5 });
                document.querySelectorAll('.counter').forEach(el => cio.observe(el));

                this.initMotion();
            },

            initMotion() {
                const bar = document.querySelector('.scroll-progress');
                if (bar) {
                    const onProg = () => { const h = document.documentElement, m = h.scrollHeight - h.clientHeight; bar.style.setProperty('--sp', (m>0 ? h.scrollTop/m : 0).toFixed(4)); };
                    window.addEventListener('scroll', onProg, { passive:true }); window.addEventListener('resize', onProg, { passive:true }); onProg();
                }
                const ok = window.matchMedia('(hover:hover) and (pointer:fine)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                if (!ok) return;
                this._magnetic(); this._tilt();
            },

            _magnetic() {
                document.querySelectorAll('[data-magnetic]').forEach(el => {
                    const s = parseFloat(el.dataset.magnetic)||0.3;
                    el.addEventListener('pointermove', (e) => { const r = el.getBoundingClientRect(); el.style.transition='translate 0s'; el.style.translate = `${((e.clientX-r.left-r.width/2)*s).toFixed(2)}px ${((e.clientY-r.top-r.height/2)*s).toFixed(2)}px`; });
                    el.addEventListener('pointerleave', () => { el.style.transition='translate .4s cubic-bezier(0.22,1,0.36,1)'; el.style.translate='0 0'; });
                });
            },

            _tilt() {
                document.querySelectorAll('[data-tilt]').forEach(el => {
                    const max = parseFloat(el.dataset.tilt)||6;
                    el.addEventListener('pointerenter', () => { el.style.transition='transform 0s'; });
                    el.addEventListener('pointermove', (e) => { const r = el.getBoundingClientRect(); const px=(e.clientX-r.left)/r.width-0.5, py=(e.clientY-r.top)/r.height-0.5; el.style.transform = `perspective(800px) rotateX(${(-py*max).toFixed(2)}deg) rotateY(${(px*max).toFixed(2)}deg)`; });
                    el.addEventListener('pointerleave', () => { el.style.transition='transform .5s cubic-bezier(0.22,1,0.36,1)'; el.style.transform='perspective(800px) rotateX(0deg) rotateY(0deg)'; });
                });
            },

            async submitContact() {
                this.contactLoading = true; this.contactError = '';
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                try {
                    const res = await fetch('{{ route("contact.store") }}', { method:'POST', headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':csrf}, body: JSON.stringify(this.contact) });
                    const data = await res.json();
                    if (res.ok) { this.contactSent = true; this.contact = { name:'', email:'', school:'', phone:'', message:'' }; }
                    else { const errs = data.errors ? Object.values(data.errors).flat() : []; this.contactError = errs[0] || data.message || 'Une erreur est survenue.'; }
                } catch (e) { this.contactError = "Impossible d'envoyer le message. Veuillez réessayer."; }
                finally { this.contactLoading = false; }
            }
        };
    }
</script>
</body>
</html>
