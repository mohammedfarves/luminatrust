@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 mb-1">
                <span>⚙️</span>
                <span>Configuration</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Site Settings & Contact Info</h2>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Manage email, phone numbers, social media links, and global organization details dynamically.</p>
        </div>

        <a href="http://localhost:5173" target="_blank" class="inline-flex items-center space-x-2 px-4 py-2 bg-white border border-slate-200/80 rounded-2xl text-xs font-extrabold text-slate-700 hover:text-indigo-600 hover:border-indigo-200 transition-all shadow-sm">
            <span>🌐</span>
            <span>View Live Website</span>
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        </a>
    </div>

    <!-- Success & Error Alert Banners -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-2xl flex items-center space-x-3 shadow-sm">
            <span class="text-xl">✅</span>
            <span class="text-xs font-bold">{{ session('success') }}</span>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl shadow-sm space-y-1.5">
            <div class="flex items-center space-x-2 font-bold text-xs text-rose-700">
                <span class="text-lg">⚠️</span>
                <span>Please fix the following validation errors:</span>
            </div>
            <ul class="list-disc list-inside text-xs pl-4 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Live Preview Strip -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-950 to-slate-900 text-white rounded-3xl p-5 border border-slate-800 shadow-xl shadow-slate-950/20 space-y-3">
        <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
            <div class="flex items-center space-x-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Live Top Bar & Contact Preview</span>
            </div>
            <span class="text-[11px] text-amber-400 font-semibold">Changes sync instantly across website</span>
        </div>
        <div class="flex flex-wrap items-center justify-between gap-4 text-xs">
            <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                <div class="inline-flex items-center space-x-1.5 text-slate-200">
                    <span class="text-amber-400">📞</span>
                    <span class="font-bold">{{ $setting->phone }}</span>
                </div>
                <div class="inline-flex items-center space-x-1.5 text-slate-200">
                    <span class="text-amber-400">✉️</span>
                    <span class="font-bold">{{ $setting->email }}</span>
                </div>
                <div class="inline-flex items-center space-x-1.5 text-slate-300">
                    <span class="text-amber-400">📍</span>
                    <span class="truncate max-w-[220px]">{{ $setting->address }}</span>
                </div>
            </div>
            <div class="flex items-center space-x-2 text-slate-400 text-[11px]">
                @if($setting->facebook_url) <span class="px-2 py-0.5 bg-slate-800 rounded-md">Facebook</span> @endif
                @if($setting->instagram_url) <span class="px-2 py-0.5 bg-slate-800 rounded-md">Instagram</span> @endif
                @if($setting->twitter_url) <span class="px-2 py-0.5 bg-slate-800 rounded-md">Twitter/X</span> @endif
                @if($setting->youtube_url) <span class="px-2 py-0.5 bg-slate-800 rounded-md">YouTube</span> @endif
            </div>
        </div>
    </div>

    <!-- Main Settings Form -->
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Contact Information -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>📞</span>
                    <span>Direct Contact Details</span>
                </h3>
                <span class="text-[11px] text-slate-400 font-medium">Used in Navbar, Contact Us, and Footer</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email ID -->
                <div>
                    <label for="email" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Official Email ID <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-sm">✉️</span>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email', $setting->email) }}" 
                               required 
                               placeholder="e.g. support@luminatrust.org"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('email') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Primary Phone Number -->
                <div>
                    <label for="phone" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Primary Phone Number <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-sm">📞</span>
                        <input type="text" 
                               name="phone" 
                               id="phone" 
                               value="{{ old('phone', $setting->phone) }}" 
                               required 
                               placeholder="e.g. +91 98947 77349"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('phone') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Secondary Phone Number -->
                <div>
                    <label for="secondary_phone" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Alternate / Landline Phone (Optional)
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-sm">📱</span>
                        <input type="text" 
                               name="secondary_phone" 
                               id="secondary_phone" 
                               value="{{ old('secondary_phone', $setting->secondary_phone) }}" 
                               placeholder="e.g. +91 94891 16189"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('secondary_phone') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- WhatsApp Number -->
                <div>
                    <label for="whatsapp_number" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        WhatsApp Contact Number
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-sm">💬</span>
                        <input type="text" 
                               name="whatsapp_number" 
                               id="whatsapp_number" 
                               value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" 
                               placeholder="e.g. +91 98947 77349"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    </div>
                    @error('whatsapp_number') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Office Address -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Registered Office Address <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="address" 
                           id="address" 
                           value="{{ old('address', $setting->address) }}" 
                           required 
                           placeholder="e.g. Lumina Trust, Nagapattinam, Tamil Nadu, India"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('address') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Working Hours -->
                <div>
                    <label for="working_hours" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Working Hours / Support Timing
                    </label>
                    <input type="text" 
                           name="working_hours" 
                           id="working_hours" 
                           value="{{ old('working_hours', $setting->working_hours) }}" 
                           placeholder="e.g. Mon – Sat: 9:00 AM – 6:00 PM"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('working_hours') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Google Map Embed Link -->
                <div>
                    <label for="map_link" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Google Map Embed URL (for Contact Page)
                    </label>
                    <input type="text" 
                           name="map_link" 
                           id="map_link" 
                           value="{{ old('map_link', $setting->map_link) }}" 
                           placeholder="e.g. https://www.google.com/maps?q=Nagapattinam,Tamil%20Nadu&output=embed"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('map_link') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Save Contact Details</span>
                </button>
            </div>
        </div>

        <!-- 2. Social Media Links -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-sky-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>🌐</span>
                    <span>Social Media Channels</span>
                </h3>
                <span class="text-[11px] text-slate-400 font-medium">Links shown on top navbar header and footer</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Facebook -->
                <div>
                    <label for="facebook_url" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Facebook URL
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-blue-600 font-bold text-xs">FB</span>
                        <input type="text" 
                               name="facebook_url" 
                               id="facebook_url" 
                               value="{{ old('facebook_url', $setting->facebook_url) }}" 
                               placeholder="https://facebook.com/your-page"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    </div>
                    @error('facebook_url') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Instagram -->
                <div>
                    <label for="instagram_url" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Instagram URL
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-rose-500 font-bold text-xs">IG</span>
                        <input type="text" 
                               name="instagram_url" 
                               id="instagram_url" 
                               value="{{ old('instagram_url', $setting->instagram_url) }}" 
                               placeholder="https://instagram.com/your-handle"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    </div>
                    @error('instagram_url') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Twitter / X -->
                <div>
                    <label for="twitter_url" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Twitter / X URL
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-900 font-bold text-xs">𝕏</span>
                        <input type="text" 
                               name="twitter_url" 
                               id="twitter_url" 
                               value="{{ old('twitter_url', $setting->twitter_url) }}" 
                               placeholder="https://x.com/your-handle"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    </div>
                    @error('twitter_url') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- YouTube -->
                <div>
                    <label for="youtube_url" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        YouTube Channel URL
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-red-600 font-bold text-xs">YT</span>
                        <input type="text" 
                               name="youtube_url" 
                               id="youtube_url" 
                               value="{{ old('youtube_url', $setting->youtube_url) }}" 
                               placeholder="https://youtube.com/@your-channel"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    </div>
                    @error('youtube_url') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- LinkedIn -->
                <div class="md:col-span-2">
                    <label for="linkedin_url" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        LinkedIn Profile / Page URL
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sky-700 font-bold text-xs">IN</span>
                        <input type="text" 
                               name="linkedin_url" 
                               id="linkedin_url" 
                               value="{{ old('linkedin_url', $setting->linkedin_url) }}" 
                               placeholder="https://linkedin.com/company/your-trust"
                               class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    </div>
                    @error('linkedin_url') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Save Social Links</span>
                </button>
            </div>
        </div>

        <!-- 3. Organization & Legal Info -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>🏛️</span>
                    <span>Organization & Trust Details</span>
                </h3>
                <span class="text-[11px] text-slate-400 font-medium">Shown across headers, footer & donation receipts</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site / Trust Title -->
                <div>
                    <label for="site_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Trust / Organization Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="site_title" 
                           id="site_title" 
                           value="{{ old('site_title', $setting->site_title) }}" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                    @error('site_title') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Site Tagline -->
                <div>
                    <label for="site_tagline" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Tagline / Motto
                    </label>
                    <input type="text" 
                           name="site_tagline" 
                           id="site_tagline" 
                           value="{{ old('site_tagline', $setting->site_tagline) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                    @error('site_tagline') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Registration Number -->
                <div>
                    <label for="registration_number" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Trust Registration Number
                    </label>
                    <input type="text" 
                           name="registration_number" 
                           id="registration_number" 
                           value="{{ old('registration_number', $setting->registration_number) }}" 
                           placeholder="e.g. Trust Reg. No: 123/2018"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                    @error('registration_number') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- 80G Tax Exemption Info -->
                <div>
                    <label for="tax_exemption_info" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Tax Exemption Note (80G / 12AA)
                    </label>
                    <input type="text" 
                           name="tax_exemption_info" 
                           id="tax_exemption_info" 
                           value="{{ old('tax_exemption_info', $setting->tax_exemption_info) }}" 
                           placeholder="e.g. Donations are tax exempt under Section 80G"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                    @error('tax_exemption_info') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Footer Summary Text -->
                <div class="md:col-span-2">
                    <label for="footer_about" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Footer Organization Description
                    </label>
                    <textarea name="footer_about" 
                              id="footer_about" 
                              rows="3" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('footer_about', $setting->footer_about) }}</textarea>
                    @error('footer_about') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Save Organization Info</span>
                </button>
            </div>
        </div>

        <!-- Master Submit Action Button -->
        <div class="flex items-center justify-end space-x-4 pt-2">
            <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-lg shadow-indigo-500/25 transition-all flex items-center space-x-2">
                <span>💾</span>
                <span>Save All Site Settings</span>
            </button>
        </div>

    </form>

</div>
@endsection
