<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AboutController;

// Dashboard Routes
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard.index');

// Admin CRUD Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('activities', ActivityController::class);
    Route::resource('services', ServiceController::class);

    // About Page Routes
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');
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
    if (\App\Models\Activity::count() === 0 || \App\Models\Activity::where('main_image', 'like', '%unsplash%')->exists()) {
        \App\Models\Activity::truncate();
        $defaultActivities = [
            [
                'title' => 'Pedal for Planet – Bicycle Rally Awareness Campaign',
                'short_title' => 'pedal-for-planet',
                'category' => 'Completed',
                'description' => 'Join our community cycling rally to raise awareness for climate change and promote green living.',
                'full_description' => "Lumina Trust organized a Bicycle Rally Awareness Campaign to promote cycling as a healthy, eco-friendly and sustainable mode of transportation.\nThe campaign brought together school children, volunteers, cycling enthusiasts, community members and well-wishers.",
                'date' => '2026-06-01',
                'time' => '8:00 AM – 12:00 PM',
                'location' => 'Nagapattinam Collector Office',
                'participants' => '200+ Participants',
                'progress_percent' => 100,
                'raised_amount' => 0,
                'goal_amount' => 0,
                'main_image' => 'images/activities/CYCLEING/c1.jpeg',
                'gallery_images' => "images/activities/CYCLEING/c1.jpeg\nimages/activities/CYCLEING/c2.jpeg\nimages/activities/CYCLEING/c3.jpeg",
                'objectives' => "Promote cycling as an eco-friendly mode of transportation\nEncourage children to adopt active and healthy lifestyles\nCreate awareness about environmental conservation",
                'highlights' => "Cycling rally starting from Nagapattinam Collector Office\nAwareness session on climate change\nTree sapling distribution",
                'quote' => "A cleaner planet is not a choice, it's a responsibility.",
                'status' => 'completed',
            ],
            [
                'title' => 'Government Exam Preparation Training – Empowering Aspirants',
                'short_title' => 'exam-prep-training',
                'category' => 'Education',
                'description' => 'Empowering Aspirants Through Education – A focused training session to guide and prepare students for government and competitive examinations.',
                'full_description' => "Lumina Trust conducted a training session to support students preparing for government and competitive examinations.\nThe session focused on exam preparation, guidance, and building confidence among aspiring candidates.",
                'date' => '2026-04-28',
                'time' => '9:00 AM – 4:00 PM',
                'location' => 'Nagapattinam',
                'participants' => '80+ Exam Aspirants',
                'progress_percent' => 100,
                'raised_amount' => 0,
                'goal_amount' => 0,
                'main_image' => 'images/activities/exam-prep-training.png',
                'gallery_images' => "images/activities/exam-prep-training.png",
                'objectives' => "Provide expert guidance for competitive and government exams\nDistribute structured study materials\nBuild confidence and clarity",
                'highlights' => "Orientation session by subject experts\nDistribution of study kits\nMock practice tests",
                'quote' => "Empowering youth through knowledge opens doors to unlimited possibilities.",
                'status' => 'completed',
            ],
            [
                'title' => 'Building Stronger Community Partnerships – Meeting with Nagapattinam MLA',
                'short_title' => 'mla-meeting',
                'category' => 'Completed',
                'description' => 'Lumina Trust participated in a meeting with the Honourable MLA of Nagapattinam to discuss community development, social welfare, and education.',
                'full_description' => "Lumina Trust participated in a meeting with the Honourable Member of the Legislative Assembly (MLA), Nagapattinam, along with community representatives.",
                'date' => '2026-05-15',
                'time' => '11:00 AM – 1:00 PM',
                'location' => 'Nagapattinam, Tamil Nadu',
                'participants' => 'Lumina Trust & Community Representatives',
                'progress_percent' => 100,
                'raised_amount' => 0,
                'goal_amount' => 0,
                'main_image' => 'images/activities/mla-meeting.jpg',
                'gallery_images' => "images/activities/mla-meeting.jpg",
                'quote' => "Collaboration between leaders and community brings lasting social transformation.",
                'status' => 'completed',
            ],
            [
                'title' => 'Celebrating National Librarian’s Day 2026 – Book Distribution Event',
                'short_title' => 'book-distribution',
                'category' => 'Education',
                'description' => 'Providing free books, notebooks, and essential study materials to school students in need.',
                'full_description' => "On the occasion of National Librarian’s Day, Lumina Trust organized a meaningful book distribution initiative for school students.\nBooks were distributed to school students to promote reading habits, knowledge, and lifelong learning.",
                'date' => '2026-08-12',
                'time' => '10:00 AM – 1:00 PM',
                'location' => 'Nagapattinam',
                'participants' => '150+ Students',
                'progress_percent' => 75,
                'raised_amount' => 375000,
                'goal_amount' => 500000,
                'main_image' => 'images/activities/Book given to students/b2.png',
                'gallery_images' => "images/activities/Book given to students/b2.png\nimages/activities/Book given to students/b3.jpeg\nimages/activities/Book given to students/b4.jpeg",
                'objectives' => "Encourage reading habits among children\nPromote access to books and learning resources",
                'highlights' => "Distribution of textbooks and storybooks\nStorytelling session with educators",
                'quote' => "A room without books is like a body without a soul.",
                'status' => 'active',
            ],
            [
                'title' => 'Science Competition for Government School Students',
                'short_title' => 'science-competition',
                'category' => 'Education',
                'description' => 'Fostering scientific temperament and innovation among young school students through annual science competitions.',
                'full_description' => "Tamil Nadu Science Forum organized a Science Competition for Government School students in Nagapattinam District, supported by Lumina Trust.",
                'date' => '2026-06-20',
                'time' => '9:30 AM – 4:00 PM',
                'location' => 'Nagapattinam',
                'participants' => '300+ School Students',
                'progress_percent' => 80,
                'raised_amount' => 400000,
                'goal_amount' => 500000,
                'main_image' => 'images/activities/Science Competition – Nagapattinam/s1.png',
                'gallery_images' => "images/activities/Science Competition – Nagapattinam/s1.png\nimages/activities/Science Competition – Nagapattinam/g3.jpeg\nimages/activities/Science Competition – Nagapattinam/g4.jpeg",
                'quote' => "Science is not just a subject; it is a way of thinking.",
                'status' => 'active',
            ],
            [
                'title' => 'Honouring Our Healthcare Heroes – National Doctors’ Day 2026',
                'short_title' => 'doctors-day',
                'category' => 'Health',
                'description' => 'Providing basic health check-ups and medical support to underprivileged communities.',
                'full_description' => "On the occasion of National Doctors’ Day, Lumina Trust expressed its heartfelt appreciation to the medical community by honouring dedicated doctors.",
                'date' => '2026-07-01',
                'time' => '9:00 AM – 12:30 PM',
                'location' => 'Nagapattinam',
                'participants' => 'Healthcare Fraternity & Community',
                'progress_percent' => 85,
                'raised_amount' => 425000,
                'goal_amount' => 500000,
                'main_image' => 'images/activities/DOCTERS ADY/d1.png',
                'gallery_images' => "images/activities/DOCTERS ADY/d1.png\nimages/activities/DOCTERS ADY/d2.jpeg\nimages/activities/DOCTERS ADY/d3.jpeg",
                'quote' => "Honouring those who dedicate their lives to caring for others.",
                'status' => 'active',
            ],
            [
                'title' => 'Nagore Beach Clean Drive – A Step Towards a Cleaner Coast',
                'short_title' => 'beach-cleanup',
                'category' => 'Water',
                'description' => 'Installing and maintaining clean water facilities to ensure safe drinking water for rural areas.',
                'full_description' => "Lumina Trust actively participated in the Nagore Beach Clean Drive organized to promote environmental responsibility and keep coastal surroundings clean.",
                'date' => '2026-07-05',
                'time' => '4:00 PM – 6:30 PM',
                'location' => 'Nagapattinam',
                'participants' => '100+ Volunteers',
                'progress_percent' => 60,
                'raised_amount' => 600000,
                'goal_amount' => 1000000,
                'main_image' => 'images/activities/nagore beach clean/n1.jpeg',
                'gallery_images' => "images/activities/nagore beach clean/n1.jpeg\nimages/activities/nagore beach clean/n2.jpeg\nimages/activities/nagore beach clean/n3.jpeg",
                'quote' => "ஒரு கரம் நீட்டினால், கடல் கை கொடுக்கும்.",
                'status' => 'active',
            ],
            [
                'title' => 'World Environment Day – Environmental Awareness Programme',
                'short_title' => 'world-environment-day',
                'category' => 'Environment',
                'description' => 'Greener today, healthier tomorrow. Join us in planting trees for a cleaner and safer planet.',
                'full_description' => "On World Environment Day, Lumina Trust joined hands with Hope Foundation to promote environmental awareness and tree planting drives.",
                'date' => '2026-06-05',
                'time' => '9:00 AM – 1:00 PM',
                'location' => 'Nagapattinam',
                'participants' => 'Community Members & Youth',
                'progress_percent' => 90,
                'raised_amount' => 450000,
                'goal_amount' => 500000,
                'main_image' => 'images/activities/tree plantaion/t1.png',
                'gallery_images' => "images/activities/tree plantaion/t1.png\nimages/activities/tree plantaion/g2.jpeg",
                'quote' => "Our Earth, Our Responsibility, Our Future.",
                'status' => 'active',
            ],
            [
                'title' => 'Promoting a Plastic-Free Future – Plastic Bag Free Day',
                'short_title' => 'plastic-free-day',
                'category' => 'Environment',
                'description' => 'Distributing eco-friendly cloth bags and conducting door-to-door awareness campaigns to reduce single-use plastic.',
                'full_description' => "Lumina Trust organized a Plastic Bag Free Day activity to encourage reusable cloth bags and reduce single-use plastic.",
                'date' => '2026-07-03',
                'time' => '10:00 AM – 2:00 PM',
                'location' => 'Nagapattinam',
                'participants' => 'Community Members & Shops',
                'progress_percent' => 55,
                'raised_amount' => 275000,
                'goal_amount' => 500000,
                'main_image' => 'images/activities/Plastic bag free day/p1.jpeg',
                'gallery_images' => "images/activities/Plastic bag free day/p1.jpeg\nimages/activities/Plastic bag free day/p2.jpeg",
                'quote' => "Say No to Single-Use Plastic. Choose Reusable Bags.",
                'status' => 'active',
            ],
            [
                'title' => 'Celebrating the Legacy of Savitribai Phule – Pioneer of Women’s Education',
                'short_title' => 'savitribai-phule',
                'category' => 'Completed',
                'description' => 'Celebrating Savitribai Phule Jayanti and providing leadership, educational, and vocational guidance for women.',
                'full_description' => "Lumina Trust proudly organized a special programme to commemorate the birth anniversary of Savitribai Phule.",
                'date' => '2026-01-03',
                'time' => '10:00 AM – 1:30 PM',
                'location' => 'Nagapattinam',
                'participants' => '200+ Students & Teachers',
                'progress_percent' => 100,
                'raised_amount' => 0,
                'goal_amount' => 0,
                'main_image' => 'images/activities/savithri bhai pule/sb1.jpeg',
                'gallery_images' => "images/activities/savithri bhai pule/sb1.jpeg\nimages/activities/savithri bhai pule/sb2.jpeg",
                'quote' => "Education is the key to liberation and dignity.",
                'status' => 'completed',
            ],
            [
                'title' => 'Sparrow Protection Initiative – Conserving Local Birdlife',
                'short_title' => 'sparrow-initiative',
                'category' => 'Completed',
                'description' => 'A highly successful community drive distributing bird feeders and nest boxes to conserve local house sparrows.',
                'full_description' => "Lumina Trust organized a dedicated Sparrow Protection Initiative in Nagapattinam to raise awareness about house sparrows.",
                'date' => '2024-12-20',
                'time' => '9:00 AM – 1:00 PM',
                'location' => 'Nagapattinam',
                'participants' => '150+ Volunteers & Students',
                'progress_percent' => 100,
                'raised_amount' => 0,
                'goal_amount' => 0,
                'main_image' => 'images/activities/sparrow-event-1.jpeg',
                'gallery_images' => "images/activities/sparrow-event-1.jpeg\nimages/activities/sparrow-event-2.jpeg\nimages/activities/sparrow-event-3.jpeg",
                'quote' => "Small acts of kindness towards nature build a healthier planet.",
                'status' => 'completed',
            ],
        ];

        foreach ($defaultActivities as $act) {
            \App\Models\Activity::create($act);
        }
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


