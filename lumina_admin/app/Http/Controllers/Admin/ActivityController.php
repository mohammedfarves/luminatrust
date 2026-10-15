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
        if (Activity::count() === 0) {
            Activity::seedDefaults();
        }

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
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
            'main_image_url' => 'nullable|string|max:500',
            'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
            'gallery_images' => 'nullable|string',
            'objectives' => 'nullable|string',
            'highlights' => 'nullable|string',
            'quote' => 'nullable|string',
            'status' => 'required|in:active,completed,upcoming',
        ]);

        // File upload handling for main_image
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $uploadDir = public_path('images/activities/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['main_image'] = 'images/activities/uploads/' . $filename;
        } elseif ($request->filled('main_image_url')) {
            $validated['main_image'] = trim($request->input('main_image_url'));
        }
        unset($validated['main_image_url']);

        // Gallery images upload handling
        $gallery = [];
        if ($request->hasFile('gallery_files')) {
            $uploadDir = public_path('images/activities/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            foreach ($request->file('gallery_files') as $gFile) {
                if ($gFile && $gFile->isValid()) {
                    $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $gFile->getClientOriginalExtension();
                    $gFile->move($uploadDir, $filename);
                    $gallery[] = 'images/activities/uploads/' . $filename;
                }
            }
        }
        if ($request->filled('gallery_images')) {
            $manualUrls = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $request->input('gallery_images'))));
            foreach ($manualUrls as $mUrl) {
                if (!empty($mUrl) && !in_array($mUrl, $gallery)) {
                    $gallery[] = $mUrl;
                }
            }
        }
        $validated['gallery_images'] = !empty($gallery) ? implode("\n", array_unique($gallery)) : null;
        unset($validated['gallery_files']);

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
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
            'main_image_url' => 'nullable|string|max:500',
            'gallery_files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16384',
            'gallery_images' => 'nullable|string',
            'existing_gallery' => 'nullable|array',
            'remove_gallery' => 'nullable|array',
            'objectives' => 'nullable|string',
            'highlights' => 'nullable|string',
            'quote' => 'nullable|string',
            'status' => 'required|in:active,completed,upcoming',
        ]);

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $uploadDir = public_path('images/activities/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);

            // Clean up old upload if it was a custom upload
            if ($activity->main_image && str_starts_with($activity->main_image, 'images/activities/uploads/')) {
                $oldPath = public_path($activity->main_image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            } elseif ($activity->main_image && !str_starts_with($activity->main_image, 'http') && !str_starts_with($activity->main_image, 'images/activities/')) {
                Storage::disk('public')->delete($activity->main_image);
            }

            $validated['main_image'] = 'images/activities/uploads/' . $filename;
        } elseif ($request->filled('main_image_url')) {
            $validated['main_image'] = trim($request->input('main_image_url'));
        }
        unset($validated['main_image_url']);

        // Handle Gallery Images (Preserve, Remove, and Append New Uploads)
        $gallery = [];
        $existing = $request->input('existing_gallery', []);
        $toRemove = $request->input('remove_gallery', []);

        // 1. Keep existing images not marked for removal
        foreach ($existing as $img) {
            $img = trim($img);
            if (empty($img)) continue;

            if (in_array($img, $toRemove)) {
                // If it was an uploaded file, delete from disk
                if (str_starts_with($img, 'images/activities/uploads/')) {
                    $oldGPath = public_path($img);
                    if (file_exists($oldGPath)) {
                        @unlink($oldGPath);
                    }
                }
            } else {
                $gallery[] = $img;
            }
        }

        // 2. Upload new gallery files from computer
        if ($request->hasFile('gallery_files')) {
            $uploadDir = public_path('images/activities/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            foreach ($request->file('gallery_files') as $gFile) {
                if ($gFile && $gFile->isValid()) {
                    $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $gFile->getClientOriginalExtension();
                    $gFile->move($uploadDir, $filename);
                    $gallery[] = 'images/activities/uploads/' . $filename;
                }
            }
        }

        // 3. Any additional direct URLs entered
        if ($request->filled('gallery_images')) {
            $manualUrls = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $request->input('gallery_images'))));
            foreach ($manualUrls as $mUrl) {
                if (!empty($mUrl) && !in_array($mUrl, $gallery)) {
                    $gallery[] = $mUrl;
                }
            }
        }

        // If the form didn't pass existing_gallery (legacy textarea only), fallback to textarea
        if (!$request->has('existing_gallery') && $request->filled('gallery_images')) {
            $gallery = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $request->input('gallery_images'))));
        }

        $validated['gallery_images'] = !empty($gallery) ? implode("\n", array_unique($gallery)) : null;
        unset($validated['gallery_files'], $validated['existing_gallery'], $validated['remove_gallery']);

        $activity->update($validated);

        return redirect()->route('admin.activities.edit', $activity)
            ->with('success', "Activity '{$activity->title}' updated successfully!");
    }

    /**
     * Remove the specified activity from MySQL.
     */
    public function destroy(Activity $activity)
    {
        $title = $activity->title;
        if ($activity->main_image && str_starts_with($activity->main_image, 'images/activities/uploads/')) {
            $oldPath = public_path($activity->main_image);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        } elseif ($activity->main_image && !str_starts_with($activity->main_image, 'http') && !str_starts_with($activity->main_image, 'images/activities/')) {
            Storage::disk('public')->delete($activity->main_image);
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', "Activity '{$title}' deleted successfully!");
    }
}
