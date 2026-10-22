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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Caveat:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter','ui-sans-serif','system-ui'], hand: ['Caveat','cursive'] },
                    colors: {
                        brand: { 50:'#f3effe',100:'#ede9fe',200:'#ddd6fe',300:'#c4b5fd',400:'#a78bfa',500:'#8b5cf6',600:'#7c3aed',700:'#6d28d9' },
                        ink: '#17132b',
                    },
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary:#7c3aed; --primary-500:#8b5cf6; --primary-600:#6d28d9;
            --ink:#17132b; --muted:#6b6880;
            --ease-out: cubic-bezier(0.23, 1, 0.32, 1);
            --shadow-soft: 0 18px 50px -20px rgba(91,51,173,0.28);
            --shadow-card: 0 10px 30px -12px rgba(91,51,173,0.18);
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f5f3ff; color: var(--ink); }
        ::selection { background: #ddd6fe; color: #4c1d95; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #efeaff; }
        ::-webkit-scrollbar-thumb { background: #d3c6f5; border-radius: 6px; }
        ::-webkit-scrollbar-thumb:hover { background: #b9a4ee; }
        h1,h2,h3 { letter-spacing: -0.025em; }

        /* Soft lavender aurora background for the hero */
        .hero-aura {
            background:
                radial-gradient(900px 540px at 85% 8%, rgba(167,139,250,0.35), transparent 60%),
                radial-gradient(760px 520px at 8% 30%, rgba(196,181,253,0.30), transparent 58%),
                linear-gradient(180deg, #efeaff 0%, #f5f3ff 60%, #ffffff 100%);
        }
        .dotgrid {
            background-image: radial-gradient(rgba(124,58,237,0.22) 1.4px, transparent 1.4px);
            background-size: 16px 16px;
        }
        .blob { position:absolute; border-radius:50%; filter: blur(70px); opacity:.5; pointer-events:none; }

        .hand { font-family:'Caveat',cursive; color:#7c3aed; }

        /* Primary pill button */
        .btn-primary {
            position:relative; overflow:hidden;
            background: linear-gradient(100deg,#7c3aed,#8b5cf6 55%,#a855f7);
            color:#fff; box-shadow: 0 14px 30px -10px rgba(124,58,237,0.55);
            transition: transform .18s var(--ease-out), box-shadow .3s, background-position .5s;
            background-size: 200% 100%;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 20px 40px -10px rgba(124,58,237,0.6); background-position:100% 0; }
        .btn-primary:active { transform: translateY(0) scale(.98); transition-duration:.09s; }
        .btn-primary::after {
            content:''; position:absolute; inset:0; pointer-events:none;
            background: linear-gradient(105deg, transparent 32%, rgba(255,255,255,0.45) 50%, transparent 68%);
            transform: translateX(-130%);
        }
        @media (hover:hover) and (pointer:fine){ .btn-primary:hover::after{ transform:translateX(130%); transition: transform .7s var(--ease-out);} }

        .btn-ghost { transition: background-color .2s, color .2s, transform .18s var(--ease-out); }
        .btn-ghost:hover { background:#f3effe; }
        .btn-ghost:active { transform: scale(.98); }

        .card { background:#fff; box-shadow: var(--shadow-card); }
        .card-lift { transition: transform .35s var(--ease-out), box-shadow .35s var(--ease-out); }
        .card-lift:hover { transform: translateY(-6px); box-shadow: var(--shadow-soft); }

        /* Scroll reveal */
        .reveal { opacity:0; transform: translateY(26px); transition: opacity .7s var(--ease-out), transform .7s var(--ease-out); }
        .reveal.in { opacity:1; transform:none; }

        /* Scroll progress */
        .scroll-progress { height:100%; transform-origin:left center; transform:scaleX(var(--sp,0)); will-change:transform; }

        [data-tilt],[data-magnetic],[data-parallax]{ will-change: transform; }
        [x-cloak]{ display:none !important; }

        /* Phone mockup */
        .phone { background:#0f0b1e; border-radius:46px; box-shadow: 0 40px 80px -30px rgba(76,29,149,0.5), 0 0 0 2px rgba(255,255,255,0.04) inset; }
        .phone-screen { background: linear-gradient(180deg,#ffffff,#f7f5ff); border-radius:36px; overflow:hidden; }

        /* Donut progress */
        .donut { border-radius:50%; background: conic-gradient(#7c3aed calc(var(--v,0)*1%), #ede9fe 0); }

        @media (prefers-reduced-motion: reduce) {
            *,*::before,*::after { animation-duration:.001ms !important; transition-duration:.001ms !important; }
            .reveal { opacity:1 !important; transform:none !important; }
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
        <div class="flex items-center justify-between gap-4 bg-white/80 backdrop-blur-xl rounded-2xl pl-4 pr-3 py-2.5 shadow-[0_8px_30px_-12px_rgba(91,51,173,0.22)] border border-white">
            <a href="#top" class="flex items-center gap-2.5 shrink-0">
                <img src="{{ asset('images/logoraedapp.png') }}" alt="RaedApp" class="h-9 w-9">
                <span class="font-extrabold text-lg text-ink">Raed<span class="text-brand-600">App</span></span>
            </a>
            <div class="hidden lg:flex items-center gap-1 text-sm font-medium text-slate-600">
                <a href="#top"            class="px-3 py-2 rounded-lg text-brand-600 font-semibold">Accueil</a>
                <a href="#fonctionnalites" class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Fonctionnalités</a>
                <a href="#portails"        class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Portails</a>
                <a href="#avis"            class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Avis</a>
                <a href="#tarifs"          class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Tarifs</a>
                <a href="#faq"             class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">FAQ</a>
                <a href="#contact"         class="px-3 py-2 rounded-lg hover:text-ink hover:bg-brand-50 transition">Contact</a>
            </div>
            <div class="hidden lg:flex items-center gap-2">
                <a href="{{ route('login') }}" class="btn-ghost text-sm font-semibold text-slate-700 px-4 py-2.5 rounded-xl">Se connecter</a>
                <a href="{{ route('register') }}" data-magnetic="0.25" class="btn-primary text-sm font-semibold px-5 py-2.5 rounded-xl">Essayer maintenant</a>
            </div>
            <button @click="mobileOpen=!mobileOpen" class="lg:hidden p-2 text-ink">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div x-show="mobileOpen" x-cloak x-transition class="lg:hidden mt-2 bg-white rounded-2xl p-4 space-y-1 shadow-lg border border-slate-100">
            <a href="#fonctionnalites" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Fonctionnalités</a>
            <a href="#portails" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Portails</a>
            <a href="#avis" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Avis</a>
            <a href="#tarifs" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Tarifs</a>
            <a href="#faq" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">FAQ</a>
            <a href="#contact" @click="mobileOpen=false" class="block px-3 py-2 rounded-lg hover:bg-brand-50">Contact</a>
            <div class="pt-2 flex gap-2">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-xl border border-slate-200 font-semibold text-sm">Connexion</a>
                <a href="{{ route('register') }}" class="flex-1 text-center btn-primary py-2.5 rounded-xl font-semibold text-sm">Essayer</a>
            </div>
        </div>
    </div>
</nav>

{{-- ══════════════ HERO ══════════════ --}}
<section id="top" class="hero-aura relative overflow-hidden pt-36 lg:pt-40 pb-20">
    <div class="blob" style="width:380px;height:380px;background:#c4b5fd;top:-80px;right:-60px;" data-parallax="0.5"></div>
    <div class="blob" style="width:320px;height:320px;background:#a78bfa;bottom:40px;left:-80px;opacity:.35;" data-parallax="0.7"></div>

    <div class="relative max-w-5xl mx-auto px-5 text-center">
        <h1 class="text-4xl sm:text-6xl font-black leading-[1.05] text-ink">
            Prenez le contrôle<br>de votre <span class="text-brand-600">école</span>
        </h1>
        <p class="mt-6 text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
            Une plateforme complète pour gérer <strong class="text-slate-700">inscriptions, présences, notes et finances</strong> —
            et encaisser la scolarité en ligne, en toute sérénité.
        </p>
        <div class="mt-9 flex flex-col sm:flex-row gap-3 justify-center items-center">
            <a href="{{ route('register') }}" data-magnetic="0.28" class="btn-primary font-semibold px-7 py-4 rounded-2xl w-full sm:w-auto">Créer mon compte</a>
            <a href="#demo" class="btn-ghost group flex items-center gap-3 font-semibold text-slate-700 px-5 py-4 rounded-2xl">
                <span class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-brand-600 group-hover:scale-105 transition">
                    <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6 4l10 6-10 6V4z"/></svg>
                </span>
                Voir la démo
            </a>
        </div>
    </div>

    {{-- Hero visual: phone mockup + floating cards + annotations --}}
    <div id="demo" class="relative max-w-5xl mx-auto px-5 mt-14">
        {{-- handwritten annotations (desktop) --}}
        <div class="hidden lg:block absolute left-0 top-10 w-52 text-right" data-parallax="-0.2">
            <p class="hand text-2xl leading-tight">Une gestion<br>plus simple<br>au quotidien</p>
            <svg class="w-16 h-10 ml-auto mt-1 text-brand-400" viewBox="0 0 64 40" fill="none"><path d="M2 4 C 30 6, 50 14, 58 34" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M58 34 l-9 -3 M58 34 l-1 -9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
        </div>
        <div class="hidden lg:block absolute right-0 top-14 w-52" data-parallax="-0.2">
            <p class="hand text-2xl leading-tight">Des projets<br>plus grands<br>demain</p>
            <svg class="w-16 h-10 mt-1 text-brand-400" viewBox="0 0 64 40" fill="none"><path d="M62 4 C 34 6, 14 14, 6 34" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M6 34 l9 -3 M6 34 l1 -9" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
        </div>

        <div class="relative flex justify-center">
            {{-- Phone --}}
            <div class="phone p-2.5 w-[300px] shrink-0 relative z-10" data-parallax="-0.12">
                <div class="phone-screen p-4 h-[560px]">
                    <div class="flex items-center justify-between text-[11px] font-semibold text-slate-500 px-1 pt-1">
                        <span>9:41</span>
                        <span class="flex items-center gap-1"><svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M2 20h3V10H2v10zm5 0h3V4H7v16zm5 0h3V12h-3v8zm5 0h3V7h-3v13z"/></svg> <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 18a2 2 0 100 4 2 2 0 000-4zM4.5 10.5a10.6 10.6 0 0115 0l-1.8 1.8a8 8 0 00-11.4 0l-1.8-1.8z"/></svg></span>
                    </div>
                    <div class="mt-4">
                        <p class="text-xl font-extrabold text-ink">Bonjour, Mariam !</p>
                        <p class="text-xs text-slate-400">Voici la situation de l'école aujourd'hui</p>
                    </div>
                    {{-- balance card --}}
                    <div class="mt-4 rounded-2xl p-4 text-white relative overflow-hidden" style="background:linear-gradient(135deg,#7c3aed,#8b5cf6 60%,#a855f7);">
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-white/80">Encaissé ce mois</p>
                            <span class="text-[10px] bg-white/20 rounded-full px-2 py-0.5">●●●</span>
                        </div>
                        <p class="text-2xl font-black mt-1">2 840 000 <span class="text-sm font-semibold">FDJ</span></p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-[11px] font-semibold text-emerald-200">↗ +12 %</span>
                            <svg class="w-28 h-7" viewBox="0 0 120 30" fill="none"><path d="M2 24 L20 18 L38 21 L56 12 L74 15 L92 6 L118 3" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.9"/></svg>
                        </div>
                    </div>
                    {{-- actions --}}
                    <div class="grid grid-cols-4 gap-2 mt-4 text-center">
                        @foreach([['↑','Encaisser'],['↓','Relancer'],['▦','Rapports'],['⋯','Plus']] as $a)
                        <div>
                            <div class="w-12 h-12 mx-auto rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-lg font-bold">{{ $a[0] }}</div>
                            <p class="text-[10px] text-slate-500 mt-1">{{ $a[1] }}</p>
                        </div>
                        @endforeach
                    </div>
                    {{-- recent --}}
                    <div class="mt-4">
                        <p class="text-xs font-semibold text-slate-400 mb-2">Paiements reçus</p>
                        <div class="space-y-2">
                            @foreach([['🎓','Scolarité','Fatima A.','+45 000'],['🍽️','Cantine','Omar D.','+12 000'],['🚌','Transport','Idris H.','+8 000']] as $r)
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-sm">{{ $r[0] }}</span>
                                <div class="flex-1 min-w-0"><p class="text-xs font-semibold text-ink truncate">{{ $r[1] }}</p><p class="text-[10px] text-slate-400">{{ $r[2] }}</p></div>
                                <span class="text-xs font-bold text-emerald-600">{{ $r[3] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Floating card: recent (left) --}}
            <div class="hidden md:block absolute left-0 xl:-left-6 top-16 w-60 card rounded-2xl p-4 z-20" data-parallax="0.35">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-bold text-ink">Dépenses récentes</p>
                    <span class="text-slate-300">›</span>
                </div>
                <div class="space-y-3">
                    @foreach([['🛒','Fournitures','12 avr','- 62 000','bg-emerald-50'],['🚐','Carburant bus','10 avr','- 28 000','bg-sky-50'],['⚽','Activités','8 avr','- 45 000','bg-fuchsia-50']] as $d)
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 rounded-xl {{ $d[4] }} flex items-center justify-center text-sm">{{ $d[0] }}</span>
                        <div class="flex-1 min-w-0"><p class="text-xs font-semibold text-ink">{{ $d[1] }}</p><p class="text-[10px] text-slate-400">{{ $d[2] }}</p></div>
                        <span class="text-xs font-bold text-slate-700">{{ $d[3] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Floating card: objective donut (right) --}}
            <div class="hidden md:block absolute right-0 xl:-right-6 bottom-6 w-56 card rounded-2xl p-4 z-20" data-parallax="0.45">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-bold text-ink">Recouvrement</p>
                    <span class="text-slate-300">⋯</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="donut w-20 h-20 shrink-0 flex items-center justify-center" style="--v:92;">
                        <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center font-black text-brand-600">92%</div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-ink leading-tight">Objectif<br>du trimestre</p>
                        <p class="text-[11px] text-slate-400 mt-1">4,6 M sur 5 M FDJ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ TRUST BAR ══════════════ --}}
<section class="bg-white py-14">
    <div class="max-w-5xl mx-auto px-5">
        <p class="text-center font-semibold text-ink mb-8">Plus de 2 000 familles nous font déjà confiance</p>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['🛡️','Sécurité renforcée'],
                ['⚡','Simple à utiliser'],
                ['🌍','FR · العربية · EN'],
                ['💳','Paiement en ligne'],
            ] as $t)
            <div class="reveal flex items-center gap-3 justify-center lg:justify-start">
                <span class="w-11 h-11 rounded-full bg-brand-600 text-white flex items-center justify-center text-lg shrink-0 shadow-[0_8px_20px_-8px_rgba(124,58,237,0.6)]">{{ $t[0] }}</span>
                <span class="font-semibold text-sm text-ink">{{ $t[1] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ ADVANTAGES ══════════════ --}}
<section id="fonctionnalites" class="bg-white pt-10 pb-24">
    <div class="max-w-6xl mx-auto px-5">
        <div class="text-center mb-14 reveal">
            <span class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">
                <img src="{{ asset('images/logoraedapp.png') }}" class="w-4 h-4" alt=""> Nos avantages
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-ink leading-tight">Une plateforme pensée<br>pour vous <span class="text-brand-600">simplifier la vie</span></h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            {{-- card 1 --}}
            <div data-tilt="5" class="card-lift bg-brand-50/60 rounded-3xl p-8 border border-brand-100">
                <span class="w-12 h-12 rounded-full bg-brand-600 text-white flex items-center justify-center text-xl mb-5">👤</span>
                <h3 class="text-xl font-extrabold text-ink mb-2">Inscrivez vos élèves en quelques clics</h3>
                <p class="text-slate-500 mb-6">Créez les dossiers élèves, reliez les parents et les classes, et générez les accès automatiquement.</p>
                <div class="bg-white rounded-2xl p-5 flex items-center justify-between shadow-sm">
                    <div class="flex -space-x-3">
                        @foreach(['bg-brand-400','bg-fuchsia-400','bg-sky-400'] as $c)
                        <span class="w-11 h-11 rounded-full {{ $c }} border-2 border-white flex items-center justify-center text-white text-lg">🧑</span>
                        @endforeach
                        <span class="w-11 h-11 rounded-full bg-brand-600 border-2 border-white flex items-center justify-center text-white">+</span>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400">Plus de</p>
                        <p class="text-2xl font-black text-ink counter" data-count="20000" data-suffix="">0</p>
                        <p class="text-xs text-slate-400">élèves gérés</p>
                    </div>
                </div>
            </div>

            {{-- card 2 --}}
            <div data-tilt="5" class="card-lift bg-slate-50 rounded-3xl p-8 border border-slate-100">
                <span class="w-12 h-12 rounded-full bg-brand-600 text-white flex items-center justify-center text-xl mb-5">🔗</span>
                <h3 class="text-xl font-extrabold text-ink mb-2">Connectez tous vos moyens de paiement</h3>
                <p class="text-slate-500 mb-6">Encaissez la scolarité via D-Money, Waafi, CAC Pay et Exim Pay — réconciliées automatiquement.</p>
                <div class="bg-white rounded-2xl p-6 shadow-sm relative flex items-center justify-center gap-10">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['🏦','📊','💳','🌱'] as $i)
                        <span class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-lg">{{ $i }}</span>
                        @endforeach
                    </div>
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <span class="w-14 h-14 rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-lg">
                            <img src="{{ asset('images/logoraedapp.png') }}" class="w-8 h-8" alt="">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ FEATURES 3-UP ══════════════ --}}
<section class="bg-[#f5f3ff] py-24">
    <div class="max-w-6xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <h2 class="text-3xl sm:text-4xl font-black text-ink">Tout ce dont votre école a besoin</h2>
            <p class="mt-4 text-slate-500">De la maternelle au lycée — académique, finances et communication, réunis.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['🎓','Vie académique','Notes, bulletins, présences et emplois du temps en ligne, à jour en temps réel.'],
                ['💰','Finances & recouvrement','Factures, paiements en ligne, réconciliation et relances automatiques des impayés.'],
                ['💬','Communication','Email + WhatsApp automatiques : reçus, absences, rappels d\'échéance et annonces.'],
            ] as $i => $f)
            <div data-tilt="6" class="card card-lift rounded-3xl p-7 reveal" style="transition-delay: {{ $i*80 }}ms">
                <span class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl mb-4">{{ $f[0] }}</span>
                <h3 class="text-lg font-extrabold text-ink mb-2">{{ $f[1] }}</h3>
                <p class="text-slate-500 text-sm leading-relaxed">{{ $f[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ PORTALS ══════════════ --}}
<section id="portails" class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <span class="inline-block bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">7 portails dédiés</span>
            <h2 class="text-3xl sm:text-4xl font-black text-ink">Chacun son espace, une seule vérité</h2>
            <p class="mt-4 text-slate-500">Chaque utilisateur voit exactement ce dont il a besoin — ni plus, ni moins.</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach([
                ['⚙️','Plateforme'],['🏫','Administration'],['👨‍🏫','Enseignant'],['🧑‍✈️','Surveillant'],
                ['👪','Parent'],['🎒','Élève'],['🧾','Caissier'],['📊','Direction'],
            ] as $p)
            <div data-tilt="7" class="card card-lift rounded-2xl p-5 text-center reveal">
                <span class="w-12 h-12 mx-auto rounded-2xl bg-brand-50 flex items-center justify-center text-xl mb-3">{{ $p[0] }}</span>
                <p class="font-semibold text-sm text-ink">{{ $p[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ STATS ══════════════ --}}
<section class="bg-[#f5f3ff] py-20">
    <div class="max-w-5xl mx-auto px-5 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
        @foreach([['99','%','Moins de paperasse'],['2',' canaux','Email + WhatsApp'],['4','','Solutions de paiement'],['7','','Portails dédiés']] as $s)
        <div class="reveal">
            <p class="text-4xl sm:text-5xl font-black text-brand-600 counter" data-count="{{ $s[0] }}" data-suffix="{{ $s[1] }}">0</p>
            <p class="mt-2 text-sm text-slate-500">{{ $s[2] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ══════════════ TESTIMONIALS ══════════════ --}}
<section id="avis" class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <span class="inline-block bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">Ils nous font confiance</span>
            <h2 class="text-3xl sm:text-4xl font-black text-ink leading-tight">Adopté par les écoles,<br><span class="text-brand-600">plébiscité par les familles</span></h2>
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
            <div class="reveal card card-lift rounded-3xl p-6">
                <div class="flex gap-0.5 text-amber-400 mb-3 text-sm">★★★★★</div>
                <p class="text-slate-600 leading-relaxed mb-5 text-[15px]">« {{ $t[0] }} »</p>
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 font-bold text-sm flex items-center justify-center shrink-0">{{ $t[1] }}</span>
                    <div><p class="font-semibold text-ink text-sm">{{ $t[2] }}</p><p class="text-xs text-slate-400">{{ $t[3] }}</p></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ PRICING ══════════════ --}}
<section id="tarifs" class="bg-[#f5f3ff] py-24">
    <div class="max-w-6xl mx-auto px-5">
        <div class="text-center max-w-2xl mx-auto mb-14 reveal">
            <h2 class="text-3xl sm:text-4xl font-black text-ink">Un plan pour chaque établissement</h2>
            <p class="mt-4 text-slate-500">Payez selon votre taille. Sans engagement, sans frais cachés.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6 items-stretch">
            @php $plans=[
                ['Starter','Petites écoles',['Gestion académique complète','Présences & bulletins','Notifications Email','Support standard'], false],
                ['Pro','Le plus populaire',['Tout Starter, plus :','Paiement en ligne (4 solutions)','WhatsApp + réconciliation','Rapports & recouvrement'], true],
                ['Réseau','Groupes d\'écoles',['Tout Pro, plus :','Multi-écoles & multi-devises','Console SaaS centralisée','Accompagnement dédié'], false],
            ]; @endphp
            @foreach($plans as $pl)
            <div class="rounded-3xl p-8 reveal {{ $pl[3] ? 'bg-brand-600 text-white shadow-[0_30px_60px_-20px_rgba(124,58,237,0.55)] scale-[1.02]' : 'card' }}">
                @if($pl[3])<span class="inline-block bg-white/20 text-white text-[11px] font-bold px-3 py-1 rounded-full mb-3">POPULAIRE</span>@endif
                <h3 class="text-xl font-extrabold {{ $pl[3] ? 'text-white' : 'text-ink' }}">{{ $pl[0] }}</h3>
                <p class="text-sm {{ $pl[3] ? 'text-white/80' : 'text-slate-400' }} mt-1">{{ $pl[1] }}</p>
                <div class="my-6"><span class="text-sm {{ $pl[3] ? 'text-white/70' : 'text-slate-400' }}">à partir de</span><div class="text-3xl font-black">Sur devis</div></div>
                <ul class="space-y-3 text-sm mb-8 {{ $pl[3] ? 'text-white/90' : 'text-slate-600' }}">
                    @foreach($pl[2] as $feat)
                    <li class="flex gap-2.5"><span class="{{ $pl[3] ? 'text-white' : 'text-brand-600' }}">✓</span><span>{{ $feat }}</span></li>
                    @endforeach
                </ul>
                <a href="#contact" class="block text-center py-3 rounded-xl font-semibold transition {{ $pl[3] ? 'bg-white text-brand-700 hover:bg-brand-50' : 'btn-primary' }}">Demander un devis</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ COMPARISON ══════════════ --}}
<section class="bg-white py-24">
    <div class="max-w-4xl mx-auto px-5">
        <div class="text-center mb-14 reveal">
            <h2 class="text-3xl sm:text-4xl font-black text-ink">Pourquoi passer à RaedApp ?</h2>
            <p class="mt-4 text-slate-500">Fini les registres papier et les fichiers Excel dispersés.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-5 items-start">
            <div class="reveal rounded-3xl p-8 bg-slate-50 border border-slate-100">
                <h3 class="font-extrabold text-ink mb-5 flex items-center gap-2"><span class="text-xl">📁</span> Méthodes classiques</h3>
                <ul class="space-y-3 text-sm text-slate-500">
                    @foreach(['Registres papier et fichiers Excel dispersés','Parents informés en retard, voire jamais','Encaissements suivis à la main → erreurs','Aucune relance automatique → beaucoup d\'impayés','Bulletins produits dans la douleur en fin de trimestre','Rapports figés, jamais à jour'] as $x)
                    <li class="flex gap-2.5"><span class="text-slate-300 mt-0.5">✕</span><span>{{ $x }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="reveal rounded-3xl p-8 bg-brand-600 text-white shadow-[0_30px_60px_-20px_rgba(124,58,237,0.5)]">
                <h3 class="font-extrabold mb-5 flex items-center gap-2"><span class="text-xl">⚡</span> Avec RaedApp</h3>
                <ul class="space-y-3 text-sm text-white/90">
                    @foreach(['Tout numérique — factures &amp; reçus en PDF','Parents notifiés instantanément (Email + WhatsApp)','Encaissements en temps réel, par mode de paiement','Relances et rappels d\'échéance automatiques','Bulletins générés et publiés automatiquement','Rapports dynamiques, à jour à la seconde'] as $x)
                    <li class="flex gap-2.5"><span class="text-white mt-0.5">✓</span><span>{!! $x !!}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ FAQ ══════════════ --}}
<section id="faq" class="bg-[#f5f3ff] py-24">
    <div class="max-w-3xl mx-auto px-5">
        <div class="text-center mb-12 reveal">
            <span class="inline-block bg-brand-50 text-brand-700 text-sm font-semibold px-4 py-1.5 rounded-full mb-5">Questions fréquentes</span>
            <h2 class="text-3xl sm:text-4xl font-black text-ink">Tout ce que vous devez savoir</h2>
            <p class="mt-4 text-slate-500">Des réponses rapides — pour en savoir plus, contactez-nous.</p>
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
                <button type="button" @click="open = !open" class="w-full flex items-center justify-between gap-4 text-left px-5 py-4" :class="open ? 'bg-brand-50/50' : ''">
                    <span class="font-semibold text-ink text-sm sm:text-base">{{ $q[0] }}</span>
                    <span class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-all duration-300"
                          :class="open ? 'bg-brand-600 text-white rotate-45' : 'bg-brand-50 text-brand-600'">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-width="2.5" d="M12 5v14M5 12h14"/></svg>
                    </span>
                </button>
                <div x-show="open" x-collapse x-cloak>
                    <p class="px-5 pb-5 text-slate-500 text-sm leading-relaxed">{{ $q[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10 reveal">
            <p class="text-slate-500 text-sm mb-4">Une autre question ? Nous y répondons en direct.</p>
            <a href="#contact" class="btn-primary inline-block font-semibold px-7 py-3.5 rounded-xl">Poser ma question</a>
        </div>
    </div>
</section>

{{-- ══════════════ CTA + CONTACT ══════════════ --}}
<section id="contact" class="bg-white py-24">
    <div class="max-w-6xl mx-auto px-5 grid lg:grid-cols-2 gap-12 items-center">
        <div class="reveal">
            <h2 class="text-3xl sm:text-4xl font-black text-ink leading-tight">Prêt à digitaliser<br>votre école ?</h2>
            <p class="mt-5 text-slate-500 leading-relaxed">Demandez une démonstration gratuite. Nous vous montrons RaedApp en action, adapté à votre établissement.</p>
            <div class="mt-8 space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 text-xl">✉️</div>
                    <div><p class="text-xs text-slate-400 uppercase tracking-widest">Email</p><p class="font-semibold text-ink">contact@raedapp.com</p></div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 text-xl">💬</div>
                    <div><p class="text-xs text-slate-400 uppercase tracking-widest">WhatsApp</p><p class="font-semibold text-ink">Réponse rapide, 7j/7</p></div>
                </div>
            </div>
        </div>
        <div class="reveal">
            <div class="card rounded-3xl p-8">
                <h3 class="text-lg font-extrabold text-ink mb-6">Envoyer un message</h3>
                <form @submit.prevent="submitContact()" class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <input type="text" x-model="contact.name" required placeholder="Nom complet" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                        <input type="email" x-model="contact.email" required placeholder="Email" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    </div>
                    <input type="text" x-model="contact.school" placeholder="Nom de votre école" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    <input type="tel" x-model="contact.phone" placeholder="Téléphone (+253 …)" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition">
                    <textarea x-model="contact.message" required rows="3" placeholder="Votre message…" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition resize-none"></textarea>
                    <button type="submit" :disabled="contactSent || contactLoading" class="btn-primary w-full py-3.5 rounded-xl font-semibold flex items-center justify-center gap-2">
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
<footer class="bg-white border-t border-slate-100 pt-14 pb-8">
    <div class="max-w-6xl mx-auto px-5">
        <div class="grid md:grid-cols-4 gap-10 mb-10">
            <div>
                <div class="flex items-center gap-2.5 mb-4">
                    <img src="{{ asset('images/logoraedapp.png') }}" alt="RaedApp" class="h-8 w-8">
                    <span class="font-extrabold text-lg text-ink">Raed<span class="text-brand-600">App</span></span>
                </div>
                <p class="text-sm text-slate-500 leading-relaxed">La plateforme de gestion scolaire nouvelle génération, pensée pour Djibouti et l'Afrique.</p>
            </div>
            <div>
                <p class="font-semibold text-ink text-sm mb-4">Produit</p>
                <ul class="space-y-2.5 text-sm text-slate-500">
                    <li><a href="#fonctionnalites" class="hover:text-brand-600 transition">Fonctionnalités</a></li>
                    <li><a href="#portails" class="hover:text-brand-600 transition">Portails</a></li>
                    <li><a href="#tarifs" class="hover:text-brand-600 transition">Tarifs</a></li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-ink text-sm mb-4">Paiement</p>
                <ul class="space-y-2.5 text-sm text-slate-500"><li>D-Money</li><li>Waafi</li><li>CAC Pay</li><li>Exim Pay</li></ul>
            </div>
            <div>
                <p class="font-semibold text-ink text-sm mb-4">Compte</p>
                <ul class="space-y-2.5 text-sm text-slate-500">
                    <li><a href="{{ route('login') }}" class="hover:text-brand-600 transition">Se connecter</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-brand-600 transition">Créer un compte</a></li>
                    <li><a href="#contact" class="hover:text-brand-600 transition">Demander une démo</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-slate-400">
            <p>© {{ date('Y') }} RaedApp. Tous droits réservés.</p>
            <p class="flex items-center gap-2">Fait avec <span class="text-brand-500">♥</span> pour les écoles.</p>
        </div>
    </div>
</footer>

<script>
    function site() {
        return {
            scrolled: false,
            mobileOpen: false,
            contact: { name:'', email:'', school:'', phone:'', message:'' },
            contactLoading: false, contactSent: false, contactError: '',

            init() {
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
                this._parallax(); this._magnetic(); this._tilt();
            },

            _parallax() {
                const hero = document.getElementById('top'); if (!hero) return;
                const layers = [...hero.querySelectorAll('[data-parallax]')]; if (!layers.length) return;
                let tx=0,ty=0,cx=0,cy=0,raf=null;
                const tick = () => {
                    cx += (tx-cx)*0.08; cy += (ty-cy)*0.08;
                    for (const el of layers) { const d = parseFloat(el.dataset.parallax)||0; el.style.translate = `${(cx*d).toFixed(2)}px ${(cy*d).toFixed(2)}px`; }
                    raf = (Math.abs(tx-cx)>0.15 || Math.abs(ty-cy)>0.15) ? requestAnimationFrame(tick) : null;
                };
                const kick = () => { if (!raf) raf = requestAnimationFrame(tick); };
                hero.addEventListener('pointermove', (e) => { const r = hero.getBoundingClientRect(); tx = ((e.clientX-r.left)/r.width-0.5)*40; ty = ((e.clientY-r.top)/r.height-0.5)*40; kick(); });
                hero.addEventListener('pointerleave', () => { tx=0; ty=0; kick(); });
            },

            _magnetic() {
                document.querySelectorAll('[data-magnetic]').forEach(el => {
                    const s = parseFloat(el.dataset.magnetic)||0.3;
                    el.addEventListener('pointermove', (e) => { const r = el.getBoundingClientRect(); el.style.transition='translate 0s'; el.style.translate = `${((e.clientX-r.left-r.width/2)*s).toFixed(2)}px ${((e.clientY-r.top-r.height/2)*s).toFixed(2)}px`; });
                    el.addEventListener('pointerleave', () => { el.style.transition='translate .4s cubic-bezier(0.23,1,0.32,1)'; el.style.translate='0 0'; });
                });
            },

            _tilt() {
                document.querySelectorAll('[data-tilt]').forEach(el => {
                    const max = parseFloat(el.dataset.tilt)||6;
                    el.addEventListener('pointerenter', () => { el.style.transition='transform 0s'; });
                    el.addEventListener('pointermove', (e) => { const r = el.getBoundingClientRect(); const px=(e.clientX-r.left)/r.width-0.5, py=(e.clientY-r.top)/r.height-0.5; el.style.transform = `perspective(800px) rotateX(${(-py*max).toFixed(2)}deg) rotateY(${(px*max).toFixed(2)}deg)`; });
                    el.addEventListener('pointerleave', () => { el.style.transition='transform .5s cubic-bezier(0.23,1,0.32,1)'; el.style.transform='perspective(800px) rotateX(0deg) rotateY(0deg)'; });
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
