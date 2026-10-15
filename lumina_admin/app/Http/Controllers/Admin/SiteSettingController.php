<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display the site settings editing form.
     */
    public function index()
    {
        $setting = SiteSetting::firstOrCreate([], SiteSetting::defaultData());
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Update the site settings in database.
     */
    public function update(Request $request)
    {
        $setting = SiteSetting::firstOrCreate([], SiteSetting::defaultData());

        $validated = $request->validate([
            // Contact Details
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'secondary_phone' => 'nullable|string|max:50',
            'whatsapp_number' => 'nullable|string|max:50',
            'address' => 'required|string|max:500',
            'map_link' => 'nullable|string|max:1000',
            'working_hours' => 'nullable|string|max:255',

            // Social Media Links
            'facebook_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',

            // Organization & General Info
            'site_title' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:100',
            'tax_exemption_info' => 'nullable|string|max:255',
            'footer_about' => 'nullable|string|max:1000',
        ]);

        $setting->update($validated);

        // Record Activity Log
        ActivityLog::create([
            'title' => 'Site Settings Updated',
            'description' => 'Admin updated global contact info, phone, email, and social media handles.',
            'type' => 'project',
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Site settings updated successfully!');
    }
}
