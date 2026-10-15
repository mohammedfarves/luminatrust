@extends('layouts.admin')

@section('title', 'Add New Activity')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Activities List</span>
            </a>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Create New Activity</h2>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Fill in the fields below to publish a project, event, or community drive.</p>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('admin.activities.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

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
                           value="{{ old('title') }}" 
                           placeholder="e.g. Book & Stationery Distribution Drive" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
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
                           value="{{ old('short_title') }}" 
                           placeholder="e.g. Empowering 200+ Students" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
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
                        <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Health" {{ old('category') == 'Health' ? 'selected' : '' }}>Health</option>
                        <option value="Environment" {{ old('category') == 'Environment' ? 'selected' : '' }}>Environment</option>
                        <option value="Water" {{ old('category') == 'Water' ? 'selected' : '' }}>Water</option>
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
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
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
                           value="{{ old('location') }}" 
                           placeholder="e.g. Primary School, Govt Sector 4" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('location') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
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
                           value="{{ old('date') }}" 
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
                           value="{{ old('time') }}" 
                           placeholder="e.g. 09:00 AM - 04:00 PM" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
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
                           value="{{ old('participants') }}" 
                           placeholder="e.g. 50+ Volunteers & 200 Students" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
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
                           value="{{ old('progress_percent', 0) }}" 
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
                           value="{{ old('raised_amount', 0) }}" 
                           placeholder="0.00" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
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
                           value="{{ old('goal_amount', 0) }}" 
                           placeholder="0.00" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('goal_amount') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
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
                              placeholder="Brief overview displayed on cards and list items..." 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('description') }}</textarea>
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
                              placeholder="Complete story, background, and implementation details of this activity..." 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('full_description') }}</textarea>
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
                                  placeholder="List key targets or goals..." 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('objectives') }}</textarea>
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
                                  placeholder="Notable achievements or stats..." 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('highlights') }}</textarea>
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
                                  placeholder="Inspiring quote from a beneficiary or leader..." 
                                  class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('quote') }}</textarea>
                        @error('quote') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Media & Gallery Images -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-emerald-600 uppercase tracking-wider flex items-center space-x-2">
                <span>🖼️</span>
                <span>Media & Images</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Main Image File Input -->
                <div>
                    <label for="main_image" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Main Activity Cover Image
                    </label>
                    <input type="file" 
                           name="main_image" 
                           id="main_image" 
                           accept="image/*" 
                           class="w-full px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-1">Recommended size: 800x600px. Supports JPG, PNG, WEBP up to 4MB.</p>
                    @error('main_image') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Gallery Images List / URLs -->
                <div>
                    <label for="gallery_images" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Gallery Image Links (Comma or newline separated)
                    </label>
                    <textarea name="gallery_images" 
                              id="gallery_images" 
                              rows="3" 
                              placeholder="https://images.unsplash.com/photo-1..., https://..." 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all">{{ old('gallery_images') }}</textarea>
                    @error('gallery_images') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
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
                Save & Publish Activity
            </button>
        </div>

    </form>

</div>
@endsection
