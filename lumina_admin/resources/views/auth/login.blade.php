<!DOCTYPE html>
<html lang="en" class="h-full overflow-hidden bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Lumina Trust</title>
    <link rel="icon" type="image/png" href="{{ asset('images/emblem.png') }}">

    <!-- Local Precompiled Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Local Alpine.js for interactive controls -->
    <script defer src="{{ asset('alpine.min.js') }}"></script>

    <style>
        html, body {
            height: 100vh;
            max-height: 100vh;
            overflow: hidden;
        }
        @media (max-width: 768px) {
            html, body {
                height: auto;
                min-height: 100vh;
                overflow-y: auto;
            }
        }
        img.admin-login-logo {
            height: 36px !important;
            max-height: 36px !important;
            width: auto !important;
        }
    </style>
</head>
<body class="h-full bg-slate-100/90 text-slate-800 antialiased flex items-center justify-center p-3 sm:p-5 lg:p-6 font-sans selection:bg-blue-500 selection:text-white">

    <!-- Split-Screen Login Container Card (Zero-Scroll Fit for All Laptop & Desktop Screens) -->
    <div class="max-w-4xl lg:max-w-5xl w-full max-h-[96vh] bg-white rounded-3xl lg:rounded-[2.25rem] shadow-2xl shadow-slate-300/50 border border-slate-200/80 grid grid-cols-1 lg:grid-cols-12 overflow-hidden">

        <!-- Left Column: Featured Hero Card with User's Uploaded Emblem Image -->
        <div class="lg:col-span-5 p-3 sm:p-4 hidden md:flex flex-col h-full">
            <div class="relative h-full rounded-2xl lg:rounded-[1.75rem] overflow-hidden shadow-inner flex flex-col justify-between p-6 lg:p-7 text-white bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950">
                
                <!-- Ambient Glow Behind Emblem -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Top: Pill Tag -->
                <div class="relative z-10 flex items-center justify-between">
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-[10px] font-black uppercase tracking-widest shadow-sm">
                        <span>✨ Step into Kindness</span>
                    </div>
                </div>

                <!-- Center: High-Resolution Uploaded Emblem Graphic -->
                <div class="relative z-10 flex flex-col items-center justify-center my-auto py-2">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-amber-500/30 to-blue-500/30 rounded-full blur-xl group-hover:blur-2xl transition-all opacity-80"></div>
                        <img src="{{ asset('images/emblem.png') }}" 
                             alt="Lumina Trust Emblem" 
                             class="relative w-36 h-36 lg:w-44 lg:h-44 object-contain drop-shadow-[0_12px_24px_rgba(0,0,0,0.5)] transform transition-transform duration-500 group-hover:scale-105">
                    </div>
                </div>

                <!-- Bottom: Headline & Indicator Dots -->
                <div class="relative z-10 space-y-3 pt-2">
                    <h2 class="text-lg lg:text-xl font-black text-white leading-snug tracking-tight drop-shadow-md">
                        From grassroots action to lasting change, empowering lives with Lumina Trust.
                    </h2>

                    <!-- Carousel Indicator Dots -->
                    <div class="flex items-center space-x-1.5 pt-1">
                        <span class="w-6 h-1.5 rounded-full bg-white shadow-sm"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
                        <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Login Form & Controls -->
        <div class="lg:col-span-7 p-5 sm:p-7 lg:p-9 flex flex-col justify-center overflow-y-auto" x-data="{ showPass: false }">

            <div class="max-w-md w-full mx-auto space-y-3.5">

                <!-- Brand Header -->
                <div>
                    <a href="{{ url('/') }}" class="inline-block mb-1.5 group">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="Lumina Trust" 
                             class="admin-login-logo h-9 w-auto object-contain group-hover:scale-105 transition-transform">
                    </a>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center space-x-1">
                        <span>Welcome to</span>
                        <span class="text-amber-500">Lumina</span>
                    </h1>
                    <p class="text-xs text-slate-500 font-medium">
                        Your Gateway to Effortless Management.
                    </p>
                </div>

                <!-- Segmented Tab Bar -->
                <div class="grid grid-cols-2 p-1 bg-slate-100 rounded-xl border border-slate-200/60">
                    <button type="button" class="py-1.5 text-xs font-extrabold rounded-lg bg-blue-600 text-white shadow-sm shadow-blue-500/20 transition-all text-center">
                        Log In
                    </button>
                    <button type="button" class="py-1.5 text-xs font-bold text-slate-400 cursor-not-allowed hover:text-slate-500 transition-all text-center" title="Admin access is invitation only">
                        Admin Portal
                    </button>
                </div>

                <!-- Status Alerts -->
                @if (session('status'))
                    <div class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center space-x-2">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center space-x-2">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-3">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1">
                            Email Address
                        </label>
                        <div class="relative">
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email', 'admin@luminatrust.org') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="email"
                                   placeholder="Email Address" 
                                   class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-900 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 transition-all placeholder:text-slate-300">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1">
                            Password
                        </label>
                        <div class="relative">
                            <input id="password" 
                                   :type="showPass ? 'text' : 'password'" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="Enter Password" 
                                   class="w-full px-3.5 py-2.5 pr-10 rounded-xl border border-slate-200 text-slate-900 text-xs sm:text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-600 transition-all placeholder:text-slate-300">
                            
                            <!-- Toggle Password Eye Icon -->
                            <button type="button" 
                                    @click="showPass = !showPass" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                                    tabindex="-1">
                                <template x-if="!showPass">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </template>
                                <template x-if="showPass">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                                </template>
                            </button>
                        </div>

                        <div class="flex items-center justify-between mt-1.5">
                            <label class="inline-flex items-center space-x-1.5 cursor-pointer">
                                <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded text-blue-600 border-slate-300 focus:ring-blue-500">
                                <span class="text-[11px] text-slate-500 font-semibold">Remember Me</span>
                            </label>
                            <a href="javascript:void(0)" 
                               onclick="alert('For administrator password resets, please contact the primary administrator or check database records.')" 
                               class="text-[11px] font-bold text-slate-400 hover:text-blue-600 transition-colors underline">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Log In Button -->
                    <div class="pt-1">
                        <button type="submit" 
                                class="w-full py-2.5 sm:py-3 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.99] text-white text-xs sm:text-sm font-extrabold shadow-md shadow-blue-500/25 transition-all flex items-center justify-center space-x-2">
                            <span>Log In</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>

                <!-- OR Divider -->
                <div class="relative flex items-center justify-center my-2">
                    <div class="border-t border-slate-200 w-full"></div>
                    <span class="bg-white px-2.5 text-[10px] font-extrabold text-slate-400 tracking-wider">OR</span>
                </div>

                <!-- Social SSO Placeholder Badges -->
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" class="py-2 px-3 rounded-xl border border-slate-200/90 hover:bg-slate-50 hover:border-slate-300 transition-all flex items-center justify-center shadow-sm" title="Google sign-in">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                    </button>
                    <button type="button" class="py-2 px-3 rounded-xl border border-slate-200/90 hover:bg-slate-50 hover:border-slate-300 transition-all flex items-center justify-center shadow-sm" title="Apple sign-in">
                        <svg class="w-4 h-4 text-slate-900 fill-current" viewBox="0 0 170 170">
                            <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.69-7.85-12-14.42-6.19-9.45-10.87-20.15-14.04-32.09-3.17-11.94-4.76-23.07-4.76-33.39 0-14.45 3.73-26.65 11.2-36.6 7.46-9.94 17.13-15.08 29-15.4 4.89 0 10.23 1.34 16.03 4.02 5.8 2.68 9.77 4.09 11.9 4.22 1.77 0 5.79-1.47 12.05-4.4 6.26-2.93 11.83-4.22 16.71-3.87 13.25.74 23.59 5.62 31.02 14.65-11.53 7-17.16 16.63-16.9 28.88.27 9.54 3.9 17.5 10.89 23.88 7 6.38 15.34 10.02 25.03 10.93-2.22 6.64-4.7 13.12-7.46 19.46zM119.22 33.06c0-7.25 2.6-14.15 7.8-207 5.2-6.55 11.75-10.98 19.64-13.3-1.06 6.94-3.77 13.48-8.14 19.63-4.37 6.14-10.79 10.59-19.3 13.37z"/>
                        </svg>
                    </button>
                    <button type="button" class="py-2 px-3 rounded-xl border border-slate-200/90 hover:bg-slate-50 hover:border-slate-300 transition-all flex items-center justify-center shadow-sm" title="Microsoft sign-in">
                        <svg class="w-4 h-4" viewBox="0 0 23 23">
                            <path fill="#f35325" d="M1 1h10v10H1z"/>
                            <path fill="#81bc06" d="M12 1h10v10H12z"/>
                            <path fill="#05a6f0" d="M1 12h10v10H1z"/>
                            <path fill="#ffba08" d="M12 12h10v10H12z"/>
                        </svg>
                    </button>
                </div>

                <!-- Terms & Privacy Notice -->
                <p class="text-[10px] text-slate-400 text-center leading-normal">
                    By signing in you access Lumina Trust Admin Management.<br>
                    <a href="#" class="underline hover:text-slate-600">Terms of use</a> &amp; 
                    <a href="#" class="underline hover:text-slate-600">Privacy Policy</a>.
                </p>

            </div>

        </div>

    </div>

</body>
</html>
