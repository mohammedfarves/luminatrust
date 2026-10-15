<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities with category filter & live search.
     */
    public function index(Request $request)
    {
        $category = $request->query('category', 'All');
        $search = $request->query('search');

        $query = Activity::query();

        // Category Filter: All | Education | Health | Environment | Water
        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }

        // Search Filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $activities = $query->latest()->paginate(10)->withQueryString();

        return view('admin.activities.index', compact('activities', 'category', 'search'));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created activity in MySQL.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'participants' => 'nullable|string|max:255',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'raised_amount' => 'nullable|numeric|min:0',
            'goal_amount' => 'nullable|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'gallery_images' => 'nullable|string',
            'objectives' => 'nullable|string',
            'highlights' => 'nullable|string',
            'quote' => 'nullable|string',
            'status' => 'required|in:active,completed,upcoming',
        ]);

        // File upload handling for main_image
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('activities', 'public');
            $validated['main_image'] = $path;
        }

        $activity = Activity::create($validated);

        // Log Activity
        ActivityLog::create([
            'title' => 'New Activity Created',
            'description' => "Activity '{$activity->title}' was added under {$activity->category}.",
            'type' => 'project',
        ]);

        return redirect()->route('admin.activities.index')
            ->with('success', "Activity '{$activity->title}' created successfully!");
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified activity in MySQL.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'participants' => 'nullable|string|max:255',
            'progress_percent' => 'nullable|integer|min:0|max:100',
            'raised_amount' => 'nullable|numeric|min:0',
            'goal_amount' => 'nullable|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'gallery_images' => 'nullable|string',
            'objectives' => 'nullable|string',
            'highlights' => 'nullable|string',
            'quote' => 'nullable|string',
            'status' => 'required|in:active,completed,upcoming',
        ]);

        if ($request->hasFile('main_image')) {
            // Delete old image if stored locally
            if ($activity->main_image && !str_starts_with($activity->main_image, 'http')) {
                Storage::disk('public')->delete($activity->main_image);
            }
            $path = $request->file('main_image')->store('activities', 'public');
            $validated['main_image'] = $path;
        }

        $activity->update($validated);

        return redirect()->route('admin.activities.index')
            ->with('success', "Activity '{$activity->title}' updated successfully!");
    }

    /**
     * Remove the specified activity from MySQL.
     */
    public function destroy(Activity $activity)
    {
        $title = $activity->title;
        if ($activity->main_image && !str_starts_with($activity->main_image, 'http')) {
            Storage::disk('public')->delete($activity->main_image);
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', "Activity '{$title}' deleted successfully!");
    }
}
