@extends('layouts.admin')

@section('title', 'Edit Service - ' . $service->title)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.services.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Services List</span>
            </a>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Edit Service</h2>
            <p class="text-xs text-slate-500 mt-0.5 font-medium">Update details for <span class="text-indigo-600 font-bold">'{{ $service->title }}'</span></p>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. Basic Service Info -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📌</span>
                <span>Basic Service Info</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Service Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $service->title) }}" 
                           required 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('title') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Short Title -->
                <div>
                    <label for="short_title" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Short Tagline
                    </label>
                    <input type="text" 
                           name="short_title" 
                           id="short_title" 
                           value="{{ old('short_title', $service->short_title) }}" 
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
                        @foreach(['Healthcare', 'Education', 'Environment', 'Welfare', 'Emergency Relief'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $service->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Icon Emoji -->
                <div>
                    <label for="icon" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Service Emoji Icon
                    </label>
                    <input type="text" 
                           name="icon" 
                           id="icon" 
                           value="{{ old('icon', $service->icon) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('icon') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Service Charge / Fee -->
                <div>
                    <label for="service_charge" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Service Fee / Charge (₹)
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="service_charge" 
                           id="service_charge" 
                           value="{{ old('service_charge', $service->service_charge) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
                    @error('service_charge') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
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
                        <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="upcoming" {{ old('status', $service->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    </select>
                    @error('status') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- 2. Logistics & Contact Person -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-sky-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📍</span>
                <span>Logistics & Contact Person</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Availability -->
                <div>
                    <label for="availability" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Availability Schedule
                    </label>
                    <input type="text" 
                           name="availability" 
                           id="availability" 
                           value="{{ old('availability', $service->availability) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('availability') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Service Location / Center
                    </label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="{{ old('location', $service->location) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('location') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Contact Person / Coordinator
                    </label>
                    <input type="text" 
                           name="contact_person" 
                           id="contact_person" 
                           value="{{ old('contact_person', $service->contact_person) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('contact_person') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Contact Phone -->
                <div>
                    <label for="contact_phone" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Contact Phone / Helpline
                    </label>
                    <input type="text" 
                           name="contact_phone" 
                           id="contact_phone" 
                           value="{{ old('contact_phone', $service->contact_phone) }}" 
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-sky-500 focus:bg-white transition-all">
                    @error('contact_phone') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- 3. Service Descriptions & Key Features -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                <span>📝</span>
                <span>Descriptions & Highlights</span>
            </h3>

            <div class="space-y-6">
                <!-- Short Summary -->
                <div>
                    <label for="description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Short Summary / Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="2" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('description', $service->description) }}</textarea>
                    @error('description') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Full Detailed Description -->
                <div>
                    <label for="full_description" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Full Service Overview
                    </label>
                    <textarea name="full_description" 
                              id="full_description" 
                              rows="4" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('full_description', $service->full_description) }}</textarea>
                    @error('full_description') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Features & Key Benefits -->
                <div>
                    <label for="features" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Key Features / Benefits
                    </label>
                    <textarea name="features" 
                              id="features" 
                              rows="3" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-amber-500 focus:bg-white transition-all">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : $service->features) }}</textarea>
                    @error('features') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- 4. Media & Cover Image -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm shadow-indigo-500/5 space-y-6">
            <h3 class="text-sm font-extrabold text-emerald-600 uppercase tracking-wider flex items-center space-x-2">
                <span>🖼️</span>
                <span>Media & Images</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Main Cover Image -->
                <div>
                    <label for="main_image" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Main Service Cover Image
                    </label>
                    
                    @if($service->main_image)
                        <div class="mb-3 flex items-center space-x-3 bg-slate-50 p-2.5 rounded-2xl border border-slate-200/80">
                            <img src="{{ $service->image_url }}" alt="Current Image" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shadow-sm">
                            <div>
                                <span class="text-xs font-bold text-slate-900 block">Current Image</span>
                                <span class="text-[10px] text-slate-400">Upload a new image below to replace it.</span>
                            </div>
                        </div>
                    @endif

                    <input type="file" 
                           name="main_image" 
                           id="main_image" 
                           accept="image/*" 
                           class="w-full px-4 py-2 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs text-slate-600 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-1">Recommended size: 800x600px. Max 4MB.</p>
                    @error('main_image') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Gallery Links -->
                <div>
                    <label for="gallery_images" class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Gallery Image Links (Comma or newline separated)
                    </label>
                    <textarea name="gallery_images" 
                              id="gallery_images" 
                              rows="3" 
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-2xl text-xs font-medium text-slate-900 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all">{{ old('gallery_images', is_array($service->gallery_images) ? implode("\n", $service->gallery_images) : $service->gallery_images) }}</textarea>
                    @error('gallery_images') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-2">
            <a href="{{ route('admin.services.index') }}" 
               class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-full border border-slate-200 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/20 transition-all">
                Update Service
            </button>
        </div>

    </form>

</div>
@endsection
