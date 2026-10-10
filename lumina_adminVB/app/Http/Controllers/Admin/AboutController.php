<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display the About page summary and preview.
     */
    public function index()
    {
        $defaultCoreValues = [
            ['title' => 'Integrity & Accountability', 'description' => 'Honest, transparent operations.'],
            ['title' => 'Inclusive Growth', 'description' => 'Equal opportunities for all.'],
            ['title' => 'Compassionate Action', 'description' => 'Serving with empathy & care.'],
            ['title' => 'Sustainable Impact', 'description' => 'Long-term self-reliance.'],
        ];

        $about = AboutPage::firstOrCreate([], [
            'title' => 'About Lumina Trust',
            'subtitle' => 'Dedicated Non-Profit Organization',
            'story' => 'Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work at the grassroots level to enable individuals and communities to achieve dignity, independence, and long-term growth.',
            'hero_button_text' => 'Our Initiatives',
            'hero_button_link' => '/projects',
            'secondary_button_text' => 'Support Our Cause',
            'secondary_button_link' => '/donate',
            'who_we_are_title' => 'Uplifting Underserved Communities with Dignity',
            'who_we_are_description' => 'Lumina Trust is a purpose-driven organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work directly at the grassroots level to create meaningful change by enabling individuals and communities to achieve dignity, independence, and long-term growth.',
            'image_badge_text' => '100% Non-Profit NGO',
            'mission' => 'To transform lives by providing direct access to quality education, skill development programs, preventive health awareness, and sustainable livelihood opportunities.',
            'vision' => 'Empowered communities living with dignity, equality, and opportunity.',
            'established_year' => '2018',
            'founder_name' => 'Ananya Kapoor',
            'founder_title' => 'Founder & CEO',
            'founder_message' => 'Together, we aim to illuminate lives and build a brighter, more equitable future for all.',
            'beneficiaries_count' => '10,000+',
            'projects_count' => '150+',
            'volunteers_count' => '500+',
            'cities_count' => '25+',
            'core_values' => $defaultCoreValues,
        ]);

        // If core_values is empty or string array, normalize it
        if (empty($about->core_values)) {
            $about->core_values = $defaultCoreValues;
        }

        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the edit form for About Page content.
     */
    public function edit()
    {
        $about = AboutPage::firstOrCreate([]);
        if (empty($about->core_values)) {
            $about->core_values = [
                ['title' => 'Integrity & Accountability', 'description' => 'Honest, transparent operations.'],
                ['title' => 'Inclusive Growth', 'description' => 'Equal opportunities for all.'],
                ['title' => 'Compassionate Action', 'description' => 'Serving with empathy & care.'],
                ['title' => 'Sustainable Impact', 'description' => 'Long-term self-reliance.'],
            ];
        }
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the About Page content in MySQL.
     */
    public function update(Request $request)
    {
        $about = AboutPage::firstOrCreate([]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'story' => 'nullable|string',
            'hero_button_text' => 'nullable|string|max:255',
            'hero_button_link' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:255',
            'secondary_button_link' => 'nullable|string|max:255',
            'who_we_are_title' => 'nullable|string|max:255',
            'who_we_are_description' => 'nullable|string',
            'image_badge_text' => 'nullable|string|max:255',
            'mission' => 'nullable|string',
            'mission_title' => 'nullable|string|max:255',
            'mission_points' => 'nullable|array',
            'mission_points.*' => 'nullable|string|max:255',
            'vision' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_points' => 'nullable|array',
            'vision_points.*' => 'nullable|string|max:255',
            'impact_subtitle' => 'nullable|string|max:255',
            'impact_title' => 'nullable|string|max:255',
            'impact_description' => 'nullable|string',
            'impact_items' => 'nullable|array',
            'impact_items.*.title' => 'nullable|string|max:255',
            'impact_items.*.description' => 'nullable|string|max:500',
            'process_subtitle' => 'nullable|string|max:255',
            'process_title' => 'nullable|string|max:255',
            'process_description' => 'nullable|string',
            'process_steps' => 'nullable|array',
            'process_steps.*.step' => 'nullable|string|max:50',
            'process_steps.*.title' => 'nullable|string|max:255',
            'process_steps.*.description' => 'nullable|string|max:500',
            'team_subtitle' => 'nullable|string|max:255',
            'team_title' => 'nullable|string|max:255',
            'team_description' => 'nullable|string',
            'team_members' => 'nullable|array',
            'team_members.*.name' => 'nullable|string|max:255',
            'team_members.*.role' => 'nullable|string|max:255',
            'team_members.*.desc' => 'nullable|string|max:500',
            'established_year' => 'nullable|string|max:50',
            'founder_name' => 'nullable|string|max:255',
            'founder_title' => 'nullable|string|max:255',
            'founder_message' => 'nullable|string',
            'beneficiaries_count' => 'nullable|string|max:50',
            'projects_count' => 'nullable|string|max:50',
            'volunteers_count' => 'nullable|string|max:50',
            'cities_count' => 'nullable|string|max:50',
            'core_values' => 'nullable|array',
            'core_values.*.title' => 'nullable|string|max:255',
            'core_values.*.description' => 'nullable|string|max:500',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'founder_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->has('vision_points') && is_array($request->vision_points)) {
            $validated['vision_points'] = array_values(array_filter(array_map('trim', $request->vision_points)));
        }
        if ($request->has('mission_points') && is_array($request->mission_points)) {
            $validated['mission_points'] = array_values(array_filter(array_map('trim', $request->mission_points)));
        }

        // Process impact_items array into structured objects
        $processedImpactItems = [];
        if ($request->has('impact_items') && is_array($request->impact_items)) {
            foreach ($request->impact_items as $item) {
                if (is_array($item)) {
                    $t = trim($item['title'] ?? '');
                    $d = trim($item['description'] ?? '');
                    if ($t !== '' || $d !== '') {
                        $processedImpactItems[] = [
                            'title' => $t,
                            'description' => $d,
                        ];
                    }
                }
            }
        }
        $validated['impact_items'] = $processedImpactItems;

        // Process process_steps array into structured objects
        $processedProcessSteps = [];
        if ($request->has('process_steps') && is_array($request->process_steps)) {
            foreach ($request->process_steps as $item) {
                if (is_array($item)) {
                    $s = trim($item['step'] ?? '');
                    $t = trim($item['title'] ?? '');
                    $d = trim($item['description'] ?? '');
                    if ($t !== '' || $d !== '') {
                        $processedProcessSteps[] = [
                            'step' => $s,
                            'title' => $t,
                            'description' => $d,
                        ];
                    }
                }
            }
        }
        $validated['process_steps'] = $processedProcessSteps;

        // Process team_members array into structured objects
        $processedTeamMembers = [];
        if ($request->has('team_members') && is_array($request->team_members)) {
            foreach ($request->team_members as $item) {
                if (is_array($item)) {
                    $n = trim($item['name'] ?? '');
                    $r = trim($item['role'] ?? '');
                    $d = trim($item['desc'] ?? ($item['description'] ?? ''));
                    if ($n !== '' || $r !== '') {
                        $processedTeamMembers[] = [
                            'name' => $n,
                            'role' => $r,
                            'desc' => $d,
                            'description' => $d,
                        ];
                    }
                }
            }
        }
        $validated['team_members'] = $processedTeamMembers;

        // Process core_values array into structured objects
        $processedCoreValues = [];
        if ($request->has('core_values') && is_array($request->core_values)) {
            foreach ($request->core_values as $item) {
                if (is_array($item)) {
                    $t = trim($item['title'] ?? '');
                    $d = trim($item['description'] ?? '');
                    if ($t !== '' || $d !== '') {
                        $processedCoreValues[] = [
                            'title' => $t,
                            'description' => $d,
                        ];
                    }
                } elseif (is_string($item) && trim($item) !== '') {
                    $processedCoreValues[] = [
                        'title' => trim($item),
                        'description' => '',
                    ];
                }
            }
        }
        $validated['core_values'] = $processedCoreValues;

        // Upload main_image
        if ($request->hasFile('main_image')) {
            if ($about->main_image && !str_starts_with($about->main_image, 'http')) {
                Storage::disk('public')->delete($about->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('about', 'public');
        }

        // Upload founder_image
        if ($request->hasFile('founder_image')) {
            if ($about->founder_image && !str_starts_with($about->founder_image, 'http')) {
                Storage::disk('public')->delete($about->founder_image);
            }
            $validated['founder_image'] = $request->file('founder_image')->store('about', 'public');
        }

        $about->update($validated);

        // Log Activity
        ActivityLog::create([
            'title' => 'About Page Updated',
            'description' => 'Admin updated Lumina Trust About page story, mission, and impact metrics.',
            'type' => 'project',
        ]);

        return redirect()->route('admin.about.index')
            ->with('success', 'About Page details updated successfully!');
    }
}
