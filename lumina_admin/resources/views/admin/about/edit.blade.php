@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.about.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to About Overview</span>
            </a>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit About Page Details</h2>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Update hero banner, story, mission, vision, impact numbers, founder message, and images.</p>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Hero Section Settings -->
        <div id="sec-hero" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📌</span>
                <span>Hero Section Settings</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Hero Main Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $about->title) }}" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>

                <!-- Subtitle / Tagline -->
                <div>
                    <label for="subtitle" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Hero Badge / Subtitle
                    </label>
                    <input type="text" 
                           name="subtitle" 
                           id="subtitle" 
                           value="{{ old('subtitle', $about->subtitle) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>

                <!-- Primary Button Text & Link -->
                <div>
                    <label for="hero_button_text" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Primary Button Text
                    </label>
                    <input type="text" 
                           name="hero_button_text" 
                           id="hero_button_text" 
                           value="{{ old('hero_button_text', $about->hero_button_text) }}" 
                           placeholder="Our Initiatives"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>
                <div>
                    <label for="hero_button_link" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Primary Button Link
                    </label>
                    <input type="text" 
                           name="hero_button_link" 
                           id="hero_button_link" 
                           value="{{ old('hero_button_link', $about->hero_button_link) }}" 
                           placeholder="/projects"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>

                <!-- Secondary Button Text & Link -->
                <div>
                    <label for="secondary_button_text" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Secondary Button Text
                    </label>
                    <input type="text" 
                           name="secondary_button_text" 
                           id="secondary_button_text" 
                           value="{{ old('secondary_button_text', $about->secondary_button_text) }}" 
                           placeholder="Support Our Cause"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>
                <div>
                    <label for="secondary_button_link" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Secondary Button Link
                    </label>
                    <input type="text" 
                           name="secondary_button_link" 
                           id="secondary_button_link" 
                           value="{{ old('secondary_button_link', $about->secondary_button_link) }}" 
                           placeholder="/donate"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                </div>

                <!-- Hero Story Description -->
                <div class="md:col-span-2">
                    <label for="story" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Hero Description & Intro Story
                    </label>
                    <textarea name="story" 
                              id="story" 
                              rows="4" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">{{ old('story', $about->story) }}</textarea>
                </div>
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Hero Section</span>
                </button>
            </div>
        </div>

        <!-- 2. Who We Are Section Settings -->
        <div id="sec-who-we-are" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-teal-600 uppercase tracking-wider flex items-center space-x-2">
                <span>🏢</span>
                <span>Who We Are Section</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="who_we_are_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Who We Are Title
                    </label>
                    <input type="text" 
                           name="who_we_are_title" 
                           id="who_we_are_title" 
                           value="{{ old('who_we_are_title', $about->who_we_are_title) }}" 
                           placeholder="Uplifting Underserved Communities with Dignity"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-teal-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label for="image_badge_text" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Image Overlay Badge Text
                    </label>
                    <input type="text" 
                           name="image_badge_text" 
                           id="image_badge_text" 
                           value="{{ old('image_badge_text', $about->image_badge_text) }}" 
                           placeholder="100% Non-Profit NGO"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-teal-500 focus:bg-white transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="established_year" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Established Year
                    </label>
                    <input type="text" 
                           name="established_year" 
                           id="established_year" 
                           value="{{ old('established_year', $about->established_year) }}" 
                           placeholder="e.g. 2018" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-teal-500 focus:bg-white transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="who_we_are_description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Who We Are Story & Description
                    </label>
                    <textarea name="who_we_are_description" 
                              id="who_we_are_description" 
                              rows="3" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-teal-500 focus:bg-white transition-all">{{ old('who_we_are_description', $about->who_we_are_description) }}</textarea>
                </div>
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-teal-500 to-emerald-600 hover:from-teal-600 hover:to-emerald-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-teal-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Who We Are</span>
                </button>
            </div>
        </div>

        <!-- 3. Core Values Management (Structured Repeater Fields) -->
        <div id="sec-core-values" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                        <span>💎</span>
                        <span>Core Values Section (Individual Fields)</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-1 font-medium">Add, edit, or remove organization core values. Each value has a Title and Description.</p>
                </div>
                <button type="button" 
                        onclick="addCoreValueRow()" 
                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-extrabold rounded-2xl shadow-sm transition-all inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Add Core Value</span>
                </button>
            </div>

            <div id="core-values-container" class="space-y-4">
                @php
                    $rawCoreValues = old('core_values', $about->core_values ?? []);
                    if (empty($rawCoreValues)) {
                        $rawCoreValues = [
                            ['title' => 'Integrity & Accountability', 'description' => 'Honest, transparent operations.'],
                            ['title' => 'Inclusive Growth', 'description' => 'Equal opportunities for all.'],
                            ['title' => 'Compassionate Action', 'description' => 'Serving with empathy & care.'],
                            ['title' => 'Sustainable Impact', 'description' => 'Long-term self-reliance.']
                        ];
                    }
                @endphp

                @foreach($rawCoreValues as $index => $item)
                    @php
                        $itemTitle = is_array($item) ? ($item['title'] ?? ($item['label'] ?? '')) : $item;
                        $itemDesc = is_array($item) ? ($item['description'] ?? ($item['desc'] ?? '')) : '';
                    @endphp
                    <div class="core-value-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Core Value Title #<span class="row-number">{{ $loop->iteration }}</span> <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="core_values[{{ $index }}][title]" 
                                       value="{{ $itemTitle }}" 
                                       placeholder="e.g. Integrity & Accountability"
                                       class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Description / Subtitle
                                </label>
                                <input type="text" 
                                       name="core_values[{{ $index }}][description]" 
                                       value="{{ $itemDesc }}" 
                                       placeholder="e.g. Honest, transparent operations."
                                       class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                        </div>
                        <button type="button" 
                                onclick="removeCoreValueRow(this)"
                                class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            <span>Remove</span>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-amber-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Core Values</span>
                </button>
            </div>
        </div>

        <!-- 4. Mission & Vision Statements (Dynamic Title, Description & Bullet Points) -->
        <div id="sec-mission-vision" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-8">
            <h3 class="text-sm font-extrabold text-purple-600 uppercase tracking-wider flex items-center space-x-2 border-b border-slate-100 pb-3">
                <span>🎯</span>
                <span>Mission & Vision Statements (Full Dynamic Customization)</span>
            </h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- VISION BOX -->
                <div class="bg-amber-50/40 border border-amber-200/80 rounded-2xl p-5 space-y-4">
                    <div class="flex items-center space-x-2">
                        <span class="w-8 h-8 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm">👁️</span>
                        <h4 class="text-xs font-black text-amber-900 uppercase tracking-wider">Vision Details</h4>
                    </div>

                    <div>
                        <label for="vision_title" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                            Vision Heading / Title
                        </label>
                        <input type="text" 
                               name="vision_title" 
                               id="vision_title" 
                               value="{{ old('vision_title', $about->vision_title ?: 'Empowered Communities Living with Dignity & Equality') }}" 
                               placeholder="e.g. Empowered Communities Living with Dignity & Equality"
                               class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                    </div>

                    <div>
                        <label for="vision" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                            Vision Description Paragraph
                        </label>
                        <textarea name="vision" 
                                  id="vision" 
                                  rows="3" 
                                  class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 transition-all">{{ old('vision', $about->vision) }}</textarea>
                    </div>

                    <!-- Vision Bullet Points Repeater -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                                Vision Highlights / Bullet Points
                            </label>
                            <button type="button" 
                                    onclick="addVisionPointRow()" 
                                    class="text-[11px] font-extrabold text-amber-700 hover:text-amber-800 bg-amber-100 px-2.5 py-1 rounded-lg transition-all">
                                + Add Bullet Point
                            </button>
                        </div>
                        <div id="vision-points-container" class="space-y-2">
                            @php
                                $vPoints = old('vision_points', $about->vision_points ?? [
                                    'Self-reliant grassroots development',
                                    'Equal access to education and training',
                                    'Healthy, sustainable, and green environments'
                                ]);
                            @endphp
                            @foreach($vPoints as $vp)
                                <div class="vision-point-row flex items-center gap-2">
                                    <input type="text" 
                                           name="vision_points[]" 
                                           value="{{ $vp }}" 
                                           placeholder="e.g. Self-reliant grassroots development" 
                                           class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-amber-500 transition-all">
                                    <button type="button" 
                                            onclick="this.parentElement.remove()" 
                                            class="px-2 py-1 text-rose-500 hover:bg-rose-50 rounded-lg text-xs font-bold transition-all">✕</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- MISSION BOX -->
                <div class="bg-teal-50/40 border border-teal-200/80 rounded-2xl p-5 space-y-4">
                    <div class="flex items-center space-x-2">
                        <span class="w-8 h-8 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-sm">🎯</span>
                        <h4 class="text-xs font-black text-teal-900 uppercase tracking-wider">Mission Details</h4>
                    </div>

                    <div>
                        <label for="mission_title" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                            Mission Heading / Title
                        </label>
                        <input type="text" 
                               name="mission_title" 
                               id="mission_title" 
                               value="{{ old('mission_title', $about->mission_title ?: 'Transforming Lives Through Education & Healthcare') }}" 
                               placeholder="e.g. Transforming Lives Through Education & Healthcare"
                               class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-teal-500 transition-all">
                    </div>

                    <div>
                        <label for="mission" class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                            Mission Description Paragraph
                        </label>
                        <textarea name="mission" 
                                  id="mission" 
                                  rows="3" 
                                  class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-teal-500 transition-all">{{ old('mission', $about->mission) }}</textarea>
                    </div>

                    <!-- Mission Bullet Points Repeater -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                                Mission Highlights / Bullet Points
                            </label>
                            <button type="button" 
                                    onclick="addMissionPointRow()" 
                                    class="text-[11px] font-extrabold text-teal-700 hover:text-teal-800 bg-teal-100 px-2.5 py-1 rounded-lg transition-all">
                                + Add Bullet Point
                            </button>
                        </div>
                        <div id="mission-points-container" class="space-y-2">
                            @php
                                $mPoints = old('mission_points', $about->mission_points ?? [
                                    'Free educational support & exam materials',
                                    'Free medical check-up drives & health awareness',
                                    'Vocational guidance & youth skill building'
                                ]);
                            @endphp
                            @foreach($mPoints as $mp)
                                <div class="mission-point-row flex items-center gap-2">
                                    <input type="text" 
                                           name="mission_points[]" 
                                           value="{{ $mp }}" 
                                           placeholder="e.g. Free educational support & exam materials" 
                                           class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-teal-500 transition-all">
                                    <button type="button" 
                                            onclick="this.parentElement.remove()" 
                                            class="px-2 py-1 text-rose-500 hover:bg-rose-50 rounded-lg text-xs font-bold transition-all">✕</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-purple-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Mission & Vision</span>
                </button>
            </div>
        </div>

        <!-- 5. Areas of Impact / Where We Make a Difference Section -->
        <div id="sec-impact" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-sm font-extrabold text-cyan-600 uppercase tracking-wider flex items-center space-x-2">
                        <span>🌐</span>
                        <span>Areas of Impact Section (Dynamic Cards)</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-1 font-medium">Manage header and program pillars ("Where We Make a Difference"). Each pillar has a Title & Description.</p>
                </div>
                <button type="button" 
                        onclick="addImpactItemRow()" 
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-extrabold rounded-2xl shadow-sm transition-all inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Add Impact Card</span>
                </button>
            </div>

            <!-- Header Title & Subtitle Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-200/60">
                <div>
                    <label for="impact_subtitle" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Badge / Subtitle
                    </label>
                    <input type="text" 
                           name="impact_subtitle" 
                           id="impact_subtitle" 
                           value="{{ old('impact_subtitle', $about->impact_subtitle ?: 'Areas of Impact') }}" 
                           placeholder="e.g. Areas of Impact"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-cyan-500 transition-all">
                </div>

                <div>
                    <label for="impact_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Main Title
                    </label>
                    <input type="text" 
                           name="impact_title" 
                           id="impact_title" 
                           value="{{ old('impact_title', $about->impact_title ?: 'Where We Make a Difference') }}" 
                           placeholder="e.g. Where We Make a Difference"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-cyan-500 transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="impact_description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Description
                    </label>
                    <textarea name="impact_description" 
                              id="impact_description" 
                              rows="2" 
                              class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-cyan-500 transition-all">{{ old('impact_description', $about->impact_description ?: 'Our integrated programs address key pillars of community welfare for holistic social improvement.') }}</textarea>
                </div>
            </div>

            <!-- Cards Repeater List -->
            <div id="impact-items-container" class="space-y-4">
                @php
                    $rawImpactItems = old('impact_items', $about->impact_items ?? []);
                    if (empty($rawImpactItems)) {
                        $rawImpactItems = [
                            ['title' => 'Education & Literacy', 'description' => 'Distributing free books, notebooks, competitive exam kits, and conducting academic training for government school students.'],
                            ['title' => 'Health & Healthcare', 'description' => 'Organizing free medical camps, wellness awareness sessions, and honoring healthcare professionals for dedicated service.'],
                            ['title' => 'Environment & Ecology', 'description' => 'Leading plastic-free drives, beach cleanups, sparrow box distribution, and massive tree plantation initiatives.'],
                            ['title' => 'Skills & Livelihood', 'description' => 'Career guidance, youth skill training, and empowering women to achieve economic independence and dignity.']
                        ];
                    }
                @endphp

                @foreach($rawImpactItems as $index => $item)
                    <div class="impact-item-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Card Title #<span class="impact-row-number">{{ $loop->iteration }}</span> <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="impact_items[{{ $index }}][title]" 
                                       value="{{ $item['title'] ?? '' }}" 
                                       placeholder="e.g. Education & Literacy"
                                       class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-cyan-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Card Description
                                </label>
                                <textarea name="impact_items[{{ $index }}][description]" 
                                          rows="2" 
                                          placeholder="e.g. Distributing free books..."
                                          class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-cyan-500 transition-all">{{ $item['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <button type="button" 
                                onclick="removeImpactItemRow(this)"
                                class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            <span>Remove</span>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-cyan-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Impact Cards</span>
                </button>
            </div>
        </div>

        <!-- 6. Our Process / How We Work Section -->
        <div id="sec-process" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider flex items-center space-x-2">
                        <span>⚙️</span>
                        <span>Our Process Section (How We Work Steps)</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-1 font-medium">Manage header and step-by-step workflow cards. Each step has a Number, Title, & Description.</p>
                </div>
                <button type="button" 
                        onclick="addProcessStepRow()" 
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold rounded-2xl shadow-sm transition-all inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Add Process Step</span>
                </button>
            </div>

            <!-- Header Title & Subtitle Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-200/60">
                <div>
                    <label for="process_subtitle" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Badge / Subtitle
                    </label>
                    <input type="text" 
                           name="process_subtitle" 
                           id="process_subtitle" 
                           value="{{ old('process_subtitle', $about->process_subtitle ?: 'Our Process') }}" 
                           placeholder="e.g. Our Process"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label for="process_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Main Title
                    </label>
                    <input type="text" 
                           name="process_title" 
                           id="process_title" 
                           value="{{ old('process_title', $about->process_title ?: 'How We Work') }}" 
                           placeholder="e.g. How We Work"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-indigo-500 transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="process_description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Description
                    </label>
                    <textarea name="process_description" 
                              id="process_description" 
                              rows="2" 
                              class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 transition-all">{{ old('process_description', $about->process_description ?: 'Our systematic approach ensures every initiative reaches the right beneficiaries with maximum accountability.') }}</textarea>
                </div>
            </div>

            <!-- Process Steps Repeater List -->
            <div id="process-steps-container" class="space-y-4">
                @php
                    $rawProcessSteps = old('process_steps', $about->process_steps ?? []);
                    if (empty($rawProcessSteps)) {
                        $rawProcessSteps = [
                            ['step' => '01', 'title' => 'Needs Assessment', 'description' => 'We conduct grassroots surveys and interact directly with rural & urban communities to understand real gaps.'],
                            ['step' => '02', 'title' => 'Program Planning', 'description' => 'We design tailored educational kits, healthcare camps, and skill workshops with actionable milestones.'],
                            ['step' => '03', 'title' => 'Field Execution', 'description' => 'Our dedicated team and volunteers collaborate with schools, doctors, and local bodies to execute efficiently.'],
                            ['step' => '04', 'title' => 'Impact & Growth', 'description' => 'We continuously monitor outcomes, gather beneficiary feedback, and ensure long-term community self-reliance.']
                        ];
                    }
                @endphp

                @foreach($rawProcessSteps as $index => $item)
                    <div class="process-step-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group">
                        <div class="w-full md:w-28 shrink-0">
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                Step #
                            </label>
                            <input type="text" 
                                   name="process_steps[{{ $index }}][step]" 
                                   value="{{ $item['step'] ?? sprintf('%02d', $loop->iteration) }}" 
                                   placeholder="01"
                                   class="w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-black text-indigo-600 text-center focus:outline-none focus:border-indigo-500 transition-all">
                        </div>

                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Step Title <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="process_steps[{{ $index }}][title]" 
                                       value="{{ $item['title'] ?? '' }}" 
                                       placeholder="e.g. Needs Assessment"
                                       class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-indigo-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Step Description
                                </label>
                                <textarea name="process_steps[{{ $index }}][description]" 
                                          rows="2" 
                                          placeholder="e.g. We conduct surveys..."
                                          class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-indigo-500 transition-all">{{ $item['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <button type="button" 
                                onclick="removeProcessStepRow(this)"
                                class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            <span>Remove</span>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Process</span>
                </button>
            </div>
        </div>

        <!-- 7. Leadership / Meet Our Team Section -->
        <div id="sec-team" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                        <span>👥</span>
                        <span>Leadership & Team Section (Meet Our Team Cards)</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-1 font-medium">Manage team members, leaders, and officers. Each member has a Name, Role, and Bio/Description.</p>
                </div>
                <button type="button" 
                        onclick="addTeamMemberRow()" 
                        class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-extrabold rounded-2xl shadow-sm transition-all inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Add Team Member</span>
                </button>
            </div>

            <!-- Header Title & Subtitle Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-200/60">
                <div>
                    <label for="team_subtitle" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Badge / Subtitle
                    </label>
                    <input type="text" 
                           name="team_subtitle" 
                           id="team_subtitle" 
                           value="{{ old('team_subtitle', $about->team_subtitle ?: 'Leadership') }}" 
                           placeholder="e.g. Leadership"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                </div>

                <div>
                    <label for="team_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Main Title
                    </label>
                    <input type="text" 
                           name="team_title" 
                           id="team_title" 
                           value="{{ old('team_title', $about->team_title ?: 'Meet Our Team') }}" 
                           placeholder="e.g. Meet Our Team"
                           class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="team_description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Section Description
                    </label>
                    <textarea name="team_description" 
                              id="team_description" 
                              rows="2" 
                              class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 transition-all">{{ old('team_description', $about->team_description ?: 'Dedicated professionals driving positive grassroots change every day.') }}</textarea>
                </div>
            </div>

            <!-- Team Members Repeater List -->
            <div id="team-members-container" class="space-y-4">
                @php
                    $rawTeamMembers = old('team_members', $about->team_members ?? []);
                    if (empty($rawTeamMembers)) {
                        $rawTeamMembers = [
                            ['name' => 'Ananya Kapoor', 'role' => 'Founder & CEO', 'desc' => 'Visionary leader passionate about social equity and grassroots empowerment.'],
                            ['name' => 'Vikram Mehta', 'role' => 'Director of Operations', 'desc' => 'Oversees program deployment, partner engagement, and field logistics.'],
                            ['name' => 'Dr. Lakshmi Rao', 'role' => 'Head of Healthcare', 'desc' => 'Leads free medical camps, community health initiatives, and doctor drives.'],
                            ['name' => 'Arjun Singh', 'role' => 'Community Director', 'desc' => 'Drives student education programs, skill workshops, and volunteer mobilization.']
                        ];
                    }
                @endphp

                @foreach($rawTeamMembers as $index => $item)
                    @php
                        $mName = is_array($item) ? ($item['name'] ?? '') : '';
                        $mRole = is_array($item) ? ($item['role'] ?? '') : '';
                        $mDesc = is_array($item) ? ($item['desc'] ?? ($item['description'] ?? '')) : '';
                    @endphp
                    <div class="team-member-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Member Name #<span class="team-row-number">{{ $loop->iteration }}</span> <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="team_members[{{ $index }}][name]" 
                                       value="{{ $mName }}" 
                                       placeholder="e.g. Ananya Kapoor"
                                       class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Designation / Role
                                </label>
                                <input type="text" 
                                       name="team_members[{{ $index }}][role]" 
                                       value="{{ $mRole }}" 
                                       placeholder="e.g. Founder & CEO"
                                       class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-amber-600 focus:outline-none focus:border-amber-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                                    Short Bio / Description
                                </label>
                                <textarea name="team_members[{{ $index }}][desc]" 
                                          rows="2" 
                                          placeholder="e.g. Visionary leader passionate..."
                                          class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-amber-500 transition-all">{{ $mDesc }}</textarea>
                            </div>
                        </div>
                        <button type="button" 
                                onclick="removeTeamMemberRow(this)"
                                class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            <span>Remove</span>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-amber-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Team</span>
                </button>
            </div>
        </div>

        <!-- 8. Impact Metrics / Statistics -->
        <div id="sec-stats" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-sky-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📊</span>
                <span>Impact Statistics / Counter Metrics</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label for="beneficiaries_count" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Beneficiaries
                    </label>
                    <input type="text" 
                           name="beneficiaries_count" 
                           id="beneficiaries_count" 
                           value="{{ old('beneficiaries_count', $about->beneficiaries_count) }}" 
                           placeholder="e.g. 10,000+" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label for="projects_count" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Projects Executed
                    </label>
                    <input type="text" 
                           name="projects_count" 
                           id="projects_count" 
                           value="{{ old('projects_count', $about->projects_count) }}" 
                           placeholder="e.g. 150+" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label for="volunteers_count" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Volunteers
                    </label>
                    <input type="text" 
                           name="volunteers_count" 
                           id="volunteers_count" 
                           value="{{ old('volunteers_count', $about->volunteers_count) }}" 
                           placeholder="e.g. 500+" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label for="cities_count" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Cities Reached
                    </label>
                    <input type="text" 
                           name="cities_count" 
                           id="cities_count" 
                           value="{{ old('cities_count', $about->cities_count) }}" 
                           placeholder="e.g. 25+" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                </div>
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-sky-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Statistics</span>
                </button>
            </div>
        </div>

        <!-- 9. Founder Message & Media -->
        <div id="sec-founder" class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                <span>💬</span>
                <span>Founder Statement & Media</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="founder_name" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Founder Name
                    </label>
                    <input type="text" 
                           name="founder_name" 
                           id="founder_name" 
                           value="{{ old('founder_name', $about->founder_name) }}" 
                           placeholder="e.g. Ananya Kapoor" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label for="founder_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Founder Title / Role
                    </label>
                    <input type="text" 
                           name="founder_title" 
                           id="founder_title" 
                           value="{{ old('founder_title', $about->founder_title) }}" 
                           placeholder="e.g. Founder & CEO" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="founder_message" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Founder's Message / Outro Quote
                    </label>
                    <textarea name="founder_message" 
                              id="founder_message" 
                              rows="3" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('founder_message', $about->founder_message) }}</textarea>
                </div>

                <!-- Main Image Upload -->
                <div>
                    <label for="main_image" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Main About Cover Image
                    </label>
                    @if($about->main_image)
                        <div class="mb-3 flex items-center space-x-3 bg-slate-50 p-2.5 rounded-2xl border border-slate-200/80">
                            <img src="{{ $about->image_url }}" alt="Cover" class="w-12 h-12 rounded-xl object-cover border border-slate-200">
                            <span class="text-xs text-slate-500 font-bold">Current Cover Image</span>
                        </div>
                    @endif
                    <input type="file" 
                           name="main_image" 
                           id="main_image" 
                           accept="image/*" 
                           class="w-full px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                </div>

                <!-- Founder Image Upload -->
                <div>
                    <label for="founder_image" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Founder Profile Image
                    </label>
                    @if($about->founder_image)
                        <div class="mb-3 flex items-center space-x-3 bg-slate-50 p-2.5 rounded-2xl border border-slate-200/80">
                            <img src="{{ $about->founder_image_url }}" alt="Founder" class="w-12 h-12 rounded-full object-cover border border-slate-200">
                            <span class="text-xs text-slate-500 font-bold">Current Founder Photo</span>
                        </div>
                    @endif
                    <input type="file" 
                           name="founder_image" 
                           id="founder_image" 
                           accept="image/*" 
                           class="w-full px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                </div>
            </div>

            <!-- Save Button for this Section -->
            <div class="flex items-center justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-xs font-extrabold rounded-full shadow-md shadow-amber-500/15 transition-all inline-flex items-center space-x-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Update & Save Founder Statement</span>
                </button>
            </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-2">
            <a href="{{ route('admin.about.index') }}" 
               class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-full border border-slate-200 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/20 transition-all">
                Update About Page
            </button>
        </div>

    </form>

