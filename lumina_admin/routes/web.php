<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AuthController;

// Public Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);

// Protected Admin Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    // Dashboard Routes
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Admin CRUD Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('activities', ActivityController::class);
        Route::resource('services', ServiceController::class);

        // Home Page & Impact Metrics Routes
        Route::get('home', [HomeController::class, 'index'])->name('home.index');
        Route::get('home/edit', [HomeController::class, 'edit'])->name('home.edit');
        Route::put('home', [HomeController::class, 'update'])->name('home.update');

        // About Page Routes
        Route::get('about', [AboutController::class, 'index'])->name('about.index');
        Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutController::class, 'update'])->name('about.update');

        // Site Settings Routes
        Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
    });
});

// Public API Route for Site Settings (Contact, Phone, Email, Social Media)
Route::get('/api/settings', function () {
    $setting = \App\Models\SiteSetting::firstOrCreate([], \App\Models\SiteSetting::defaultData());
    return response()->json($setting)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

// Public API Route for Home Page & Live Impact Counters
Route::get('/api/home', function () {
    $home = \App\Models\HomePage::firstOrCreate([], \App\Models\HomePage::defaultData());
    return response()->json($home)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

// Public API Route for Frontend
Route::get('/api/about', function () {
    $defaultCoreValues = [
        ['title' => 'Integrity & Accountability', 'description' => 'Honest, transparent operations.'],
        ['title' => 'Inclusive Growth', 'description' => 'Equal opportunities for all.'],
        ['title' => 'Compassionate Action', 'description' => 'Serving with empathy & care.'],
        ['title' => 'Sustainable Impact', 'description' => 'Long-term self-reliance.'],
    ];

    $about = \App\Models\AboutPage::firstOrCreate([], [
        'title' => 'About Lumina Trust',
        'subtitle' => 'Dedicated Non-Profit Organization',
        'story' => 'Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work at the grassroots level to enable individuals and communities to achieve dignity, independence, and long-term growth.',
        'mission' => 'To transform lives by providing direct access to quality education, skill development programs, preventive health awareness, and sustainable livelihood opportunities.',
        'vision' => 'Empowered communities living with dignity, equality, and opportunity.',
        'established_year' => '2018',
        'beneficiaries_count' => '10,000+',
        'projects_count' => '150+',
        'volunteers_count' => '50+',
        'cities_count' => '25+',
        'core_values' => $defaultCoreValues,
    ]);

    $rawValues = $about->core_values;
    if (empty($rawValues)) {
        $rawValues = $defaultCoreValues;
    }

    $formattedValues = array_map(function($v) {
        if (is_array($v)) {
            $t = $v['title'] ?? ($v['label'] ?? '');
            $d = $v['description'] ?? ($v['desc'] ?? 'Grassroots community initiative.');
            return [
                'title' => $t,
                'label' => $t,
                'description' => $d,
                'desc' => $d,
            ];
        }
        return [
            'title' => (string)$v,
            'label' => (string)$v,
            'description' => 'Grassroots community initiative.',
            'desc' => 'Grassroots community initiative.',
        ];
    }, (array)$rawValues);

    $data = $about->toArray();
    $data['core_values'] = array_values($formattedValues);
    $data['vision_title'] = $about->vision_title ?: 'Empowered Communities Living with Dignity & Equality';
    $data['vision_points'] = !empty($about->vision_points) ? $about->vision_points : [
        'Self-reliant grassroots development',
        'Equal access to education and training',
        'Healthy, sustainable, and green environments'
    ];
    $data['mission_title'] = $about->mission_title ?: 'Transforming Lives Through Education & Healthcare';
    $data['mission_points'] = !empty($about->mission_points) ? $about->mission_points : [
        'Free educational support & exam materials',
        'Free medical check-up drives & health awareness',
        'Vocational guidance & youth skill building'
    ];
    $data['impact_subtitle'] = $about->impact_subtitle ?: 'Areas of Impact';
    $data['impact_title'] = $about->impact_title ?: 'Where We Make a Difference';
    $data['impact_description'] = $about->impact_description ?: 'Our integrated programs address key pillars of community welfare for holistic social improvement.';
    $data['impact_items'] = !empty($about->impact_items) ? $about->impact_items : [
        ['title' => 'Education & Literacy', 'description' => 'Distributing free books, notebooks, competitive exam kits, and conducting academic training for government school students.'],
        ['title' => 'Health & Healthcare', 'description' => 'Organizing free medical camps, wellness awareness sessions, and honoring healthcare professionals for dedicated service.'],
        ['title' => 'Environment & Ecology', 'description' => 'Leading plastic-free drives, beach cleanups, sparrow box distribution, and massive tree plantation initiatives.'],
        ['title' => 'Skills & Livelihood', 'description' => 'Career guidance, youth skill training, and empowering women to achieve economic independence and dignity.']
    ];
    $data['process_subtitle'] = $about->process_subtitle ?: 'Our Process';
    $data['process_title'] = $about->process_title ?: 'How We Work';
    $data['process_description'] = $about->process_description ?: 'Our systematic approach ensures every initiative reaches the right beneficiaries with maximum accountability.';
    $data['process_steps'] = !empty($about->process_steps) ? $about->process_steps : [
        ['step' => '01', 'title' => 'Needs Assessment', 'description' => 'We conduct grassroots surveys and interact directly with rural & urban communities to understand real gaps.'],
        ['step' => '02', 'title' => 'Program Planning', 'description' => 'We design tailored educational kits, healthcare camps, and skill workshops with actionable milestones.'],
        ['step' => '03', 'title' => 'Field Execution', 'description' => 'Our dedicated team and volunteers collaborate with schools, doctors, and local bodies to execute efficiently.'],
        ['step' => '04', 'title' => 'Impact & Growth', 'description' => 'We continuously monitor outcomes, gather beneficiary feedback, and ensure long-term community self-reliance.']
    ];
    $data['team_subtitle'] = $about->team_subtitle ?: 'Leadership';
    $data['team_title'] = $about->team_title ?: 'Meet Our Team';
    $data['team_description'] = $about->team_description ?: 'Dedicated professionals driving positive grassroots change every day.';
    $data['team_members'] = !empty($about->team_members) ? $about->team_members : [
        ['name' => 'Ananya Kapoor', 'role' => 'Founder & CEO', 'desc' => 'Visionary leader passionate about social equity and grassroots empowerment.'],
        ['name' => 'Vikram Mehta', 'role' => 'Director of Operations', 'desc' => 'Oversees program deployment, partner engagement, and field logistics.'],
        ['name' => 'Dr. Lakshmi Rao', 'role' => 'Head of Healthcare', 'desc' => 'Leads free medical camps, community health initiatives, and doctor drives.'],
        ['name' => 'Arjun Singh', 'role' => 'Community Director', 'desc' => 'Drives student education programs, skill workshops, and volunteer mobilization.']
    ];
    $data['main_image_url'] = $about->image_url;
    $data['founder_image_url'] = $about->founder_image_url;

    return response()->json($data)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

// Public API Route for Activities / Projects
Route::get('/api/activities', function () {
    if (\App\Models\Activity::count() === 0) {
        \App\Models\Activity::seedDefaults();
    }

    $activities = \App\Models\Activity::latest()->get()->map(function($act) {
        return [
            'id' => $act->short_title ?: (string)$act->id,
            'db_id' => $act->id,
            'title' => $act->title,
            'shortTitle' => $act->short_title ?: $act->title,
            'category' => $act->category,
            'description' => $act->description,
            'fullDescription' => array_filter(array_map('trim', explode("\n", $act->full_description ?: $act->description))),
            'date' => $act->date ? $act->date->format('d M Y') : null,
            'time' => $act->time ?: '10:00 AM - 04:00 PM',
            'location' => $act->location ?: 'Nagapattinam',
            'participants' => $act->participants ?: '100+ Participants',
            'progress' => $act->progress_percent ?? 0,
            'raised' => $act->raised_amount > 0 ? number_format($act->raised_amount, 0) : 'Completed',
            'goal' => $act->goal_amount > 0 ? '₹' . number_format($act->goal_amount, 0) : 'Successful',
            'image' => $act->image_url,
            'galleryImages' => $act->formatted_gallery,
            'status' => $act->status,
        ];
    });

    return response()->json($activities)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

Route::get('/api/activities/{id}', function ($id) {
    $act = \App\Models\Activity::where('short_title', $id)->orWhere('id', $id)->first();
    if (!$act) {
        return response()->json(['message' => 'Activity not found'], 404);
    }

    $data = [
        'id' => $act->short_title ?: (string)$act->id,
        'db_id' => $act->id,
        'title' => $act->title,
        'shortTitle' => $act->short_title ?: $act->title,
        'category' => $act->category,
        'description' => $act->description,
        'fullDescription' => array_filter(array_map('trim', explode("\n", $act->full_description ?: $act->description))),
        'date' => $act->date ? $act->date->format('d M Y') : null,
        'time' => $act->time ?: '10:00 AM - 04:00 PM',
        'location' => $act->location ?: 'Nagapattinam',
        'participants' => $act->participants ?: '100+ Participants',
        'progress' => $act->progress_percent ?? 0,
        'raised' => $act->raised_amount > 0 ? number_format($act->raised_amount, 0) : 'Completed',
        'goal' => $act->goal_amount > 0 ? '₹' . number_format($act->goal_amount, 0) : 'Successful',
        'image' => $act->image_url,
        'galleryImages' => $act->formatted_gallery,
        'objectives' => array_filter(array_map('trim', explode("\n", $act->objectives ?: ''))),
        'highlights' => array_filter(array_map('trim', explode("\n", $act->highlights ?: ''))),
        'quote' => $act->quote,
        'status' => $act->status,
    ];

    return response()->json($data)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});


