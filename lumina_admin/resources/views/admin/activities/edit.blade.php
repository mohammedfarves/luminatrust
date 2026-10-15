@extends('layouts.admin')

@section('title', 'Edit Activity - ' . $activity->title)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Activities List</span>
            </a>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit Activity</h2>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Update details for <span class="text-indigo-600 font-bold">'{{ $activity->title }}'</span></p>
        </div>
    </div>

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

    <!-- Form Container -->
    <form method="POST" action="{{ route('admin.activities.update', $activity) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. General & Categorization Section -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📌</span>
                <span>Basic Information</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Activity Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $activity->title) }}" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('title') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Short Title -->
                <div>
                    <label for="short_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Short Title / Tagline
                    </label>
                    <input type="text" 
                           name="short_title" 
                           id="short_title" 
                           value="{{ old('short_title', $activity->short_title) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('short_title') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Category <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" 
                            id="category" 
                            required 
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        @foreach(['Education', 'Health', 'Environment', 'Water'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $activity->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" 
                            id="status" 
                            required 
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        <option value="active" {{ old('status', $activity->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status', $activity->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="upcoming" {{ old('status', $activity->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    </select>
                    @error('status') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Location
                    </label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="{{ old('location', $activity->location) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('location') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Update & Save Basic Info</span>
                </button>
            </div>
        </div>

        <!-- 2. Event Logistics & Financial Targets -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-sky-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📊</span>
                <span>Logistics & Fundraising Targets</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Date -->
                <div>
                    <label for="date" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Event Date
                    </label>
                    <input type="date" 
                           name="date" 
                           id="date" 
                           value="{{ old('date', $activity->date ? $activity->date->format('Y-m-d') : '') }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('date') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Time -->
                <div>
                    <label for="time" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Time Slot / Schedule
                    </label>
                    <input type="text" 
                           name="time" 
                           id="time" 
                           value="{{ old('time', $activity->time) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('time') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Participants -->
                <div>
                    <label for="participants" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Participants / Volunteers
                    </label>
                    <input type="text" 
                           name="participants" 
                           id="participants" 
                           value="{{ old('participants', $activity->participants) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('participants') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Progress % -->
                <div>
                    <label for="progress_percent" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Progress Percentage (%)
                    </label>
                    <input type="number" 
                           name="progress_percent" 
                           id="progress_percent" 
                           min="0" 
                           max="100" 
                           value="{{ old('progress_percent', $activity->progress_percent) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('progress_percent') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Raised Amount -->
                <div>
                    <label for="raised_amount" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Raised Amount (₹)
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="raised_amount" 
                           id="raised_amount" 
                           value="{{ old('raised_amount', $activity->raised_amount) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('raised_amount') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Goal Amount -->
                <div>
                    <label for="goal_amount" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Goal Amount (₹)
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="goal_amount" 
                           id="goal_amount" 
                           value="{{ old('goal_amount', $activity->goal_amount) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('goal_amount') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Update & Save Logistics</span>
                </button>
            </div>
        </div>

        <!-- 3. Descriptions, Objectives, Highlights & Quotes -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📝</span>
                <span>Descriptions & Content</span>
            </h3>

            <div class="space-y-6">
                <!-- Short Description -->
                <div>
                    <label for="description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Short Summary / Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="2" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('description', $activity->description) }}</textarea>
                    @error('description') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Full Description -->
                <div>
                    <label for="full_description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Full Detailed Description
                    </label>
                    <textarea name="full_description" 
                              id="full_description" 
                              rows="5" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('full_description', $activity->full_description) }}</textarea>
                    @error('full_description') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Objectives -->
                    <div>
                        <label for="objectives" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                            Key Objectives
                        </label>
                        <textarea name="objectives" 
                                  id="objectives" 
                                  rows="3" 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('objectives', is_array($activity->objectives) ? implode("\n", $activity->objectives) : $activity->objectives) }}</textarea>
                        @error('objectives') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Highlights -->
                    <div>
                        <label for="highlights" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                            Key Highlights
                        </label>
                        <textarea name="highlights" 
                                  id="highlights" 
                                  rows="3" 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('highlights', is_array($activity->highlights) ? implode("\n", $activity->highlights) : $activity->highlights) }}</textarea>
                        @error('highlights') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Quote -->
                    <div>
                        <label for="quote" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                            Featured Quote / Testimonial
                        </label>
                        <textarea name="quote" 
                                  id="quote" 
                                  rows="3" 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('quote', $activity->quote) }}</textarea>
                        @error('quote') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-amber-600 hover:bg-amber-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Update & Save Descriptions</span>
                </button>
            </div>
        </div>

        <!-- 4. Me        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-emerald-600 uppercase tracking-wider flex items-center space-x-2">
                <span>🖼️</span>
                <span>Media & Images</span>
            </h3>

            @php
                $currentGallery = is_array($activity->gallery_images) 
                    ? $activity->gallery_images 
                    : array_filter(array_map('trim', preg_split('/[\r\n,]+/', $activity->gallery_images ?? '')));
            @endphp

            <!-- 1. Main Cover Image -->
            <div class="space-y-4">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">
                    Main Activity Cover Image <span class="text-rose-500">*</span>
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <!-- Current & Real-time Live Preview Card -->
                    <div class="flex items-center space-x-4 bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
                        <img id="image_preview" 
                             src="{{ $activity->image_url }}" 
                             alt="Activity Preview" 
                             class="w-20 h-20 rounded-2xl object-cover border-2 border-indigo-200 shadow-sm transition-all shrink-0"
                             onerror="this.src='https://images.unsplash.com/photo-1579208575657-c595a05383b7?w=300&auto=format&fit=crop&q=80'">
                        <div class="flex-1 min-w-0">
                            <span class="text-xs font-bold text-slate-900 block" id="preview_status">Current Cover Image</span>
                            <span class="text-[11px] text-slate-500 block mt-0.5">Upload a new image from your computer or provide a URL below.</span>
                            <span class="text-[10px] text-indigo-600 font-semibold block mt-1 truncate" title="{{ $activity->main_image }}">{{ $activity->main_image }}</span>
                        </div>
                    </div>

                    <!-- Cover Upload & URL Inputs -->
                    <div class="space-y-3">
                        <div>
                            <label for="main_image" class="block text-[11px] font-bold text-slate-600 mb-1.5">
                                Upload New Cover from Computer (JPG, PNG, WEBP)
                            </label>
                            <input type="file" 
                                   name="main_image" 
                                   id="main_image" 
                                   accept="image/*" 
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                            @error('main_image') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="main_image_url" class="block text-[11px] font-bold text-slate-600 mb-1.5">
                                Or Custom Cover Image URL / Path (Optional)
                            </label>
                            <input type="text" 
                                   name="main_image_url" 
                                   id="main_image_url" 
                                   placeholder="e.g. https://... or images/activities/..." 
                                   value="{{ old('main_image_url', str_starts_with($activity->main_image, 'http') ? $activity->main_image : '') }}"
                                   class="w-full px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Dedicated Activity Photo Gallery Section -->
            <div class="pt-6 border-t border-slate-100 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-wider flex items-center space-x-2">
                            <span>📸</span>
                            <span>Project Photo Gallery</span>
                        </h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Upload gallery photos directly from your computer. These appear in the photo gallery on the project details page.</p>
                    </div>
                    <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                        {{ count($currentGallery) }} Existing {{ count($currentGallery) == 1 ? 'Photo' : 'Photos' }}
                    </span>
                </div>

                <!-- Multiple File Upload From Computer Box -->
                <div class="bg-gradient-to-br from-indigo-50/60 via-white to-purple-50/40 p-5 rounded-2xl border-2 border-dashed border-indigo-200 hover:border-indigo-400 transition-all space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-lg shadow-sm shrink-0">
                            📁
                        </div>
                        <div>
                            <label for="gallery_files" class="block text-xs font-extrabold text-slate-900">
                                Upload Gallery Images from Computer
                            </label>
                            <span class="text-[11px] text-slate-500 font-medium">Select multiple photos at once (JPG, PNG, WEBP up to 16MB each).</span>
                        </div>
                    </div>

                    <input type="file" 
                           name="gallery_files[]" 
                           id="gallery_files" 
                           multiple 
                           accept="image/*" 
                           class="w-full px-4 py-3 bg-white border border-indigo-200 rounded-2xl text-xs text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer transition-all">

                    <!-- Selected Photos Live Preview Grid -->
                    <div id="new_gallery_preview_container" class="hidden space-y-2 pt-2 border-t border-indigo-100">
                        <span class="text-[11px] font-extrabold text-indigo-700 block" id="new_gallery_count_label">New Photos Selected:</span>
                        <div id="new_gallery_previews" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3"></div>
                    </div>
                    @error('gallery_files.*') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Existing Gallery Photos Grid -->
                @if(count($currentGallery) > 0)
                    <div class="space-y-2 pt-2">
                        <label class="block text-[11px] font-extrabold text-slate-700 uppercase tracking-wider">
                            Current Gallery Photos (Click "Remove" to delete any photo):
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" id="existing_gallery_container">
                            @foreach($currentGallery as $index => $gImg)
                                <div class="relative group bg-slate-50 rounded-2xl border border-slate-200 p-2 shadow-sm flex flex-col justify-between transition-all hover:border-slate-300" id="gallery_card_{{ $index }}">
                                    <div class="relative w-full h-24 rounded-xl overflow-hidden bg-slate-100">
                                        <img src="{{ $activity->getGalleryItemUrl($gImg) }}" 
                                             alt="Gallery Photo {{ $index + 1 }}" 
                                             class="w-full h-full object-cover transition-transform group-hover:scale-105"
                                             onerror="this.src='https://images.unsplash.com/photo-1579208575657-c595a05383b7?w=300&auto=format&fit=crop&q=80'">
                                        <span class="absolute top-1.5 left-1.5 px-1.5 py-0.5 bg-slate-900/70 text-white rounded text-[10px] font-bold">
                                            #{{ $index + 1 }}
                                        </span>
                                    </div>

                                    <input type="hidden" name="existing_gallery[]" value="{{ $gImg }}" id="existing_input_{{ $index }}">

                                    <div class="mt-2 pt-2 border-t border-slate-200 flex items-center justify-between gap-1">
                                        <span class="text-[9px] text-slate-400 font-medium truncate max-w-[80px]" title="{{ $gImg }}">{{ basename($gImg) }}</span>
                                        <button type="button" 
                                                onclick="toggleRemoveGallery('{{ $index }}', '{{ $gImg }}')" 
                                                id="remove_btn_{{ $index }}"
                                                class="px-2 py-1 text-[10px] font-bold text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-200 hover:border-rose-600 rounded-lg transition-all flex items-center space-x-1">
                                            <span>🗑️</span>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Optional Direct Image URLs / Paths Accordion -->
                <div x-data="{ openUrls: false }" class="border border-slate-200/80 rounded-2xl bg-white overflow-hidden">
                    <button type="button" 
                            @click="openUrls = !openUrls" 
                            class="w-full px-4 py-2.5 flex items-center justify-between text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                        <span class="flex items-center space-x-2">
                            <span>🔗</span>
                            <span>Or Add Custom Image URLs / Paths (Optional)</span>
                        </span>
                        <span x-text="openUrls ? '▲ Close' : '▼ Expand'" class="text-[10px] text-slate-400 font-semibold"></span>
                    </button>
                    <div x-show="openUrls" class="p-4 border-t border-slate-100 bg-slate-50/50 space-y-2">
                        <textarea name="gallery_images" 
                                  id="gallery_images" 
                                  rows="3" 
                                  placeholder="https://... or images/activities/..." 
                                  class="w-full px-4 py-2.5 bg-white border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 transition-all"></textarea>
                        <p class="text-[11px] text-slate-400">Separate multiple external image URLs or file paths by new lines.</p>
                    </div>
                </div>
            </div>

            <!-- Inline Section Update & Save Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" 
                        class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold rounded-full shadow-sm transition-all flex items-center space-x-1.5">
                    <span>✓</span>
                    <span>Update & Save Media</span>
                </button>
            </div>
        </div>

        <!-- Submit & Cancel Action Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-2">
            <a href="{{ route('admin.activities.index') }}" 
               class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-full border border-slate-200 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/20 transition-all">
                Update All Changes
            </button>
        </div>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('main_image');
    const urlInput = document.getElementById('main_image_url');
    const previewImg = document.getElementById('image_preview');
    const previewStatus = document.getElementById('preview_status');

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (previewImg) previewImg.src = event.target.result;
                    if (previewStatus) {
                        previewStatus.innerText = 'New File Selected: ' + file.name + ' (Pending Save)';
                        previewStatus.classList.remove('text-slate-900');
                        previewStatus.classList.add('text-emerald-600');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (urlInput) {
        urlInput.addEventListener('input', function(e) {
            const val = e.target.value.trim();
            if (val && (val.startsWith('http') || val.startsWith('/') || val.startsWith('images/'))) {
                if (previewImg) previewImg.src = val;
                if (previewStatus) {
                    previewStatus.innerText = 'URL Preview (Pending Save)';
                    previewStatus.classList.remove('text-slate-900');
                    previewStatus.classList.add('text-indigo-600');
                }
            }
        });
    }

    // Multiple Gallery Files Live Preview
    const galleryFilesInput = document.getElementById('gallery_files');
    const previewContainer = document.getElementById('new_gallery_preview_container');
    const previewsGrid = document.getElementById('new_gallery_previews');
    const countLabel = document.getElementById('new_gallery_count_label');

    if (galleryFilesInput) {
        galleryFilesInput.addEventListener('change', function() {
            previewsGrid.innerHTML = '';
            if (this.files && this.files.length > 0) {
                previewContainer.classList.remove('hidden');
                countLabel.textContent = `Selected ${this.files.length} New Photo(s) Ready to Upload:`;
                
                Array.from(this.files).forEach((file, idx) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const card = document.createElement('div');
                        card.className = 'relative bg-white rounded-xl border border-indigo-200 p-2 shadow-sm';
                        card.innerHTML = `
                            <div class="h-20 w-full rounded-lg overflow-hidden bg-slate-100">
                                <img src="${e.target.result}" class="w-full h-full object-cover">
                            </div>
                            <span class="text-[10px] text-slate-700 font-bold truncate block mt-1.5" title="${file.name}">${file.name}</span>
                            <span class="text-[9px] text-indigo-600 font-extrabold block">${(file.size / 1024).toFixed(0)} KB</span>
                        `;
                        previewsGrid.appendChild(card);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    }
});

// Remove Existing Gallery Item Handler
function toggleRemoveGallery(index, imgPath) {
    const card = document.getElementById(`gallery_card_${index}`);
    const input = document.getElementById(`existing_input_${index}`);
    const btn = document.getElementById(`remove_btn_${index}`);

    if (input.name === 'existing_gallery[]') {
        // Mark for removal
        input.name = 'remove_gallery[]';
        card.classList.add('opacity-40', 'border-rose-400', 'bg-rose-50/50');
        btn.innerHTML = '<span>↩️</span><span>Undo</span>';
        btn.className = 'px-2 py-1 text-[10px] font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-300 rounded-lg transition-all flex items-center space-x-1';
    } else {
        // Undo removal
        input.name = 'existing_gallery[]';
        card.classList.remove('opacity-40', 'border-rose-400', 'bg-rose-50/50');
        btn.innerHTML = '<span>🗑️</span><span>Remove</span>';
        btn.className = 'px-2 py-1 text-[10px] font-bold text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-600 border border-rose-200 hover:border-rose-600 rounded-lg transition-all flex items-center space-x-1';
    }
}
</script>
@endsection
