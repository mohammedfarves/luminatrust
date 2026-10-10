@extends('layouts.admin')

@section('title', 'Home Page & Impact Counters')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Top Action Bar & Page Title -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-amber-500/10 text-amber-700 border border-amber-500/20">
                    Live Content Manager
                </span>
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight mt-1">
                Home Page & Impact Metrics
            </h2>
            <p class="text-slate-500 text-xs mt-1 font-medium">
                Manage live impact counter numbers, hero headlines, and section copy displayed across the main Lumina Trust website.
            </p>
        </div>

        <div class="flex items-center space-x-3 shrink-0">
            <a href="{{ route('admin.home.edit') }}" 
               class="px-5 py-2.5 bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:from-amber-600 hover:to-amber-500 text-slate-950 font-extrabold text-xs rounded-full shadow-md shadow-amber-500/20 hover:shadow-lg transition-all flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span>Edit Home Sections & Counters</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 text-sm">✕</button>
        </div>
    @endif

    <!-- ── 1. LIVE IMPACT METRICS SECTION ── -->
    <div class="bg-slate-900 rounded-3xl p-6 md:p-8 text-white relative overflow-hidden shadow-xl border border-slate-800">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 relative z-10">
            <div>
                <span class="text-xs font-extrabold tracking-widest uppercase text-amber-400 block">
                    {{ $home->impact_subtitle ?? 'OUR IMPACT' }}
                </span>
                <h3 class="text-xl md:text-2xl font-black text-white tracking-tight mt-0.5">
                    {{ $home->impact_title ?? 'Numbers That Speak' }}
                </h3>
                <p class="text-slate-400 text-xs mt-1">Live numbers currently shown on the website's impact counter section.</p>
            </div>
            <a href="{{ route('admin.home.edit') }}#impact" 
               class="inline-flex items-center space-x-1.5 text-xs font-bold text-amber-400 hover:text-amber-300">
                <span>Update Numbers</span>
                <span>→</span>
            </a>
        </div>

        <!-- 4 Counter Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 relative z-10">
            <!-- Counter 1 -->
            <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl p-5 border border-white/10 hover:border-amber-400/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-400 flex items-center justify-center font-bold text-lg mb-3">
                    👥
                </div>
                <div class="text-3xl font-black text-amber-400 tracking-tight">
                    {{ number_format($home->counter_people_helped) }}{{ $home->counter_people_helped_suffix }}
                </div>
                <div class="text-xs font-extrabold uppercase tracking-wider text-slate-300 mt-1">
                    {{ $home->counter_people_helped_label }}
                </div>
                <span class="text-[10px] text-slate-500 mt-2 block">Direct beneficiaries</span>
            </div>

            <!-- Counter 2 -->
            <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl p-5 border border-white/10 hover:border-amber-400/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-400 flex items-center justify-center font-bold text-lg mb-3">
                    🤝
                </div>
                <div class="text-3xl font-black text-amber-400 tracking-tight">
                    {{ number_format($home->counter_volunteers) }}{{ $home->counter_volunteers_suffix }}
                </div>
                <div class="text-xs font-extrabold uppercase tracking-wider text-slate-300 mt-1">
                    {{ $home->counter_volunteers_label }}
                </div>
                <span class="text-[10px] text-slate-500 mt-2 block">Active field supporters</span>
            </div>

            <!-- Counter 3 -->
            <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl p-5 border border-white/10 hover:border-amber-400/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-400 flex items-center justify-center font-bold text-lg mb-3">
                    🎯
                </div>
                <div class="text-3xl font-black text-amber-400 tracking-tight">
                    {{ number_format($home->counter_projects_done) }}{{ $home->counter_projects_done_suffix }}
                </div>
                <div class="text-xs font-extrabold uppercase tracking-wider text-slate-300 mt-1">
                    {{ $home->counter_projects_done_label }}
                </div>
                <span class="text-[10px] text-slate-500 mt-2 block">Community programs completed</span>
            </div>

            <!-- Counter 4 -->
            <div class="bg-slate-800/80 backdrop-blur-md rounded-2xl p-5 border border-white/10 hover:border-amber-400/40 transition-all">
                <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-400 flex items-center justify-center font-bold text-lg mb-3">
                    🌍
                </div>
                <div class="text-3xl font-black text-amber-400 tracking-tight">
                    {{ number_format($home->counter_communities) }}{{ $home->counter_communities_suffix }}
                </div>
                <div class="text-xs font-extrabold uppercase tracking-wider text-slate-300 mt-1">
                    {{ $home->counter_communities_label }}
                </div>
                <span class="text-[10px] text-slate-500 mt-2 block">Districts & villages reached</span>
            </div>
        </div>
    </div>

    <!-- ── 2. HERO SECTION & TRUST INDICATORS PREVIEW ── -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Hero Summary Card -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm space-y-5">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg">
                        ✨
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 tracking-tight">Hero Section Headlines</h3>
                        <p class="text-xs text-slate-400">First impression text displayed on the Home screen</p>
                    </div>
                </div>
                <a href="{{ route('admin.home.edit') }}#hero" class="text-xs font-bold text-amber-600 hover:text-amber-700">Edit →</a>
            </div>

            <div class="space-y-4">
                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Status Pill</span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold mt-1">
                        ● {{ $home->hero_badge_text }}
                    </span>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Main Headline</span>
                    <h4 class="text-xl font-black text-slate-900 mt-0.5">
                        {{ $home->hero_title_line1 }} <span class="text-amber-500">{{ $home->hero_title_line2 }}</span>
                    </h4>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Description</span>
                    <p class="text-xs text-slate-600 leading-relaxed mt-0.5">
                        {{ $home->hero_description }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Primary CTA</span>
                        <p class="text-xs font-bold text-slate-800 mt-0.5">{{ $home->hero_button_donate_text }}</p>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100">
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Secondary CTA</span>
                        <p class="text-xs font-bold text-slate-800 mt-0.5">{{ $home->hero_button_volunteer_text }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-2 border-t border-slate-100 text-xs text-slate-600">
                    <div class="flex items-center gap-1.5">
                        <span class="text-emerald-500 font-bold">✓</span>
                        <span class="font-semibold">{{ $home->hero_trust_badge_1 }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-amber-500 font-bold">✓</span>
                        <span class="font-semibold">{{ $home->hero_trust_badge_2 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Featured Visual Card & About Preview -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Hero Right Visual Card Preview -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-black text-slate-900 tracking-tight">Hero Right Visual Badge</h3>
                    <a href="{{ route('admin.home.edit') }}#hero" class="text-xs font-bold text-amber-600 hover:text-amber-700">Edit →</a>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900 text-white space-y-2">
                    <span class="text-[10px] uppercase font-bold text-amber-400 block">Photo Caption Card</span>
                    <p class="text-xs font-bold text-white">{{ $home->hero_card_title }}</p>
                    <p class="text-[11px] text-amber-300">{{ $home->hero_card_subtitle }}</p>
                    <div class="pt-2 border-t border-white/10 flex items-center justify-between text-[11px]">
                        <span class="text-slate-400">Stat Badge:</span>
                        <span class="text-white font-bold">{{ $home->hero_stat_completed }}</span>
                    </div>
                </div>
            </div>

            <!-- Newsletter CTA Preview -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-black text-slate-900 tracking-tight">Newsletter CTA Banner</h3>
                    <a href="{{ route('admin.home.edit') }}#newsletter" class="text-xs font-bold text-amber-600 hover:text-amber-700">Edit →</a>
                </div>
                <div class="space-y-2">
                    <span class="text-[10px] font-bold text-amber-700 uppercase block">{{ $home->newsletter_subtitle }}</span>
                    <h4 class="text-sm font-black text-slate-900">{{ $home->newsletter_title }}</h4>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $home->newsletter_description }}</p>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
