<!DOCTYPE html>
<html lang="en" class="h-full bg-[#f6f8fc]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Lumina Trust</title>
    
    <!-- Compiled Vite Assets (if available) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Compiled Native Tailwind CSS (Zero Dependency, 100% Instant Offline & Online Rendering) -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Alpine.js (Local First, CDN Fallback) -->
    <script defer src="{{ asset('alpine.min.js') }}"></script>

    <!-- Google Font Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif; background-color: #f6f8fc; }
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f6f8fc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

        /* Anti-Explosion Safety Guard: Guarantees images and icons NEVER blow up without Tailwind */
        img { max-width: 100%; height: auto; }
        img.admin-brand-logo { height: 40px !important; max-height: 40px !important; width: auto !important; object-fit: contain; }
        svg { max-width: 24px; max-height: 24px; flex-shrink: 0; }
        svg.w-3\.5 { width: 14px !important; height: 14px !important; }
        svg.w-4 { width: 16px !important; height: 16px !important; }
        svg.w-5 { width: 20px !important; height: 20px !important; }
        svg.w-6 { width: 24px !important; height: 24px !important; }
        .hidden { display: none !important; }
        @media (max-width: 767px) {
            .md\:hidden { display: block; }
            .hidden.md\:flex, aside.md\:flex { display: none !important; }
        }
        @media (min-width: 768px) {
            .md\:hidden { display: none !important; }
            .md\:flex { display: flex !important; }
        }
    </style>
</head>
<body class="h-full antialiased bg-[#f6f8fc] text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex bg-[#f6f8fc]">

        <!-- Mobile Drawer Overlay & Mobile Sidebar -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-md z-40 md:hidden" 
             x-cloak></div>

        <!-- Mobile Sidebar Drawer -->
        <aside x-show="sidebarOpen" 
               x-transition:enter="transition-transform ease-out duration-300"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition-transform ease-in duration-300"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 flex flex-col md:hidden shadow-2xl"
               x-cloak>
            <!-- Logo Header Mobile -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-100">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Lumina Trust Logo" style="height: 40px; max-height: 40px; width: auto;" class="admin-brand-logo h-10 w-auto object-contain">
                </a>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-slate-700 p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <!-- Mobile Menu items -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.dashboard*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard*') ? 'text-slate-950' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.home.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.home.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.home.*') ? 'text-slate-950' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Home & Impact</span>
                </a>
                <a href="{{ route('admin.activities.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.activities.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.activities.*') ? 'text-slate-950' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    <span>Projects & Activities</span>
                </a>

                <a href="{{ route('admin.about.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.about.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.about.*') ? 'text-slate-950' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>About Us</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-2xl text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-900">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.settings.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.settings.*') ? 'text-slate-950' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Site Settings</span>
                </a>
            </nav>

            <!-- Mobile Drawer Logout -->
            <div class="p-4 border-t border-slate-100">
                <form method="POST" action="{{ route('logout') }}" id="mobile-logout-form">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 rounded-2xl bg-rose-50 text-rose-600 font-bold text-xs hover:bg-rose-100 transition-colors space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Desktop Sidebar (Permanent, Zero JS Flickering - Matches Uploaded Mockup) -->
        <aside class="hidden md:flex w-64 h-screen sticky top-0 bg-white border-r border-slate-200/70 flex-col shrink-0 z-30">
            <!-- Brand Logo Header -->
            <div class="h-20 px-6 flex items-center justify-between">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Lumina Trust Logo" style="height: 40px; max-height: 40px; width: auto;" class="admin-brand-logo h-10 w-auto object-contain group-hover:scale-105 transition-transform">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-4 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.dashboard*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 group' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard*') ? 'text-slate-950' : 'text-slate-400 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.home.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.home.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 group' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.home.*') ? 'text-slate-950' : 'text-slate-400 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Home & Impact</span>
                </a>

                <a href="{{ route('admin.activities.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.activities.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 group' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.activities.*') ? 'text-slate-950' : 'text-slate-400 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    <span>Projects & Activities</span>
                </a>

                <a href="{{ route('admin.about.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.about.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 group' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.about.*') ? 'text-slate-950' : 'text-slate-400 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>About Us</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 rounded-2xl text-sm font-semibold text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 transition-all group">
                    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 rounded-2xl text-sm font-extrabold transition-all {{ request()->routeIs('admin.settings.*') ? 'text-slate-950 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 shadow-md shadow-amber-500/20' : 'text-slate-600 hover:bg-slate-100/80 hover:text-slate-900 group' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.settings.*') ? 'text-slate-950' : 'text-slate-400 group-hover:text-amber-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Site Settings</span>
                </a>
            </nav>

            <!-- Bottom User Card & Logout (Matching Uploaded Mockup) -->
            <div class="p-4 space-y-2 border-t border-slate-100">
                <div class="flex items-center justify-between p-2 rounded-2xl hover:bg-slate-50 transition-colors">
                    <div class="flex items-center space-x-3 min-w-0">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-400 to-amber-500 text-slate-950 font-black text-xs flex items-center justify-center shadow-md shadow-amber-500/20 shrink-0">
                            {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-extrabold text-slate-900 leading-none truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                            <p class="text-[10px] text-slate-400 font-medium leading-none mt-1 truncate">{{ Auth::user()->email ?? 'admin@luminatrust.org' }}</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" id="desktop-logout-form">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 text-xs font-bold text-slate-500 hover:text-rose-600 hover:bg-rose-50/80 rounded-xl transition-all space-x-2">
                        <svg class="w-4 h-4 text-slate-400 hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-[#f6f8fc]">
            
            <!-- Header Bar (Matching Uploaded Mockup) -->
            <header class="h-20 bg-transparent px-6 md:px-8 flex items-center justify-between sticky top-0 z-20">
                
                <!-- Left: Search Bar with Pill Input -->
                <div class="flex items-center space-x-4 flex-1 max-w-md">
                    <button @click="sidebarOpen = true" class="md:hidden text-slate-500 hover:text-slate-800 p-2 rounded-xl hover:bg-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" 
                               placeholder="Search here..." 
                               class="w-full pl-11 pr-5 py-2.5 bg-white border border-slate-200/80 rounded-full text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 shadow-sm transition-all">
                    </div>
                </div>

                <!-- Right: Notification Bell & User Avatar Pill -->
                <div class="flex items-center space-x-4">
                    <button class="relative p-2.5 rounded-full text-slate-500 hover:text-slate-800 bg-white border border-slate-200/80 shadow-sm transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute top-1 right-1 w-4 h-4 bg-rose-500 text-white font-extrabold text-[9px] flex items-center justify-center rounded-full border-2 border-white">3</span>
                    </button>

                    <div class="flex items-center space-x-3 bg-white border border-slate-200/80 p-1.5 pr-4 rounded-full shadow-sm">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-amber-400 to-amber-500 text-slate-950 font-black text-xs flex items-center justify-center">
                            {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-xs font-bold text-slate-900 leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</p>
                            <p class="text-[10px] text-slate-400 font-medium leading-none mt-0.5">Admin Portal</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content View -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
