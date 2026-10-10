<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Volunteer;
use App\Models\Donation;
use App\Models\ContactMessage;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjectsCount = \App\Models\Activity::count() ?: Project::count();
        $totalVolunteersCount = Volunteer::count();
        $totalDonationsSum = Donation::where('payment_status', 'completed')->sum('amount');
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();
        $totalMessagesCount = ContactMessage::count();

        $recentActivities = ActivityLog::latest()->take(5)->get();
        $recentDonations = Donation::with('project')->latest()->take(5)->get();
        $recentVolunteers = Volunteer::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjectsCount',
            'totalVolunteersCount',
            'totalDonationsSum',
            'unreadMessagesCount',
            'totalMessagesCount',
            'recentActivities',
            'recentDonations',
            'recentVolunteers',
            'recentMessages'
        ));
    }
}