</div>

<script>
    function addCoreValueRow() {
        const container = document.getElementById('core-values-container');
        const count = container.children.length;
        const newRow = document.createElement('div');
        newRow.className = 'core-value-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group';
        newRow.innerHTML = `
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Core Value Title #<span class="row-number">${count + 1}</span> <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="core_values[${count}][title]" 
                           placeholder="e.g. Integrity & Accountability"
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Description / Subtitle
                    </label>
                    <input type="text" 
                           name="core_values[${count}][description]" 
                           placeholder="e.g. Honest, transparent operations."
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-amber-500 transition-all">
                </div>
            </div>
            <button type="button" 
                    onclick="removeCoreValueRow(this)"
                    class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Remove</span>
            </button>
        `;
        container.appendChild(newRow);
        updateRowNumbers();
    }

    function removeCoreValueRow(button) {
        const container = document.getElementById('core-values-container');
        if (container.children.length > 1) {
            button.closest('.core-value-row').remove();
            updateRowNumbers();
        } else {
            alert('At least one Core Value field must remain.');
        }
    }

    function updateRowNumbers() {
        const container = document.getElementById('core-values-container');
        const rows = container.getElementsByClassName('core-value-row');
        Array.from(rows).forEach((row, index) => {
            const numSpan = row.querySelector('.row-number');
            if (numSpan) numSpan.textContent = index + 1;
            const titleInput = row.querySelector('input[name*="[title]"]');
            const descInput = row.querySelector('input[name*="[description]"]');
            if (titleInput) titleInput.name = `core_values[${index}][title]`;
            if (descInput) descInput.name = `core_values[${index}][description]`;
        });
    }

    function addVisionPointRow() {
        const container = document.getElementById('vision-points-container');
        const newRow = document.createElement('div');
        newRow.className = 'vision-point-row flex items-center gap-2';
        newRow.innerHTML = `
            <input type="text" 
                   name="vision_points[]" 
                   placeholder="e.g. Self-reliant grassroots development" 
                   class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-amber-500 transition-all">
            <button type="button" 
                    onclick="this.parentElement.remove()" 
                    class="px-2 py-1 text-rose-500 hover:bg-rose-50 rounded-lg text-xs font-bold transition-all">✕</button>
        `;
        container.appendChild(newRow);
    }

    function addMissionPointRow() {
        const container = document.getElementById('mission-points-container');
        const newRow = document.createElement('div');
        newRow.className = 'mission-point-row flex items-center gap-2';
        newRow.innerHTML = `
            <input type="text" 
                   name="mission_points[]" 
                   placeholder="e.g. Free educational support & exam materials" 
                   class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-teal-500 transition-all">
            <button type="button" 
                    onclick="this.parentElement.remove()" 
                    class="px-2 py-1 text-rose-500 hover:bg-rose-50 rounded-lg text-xs font-bold transition-all">✕</button>
        `;
        container.appendChild(newRow);
    }

    function addImpactItemRow() {
        const container = document.getElementById('impact-items-container');
        const count = container.children.length;
        const newRow = document.createElement('div');
        newRow.className = 'impact-item-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group';
        newRow.innerHTML = `
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Card Title #<span class="impact-row-number">${count + 1}</span> <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="impact_items[${count}][title]" 
                           placeholder="e.g. Education & Literacy"
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-cyan-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Card Description
                    </label>
                    <textarea name="impact_items[${count}][description]" 
                              rows="2" 
                              placeholder="e.g. Distributing free books..."
                              class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-cyan-500 transition-all"></textarea>
                </div>
            </div>
            <button type="button" 
                    onclick="removeImpactItemRow(this)"
                    class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Remove</span>
            </button>
        `;
        container.appendChild(newRow);
        updateImpactRowNumbers();
    }

    function removeImpactItemRow(button) {
        const container = document.getElementById('impact-items-container');
        if (container.children.length > 1) {
            button.closest('.impact-item-row').remove();
            updateImpactRowNumbers();
        } else {
            alert('At least one Impact Card field must remain.');
        }
    }

    function updateImpactRowNumbers() {
        const container = document.getElementById('impact-items-container');
        const rows = container.getElementsByClassName('impact-item-row');
        Array.from(rows).forEach((row, index) => {
            const numSpan = row.querySelector('.impact-row-number');
            if (numSpan) numSpan.textContent = index + 1;
            const titleInput = row.querySelector('input[name*="[title]"]');
            const descInput = row.querySelector('textarea[name*="[description]"]');
            if (titleInput) titleInput.name = `impact_items[${index}][title]`;
            if (descInput) descInput.name = `impact_items[${index}][description]`;
        });
    }

    function addProcessStepRow() {
        const container = document.getElementById('process-steps-container');
        const count = container.children.length;
        const stepNum = String(count + 1).padStart(2, '0');
        const newRow = document.createElement('div');
        newRow.className = 'process-step-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group';
        newRow.innerHTML = `
            <div class="w-full md:w-28 shrink-0">
                <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                    Step #
                </label>
                <input type="text" 
                       name="process_steps[${count}][step]" 
                       value="${stepNum}" 
                       placeholder="01"
                       class="w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-black text-indigo-600 text-center focus:outline-none focus:border-indigo-500 transition-all">
            </div>
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Step Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="process_steps[${count}][title]" 
                           placeholder="e.g. Needs Assessment"
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-indigo-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Step Description
                    </label>
                    <textarea name="process_steps[${count}][description]" 
                              rows="2" 
                              placeholder="e.g. We conduct surveys..."
                              class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-indigo-500 transition-all"></textarea>
                </div>
            </div>
            <button type="button" 
                    onclick="removeProcessStepRow(this)"
                    class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Remove</span>
            </button>
        `;
        container.appendChild(newRow);
        updateProcessStepRowNumbers();
    }

    function removeProcessStepRow(button) {
        const container = document.getElementById('process-steps-container');
        if (container.children.length > 1) {
            button.closest('.process-step-row').remove();
            updateProcessStepRowNumbers();
        } else {
            alert('At least one Process Step field must remain.');
        }
    }

    function updateProcessStepRowNumbers() {
        const container = document.getElementById('process-steps-container');
        const rows = container.getElementsByClassName('process-step-row');
        Array.from(rows).forEach((row, index) => {
            const stepInput = row.querySelector('input[name*="[step]"]');
            const titleInput = row.querySelector('input[name*="[title]"]');
            const descInput = row.querySelector('textarea[name*="[description]"]');
            if (stepInput) stepInput.name = `process_steps[${index}][step]`;
            if (titleInput) titleInput.name = `process_steps[${index}][title]`;
            if (descInput) descInput.name = `process_steps[${index}][description]`;
        });
    }

    function addTeamMemberRow() {
        const container = document.getElementById('team-members-container');
        const count = container.children.length;
        const newRow = document.createElement('div');
        newRow.className = 'team-member-row bg-slate-50 border border-slate-200/80 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center gap-4 relative group';
        newRow.innerHTML = `
            <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Member Name #<span class="team-row-number">${count + 1}</span> <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="team_members[${count}][name]" 
                           placeholder="e.g. Ananya Kapoor"
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-900 focus:outline-none focus:border-amber-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Designation / Role
                    </label>
                    <input type="text" 
                           name="team_members[${count}][role]" 
                           placeholder="e.g. Founder & CEO"
                           class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-amber-600 focus:outline-none focus:border-amber-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-extrabold text-slate-600 uppercase tracking-wider mb-1">
                        Short Bio / Description
                    </label>
                    <textarea name="team_members[${count}][desc]" 
                              rows="2" 
                              placeholder="e.g. Visionary leader passionate..."
                              class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800 focus:outline-none focus:border-amber-500 transition-all"></textarea>
                </div>
            </div>
            <button type="button" 
                    onclick="removeTeamMemberRow(this)"
                    class="self-end md:self-center px-3.5 py-2.5 text-rose-600 hover:text-rose-700 hover:bg-rose-50 border border-rose-200 rounded-xl text-xs font-extrabold transition-all flex items-center gap-1.5 shrink-0 mt-2 md:mt-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <span>Remove</span>
            </button>
        `;
        container.appendChild(newRow);
        updateTeamMemberRowNumbers();
    }

    function removeTeamMemberRow(button) {
        const container = document.getElementById('team-members-container');
        if (container.children.length > 1) {
            button.closest('.team-member-row').remove();
            updateTeamMemberRowNumbers();
        } else {
            alert('At least one Team Member field must remain.');
        }
    }

    function updateTeamMemberRowNumbers() {
        const container = document.getElementById('team-members-container');
        const rows = container.getElementsByClassName('team-member-row');
        Array.from(rows).forEach((row, index) => {
            const numSpan = row.querySelector('.team-row-number');
            if (numSpan) numSpan.textContent = index + 1;
            const nameInput = row.querySelector('input[name*="[name]"]');
            const roleInput = row.querySelector('input[name*="[role]"]');
            const descInput = row.querySelector('textarea[name*="[desc]"]');
            if (nameInput) nameInput.name = `team_members[${index}][name]`;
            if (roleInput) roleInput.name = `team_members[${index}][role]`;
            if (descInput) descInput.name = `team_members[${index}][desc]`;
        });
    }
</script>
@endsection
