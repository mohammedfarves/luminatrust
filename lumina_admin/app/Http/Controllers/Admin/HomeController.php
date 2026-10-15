<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the Home page content summary and live impact metrics.
     */
    public function index()
    {
        $home = HomePage::firstOrCreate([], HomePage::defaultData());
        return view('admin.home.index', compact('home'));
    }

    /**
     * Show the edit form for Home Page sections and live impact counters.
     */
    public function edit()
    {
        $home = HomePage::firstOrCreate([], HomePage::defaultData());
        return view('admin.home.edit', compact('home'));
    }

    /**
     * Update the Home Page settings and impact metrics.
     */
    public function update(Request $request)
    {
        $home = HomePage::firstOrCreate([], HomePage::defaultData());

        $validated = $request->validate([
            // Hero Section
            'hero_badge_text' => 'nullable|string|max:255',
            'hero_title_line1' => 'nullable|string|max:255',
            'hero_title_line2' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_button_donate_text' => 'nullable|string|max:100',
            'hero_button_volunteer_text' => 'nullable|string|max:100',
            'hero_card_title' => 'nullable|string|max:255',
            'hero_card_subtitle' => 'nullable|string|max:255',
            'hero_stat_completed' => 'nullable|string|max:100',
            'hero_trust_badge_1' => 'nullable|string|max:100',
            'hero_trust_badge_2' => 'nullable|string|max:100',

            // Impact Counters (Numbers That Speak)
            'impact_subtitle' => 'nullable|string|max:100',
            'impact_title' => 'nullable|string|max:255',
            'counter_people_helped' => 'required|integer|min:0',
            'counter_people_helped_suffix' => 'nullable|string|max:20',
            'counter_people_helped_label' => 'required|string|max:100',
            'counter_volunteers' => 'required|integer|min:0',
            'counter_volunteers_suffix' => 'nullable|string|max:20',
            'counter_volunteers_label' => 'required|string|max:100',
            'counter_projects_done' => 'required|integer|min:0',
            'counter_projects_done_suffix' => 'nullable|string|max:20',
            'counter_projects_done_label' => 'required|string|max:100',
            'counter_communities' => 'required|integer|min:0',
            'counter_communities_suffix' => 'nullable|string|max:20',
            'counter_communities_label' => 'required|string|max:100',

            // About & Purpose Preview Section
            'about_subtitle' => 'nullable|string|max:100',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string|max:1000',
            'about_feature_1_title' => 'nullable|string|max:100',
            'about_feature_1_desc' => 'nullable|string|max:255',
            'about_feature_2_title' => 'nullable|string|max:100',
            'about_feature_2_desc' => 'nullable|string|max:255',

            // Newsletter Section
            'newsletter_subtitle' => 'nullable|string|max:100',
            'newsletter_title' => 'nullable|string|max:255',
            'newsletter_description' => 'nullable|string|max:1000',
        ]);

        $home->update($validated);

        // Record Activity Log
        ActivityLog::create([
            'title' => 'Home Page & Impact Metrics Updated',
            'description' => 'Admin updated Home page hero content and live impact counter numbers.',
            'type' => 'project',
        ]);

        return redirect()->route('admin.home.index')
            ->with('success', 'Home Page sections and live impact counter numbers updated successfully!');
    }
}
