<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of services with category filter & live search.
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'All');
        $search = $request->query('search');

        $query = Service::query();

        // Category Filter: All | Healthcare | Education | Environment | Welfare | Emergency Relief
        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }

        // Search Filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%");
            });
        }

        $services = $query->latest()->paginate(10)->withQueryString();

        return view('admin.services.index', compact('services', 'category', 'search'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in MySQL.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'category' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'service_charge' => 'nullable|numeric|min:0',
            'availability' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:100',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'gallery_images' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'required|in:active,inactive,upcoming',
        ]);

        // File upload handling for main_image
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('services', 'public');
            $validated['main_image'] = $path;
        }

        $service = Service::create($validated);

        // Log Activity
        ActivityLog::create([
            'title' => 'New Service Added',
            'description' => "Service '{$service->title}' was published under {$service->category}.",
            'type' => 'project',
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', "Service '{$service->title}' created successfully!");
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in MySQL.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'category' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'service_charge' => 'nullable|numeric|min:0',
            'availability' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:100',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'gallery_images' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'required|in:active,inactive,upcoming',
        ]);

        if ($request->hasFile('main_image')) {
            if ($service->main_image && !str_starts_with($service->main_image, 'http')) {
                Storage::disk('public')->delete($service->main_image);
            }
            $path = $request->file('main_image')->store('services', 'public');
            $validated['main_image'] = $path;
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', "Service '{$service->title}' updated successfully!");
    }

    /**
     * Remove the specified service from MySQL.
     */
    public function destroy(Service $service)
    {
        $title = $service->title;
        if ($service->main_image && !str_starts_with($service->main_image, 'http')) {
            Storage::disk('public')->delete($service->main_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', "Service '{$title}' deleted successfully!");
    }
}
