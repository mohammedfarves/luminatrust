@extends('layouts.admin')

@section('title', 'Edit Home Page & Impact Counters')

@section('content')
<div class="max-w-6xl mx-auto space-y-6" x-data="{ activeTab: 'counters' }">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs font-bold text-slate-400">
                <a href="{{ route('admin.home.index') }}" class="hover:text-slate-600">Home Page</a>
                <span>/</span>
                <span class="text-slate-700">Edit Settings</span>
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-1">
                Edit Home Sections & Counters
            </h2>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.home.index') }}" 
               class="px-4 py-2 border border-slate-200 bg-white rounded-full text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all">
                Cancel
            </a>
            <button type="submit" form="homeForm"
                    class="px-6 py-2.5 bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:from-amber-600 hover:to-amber-500 text-slate-950 font-extrabold text-xs rounded-full shadow-md shadow-amber-500/20 hover:shadow-lg transition-all flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Save All Changes</span>
            </button>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold space-y-1">
            <p class="font-extrabold text-rose-900">Please correct the following errors:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Navigation Tabs -->
    <div class="flex items-center space-x-2 border-b border-slate-200 overflow-x-auto pb-px">
        <button type="button" @click="activeTab = 'counters'" 
                :class="activeTab === 'counters' ? 'border-amber-500 text-amber-700 bg-amber-50/60' : 'border-transparent text-slate-500 hover:text-slate-800'"
                class="px-5 py-3 border-b-2 font-bold text-xs rounded-t-xl transition-all flex items-center space-x-2 shrink-0">
            <span>📊</span>
            <span>Live Impact Counters</span>
        </button>

        <button type="button" @click="activeTab = 'hero'" 
                :class="activeTab === 'hero' ? 'border-amber-500 text-amber-700 bg-amber-50/60' : 'border-transparent text-slate-500 hover:text-slate-800'"
                class="px-5 py-3 border-b-2 font-bold text-xs rounded-t-xl transition-all flex items-center space-x-2 shrink-0">
            <span>🚀</span>
            <span>Hero Section</span>
        </button>

        <button type="button" @click="activeTab = 'about'" 
                :class="activeTab === 'about' ? 'border-amber-500 text-amber-700 bg-amber-50/60' : 'border-transparent text-slate-500 hover:text-slate-800'"
                class="px-5 py-3 border-b-2 font-bold text-xs rounded-t-xl transition-all flex items-center space-x-2 shrink-0">
            <span>🤝</span>
            <span>About Preview Section</span>
        </button>

        <button type="button" @click="activeTab = 'newsletter'" 
                :class="activeTab === 'newsletter' ? 'border-amber-500 text-amber-700 bg-amber-50/60' : 'border-transparent text-slate-500 hover:text-slate-800'"
                class="px-5 py-3 border-b-2 font-bold text-xs rounded-t-xl transition-all flex items-center space-x-2 shrink-0">
            <span>📬</span>
            <span>Newsletter & CTA</span>
        </button>
    </div>

    <!-- Main Edit Form -->
    <form id="homeForm" action="{{ route('admin.home.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ═══════════ TAB 1: LIVE IMPACT COUNTERS ═══════════ -->
        <div x-show="activeTab === 'counters'" class="space-y-6">
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
                        <span>Numbers That Speak</span>
                        <span class="text-xs px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold">4 Live Metric Cards</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-0.5">
                        These numbers are directly animated on the website's impact counter section with live counting effects.
                    </p>
                </div>

                <!-- Section Titles -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pb-4 border-b border-slate-100">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Section Subtitle</label>
                        <input type="text" name="impact_subtitle" value="{{ old('impact_subtitle', $home->impact_subtitle) }}"
                               class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/10">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Section Title</label>
                        <input type="text" name="impact_title" value="{{ old('impact_title', $home->impact_title) }}"
                               class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/10">
                    </div>
                </div>

                <!-- 4 Live Counters Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Counter 1: People Helped -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 text-sm flex items-center justify-center font-bold">1</span>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-wide">People Helped Metric</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Count Number *</label>
                                <input type="number" name="counter_people_helped" value="{{ old('counter_people_helped', $home->counter_people_helped) }}" required
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Suffix (e.g. +)</label>
                                <input type="text" name="counter_people_helped_suffix" value="{{ old('counter_people_helped_suffix', $home->counter_people_helped_suffix) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Card Label *</label>
                            <input type="text" name="counter_people_helped_label" value="{{ old('counter_people_helped_label', $home->counter_people_helped_label) }}" required
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Counter 2: Active Volunteers -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 text-sm flex items-center justify-center font-bold">2</span>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-wide">Active Volunteers Metric</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Count Number *</label>
                                <input type="number" name="counter_volunteers" value="{{ old('counter_volunteers', $home->counter_volunteers) }}" required
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Suffix (e.g. +)</label>
                                <input type="text" name="counter_volunteers_suffix" value="{{ old('counter_volunteers_suffix', $home->counter_volunteers_suffix) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Card Label *</label>
                            <input type="text" name="counter_volunteers_label" value="{{ old('counter_volunteers_label', $home->counter_volunteers_label) }}" required
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Counter 3: Projects Done -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 text-sm flex items-center justify-center font-bold">3</span>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-wide">Projects Done Metric</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Count Number *</label>
                                <input type="number" name="counter_projects_done" value="{{ old('counter_projects_done', $home->counter_projects_done) }}" required
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Suffix (e.g. +)</label>
                                <input type="text" name="counter_projects_done_suffix" value="{{ old('counter_projects_done_suffix', $home->counter_projects_done_suffix) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Card Label *</label>
                            <input type="text" name="counter_projects_done_label" value="{{ old('counter_projects_done_label', $home->counter_projects_done_label) }}" required
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Counter 4: Communities -->
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 text-sm flex items-center justify-center font-bold">4</span>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-wide">Communities Metric</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Count Number *</label>
                                <input type="number" name="counter_communities" value="{{ old('counter_communities', $home->counter_communities) }}" required
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Suffix (e.g. +)</label>
                                <input type="text" name="counter_communities_suffix" value="{{ old('counter_communities_suffix', $home->counter_communities_suffix) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-600 mb-1">Card Label *</label>
                            <input type="text" name="counter_communities_label" value="{{ old('counter_communities_label', $home->counter_communities_label) }}" required
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold uppercase focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ═══════════ TAB 2: HERO SECTION ═══════════ -->
        <div x-show="activeTab === 'hero'" class="space-y-6">
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm space-y-5">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Hero Section Copy & Action Pills</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Live Status Pill (Top Tag)</label>
                        <input type="text" name="hero_badge_text" value="{{ old('hero_badge_text', $home->hero_badge_text) }}"
                               class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Headline Line 1</label>
                            <input type="text" name="hero_title_line1" value="{{ old('hero_title_line1', $home->hero_title_line1) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Headline Line 2 (Golden Gradient)</label>
                            <input type="text" name="hero_title_line2" value="{{ old('hero_title_line2', $home->hero_title_line2) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Hero Subtitle Paragraph</label>
                        <textarea name="hero_description" rows="3"
                                  class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">{{ old('hero_description', $home->hero_description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Primary Button Text</label>
                            <input type="text" name="hero_button_donate_text" value="{{ old('hero_button_donate_text', $home->hero_button_donate_text) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Secondary Button Text</label>
                            <input type="text" name="hero_button_volunteer_text" value="{{ old('hero_button_volunteer_text', $home->hero_button_volunteer_text) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Trust Badge 1</label>
                            <input type="text" name="hero_trust_badge_1" value="{{ old('hero_trust_badge_1', $home->hero_trust_badge_1) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Trust Badge 2</label>
                            <input type="text" name="hero_trust_badge_2" value="{{ old('hero_trust_badge_2', $home->hero_trust_badge_2) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Right Card Badges -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3 mt-4">
                        <h4 class="text-xs font-black text-slate-800">Right Featured Photo Overlay Text</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Card Title</label>
                                <input type="text" name="hero_card_title" value="{{ old('hero_card_title', $home->hero_card_title) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Card Subtitle</label>
                                <input type="text" name="hero_card_subtitle" value="{{ old('hero_card_subtitle', $home->hero_card_subtitle) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-600 mb-1">Stat Badge Text</label>
                                <input type="text" name="hero_stat_completed" value="{{ old('hero_stat_completed', $home->hero_stat_completed) }}"
                                       class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════ TAB 3: ABOUT PREVIEW SECTION ═══════════ -->
        <div x-show="activeTab === 'about'" class="space-y-6">
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm space-y-5">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">About & Purpose Section Preview</h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Subtitle Pill</label>
                            <input type="text" name="about_subtitle" value="{{ old('about_subtitle', $home->about_subtitle) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Main Heading</label>
                            <input type="text" name="about_title" value="{{ old('about_title', $home->about_title) }}"
                                   class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">About Summary Paragraph</label>
                        <textarea name="about_description" rows="4"
                                  class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">{{ old('about_description', $home->about_description) }}</textarea>
                    </div>

                    <!-- Feature Badges -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <label class="block text-xs font-bold text-emerald-800">Feature 1 (Grassroots Reach)</label>
                            <input type="text" name="about_feature_1_title" value="{{ old('about_feature_1_title', $home->about_feature_1_title) }}"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            <input type="text" name="about_feature_1_desc" value="{{ old('about_feature_1_desc', $home->about_feature_1_desc) }}"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <label class="block text-xs font-bold text-amber-800">Feature 2 (Full Transparency)</label>
                            <input type="text" name="about_feature_2_title" value="{{ old('about_feature_2_title', $home->about_feature_2_title) }}"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:border-amber-500">
                            <input type="text" name="about_feature_2_desc" value="{{ old('about_feature_2_desc', $home->about_feature_2_desc) }}"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════ TAB 4: NEWSLETTER & CTA ═══════════ -->
        <div x-show="activeTab === 'newsletter'" class="space-y-6">
            <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Newsletter CTA Banner</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Banner Subtitle</label>
                        <input type="text" name="newsletter_subtitle" value="{{ old('newsletter_subtitle', $home->newsletter_subtitle) }}"
                               class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Banner Title</label>
                        <input type="text" name="newsletter_title" value="{{ old('newsletter_title', $home->newsletter_title) }}"
                               class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Description</label>
                        <textarea name="newsletter_description" rows="3"
                                  class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 text-xs font-medium focus:outline-none focus:border-amber-500">{{ old('newsletter_description', $home->newsletter_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
