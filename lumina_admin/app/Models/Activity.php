<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_title',
        'category',
        'description',
        'full_description',
        'date',
        'time',
        'location',
        'participants',
        'progress_percent',
        'raised_amount',
        'goal_amount',
        'main_image',
        'gallery_images',
        'objectives',
        'highlights',
        'quote',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'progress_percent' => 'integer',
        'raised_amount' => 'decimal:2',
        'goal_amount' => 'decimal:2',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->main_image) {
            if (str_starts_with($this->main_image, 'http')) {
                return $this->main_image;
            }
            if (str_starts_with($this->main_image, 'images/')) {
                return asset($this->main_image);
            }
            if (str_starts_with($this->main_image, 'storage/')) {
                return asset($this->main_image);
            }
            return asset('storage/' . $this->main_image);
        }
        return 'https://images.unsplash.com/photo-1579208575657-c595a05383b7?w=300&auto=format&fit=crop&q=80';
    }

    public function getFormattedGalleryAttribute()
    {
        $raw = $this->gallery_images;
        if (empty($raw)) {
            return [$this->image_url];
        }

        $list = is_array($raw) ? $raw : array_filter(array_map('trim', preg_split('/[\r\n,]+/', $raw)));
        if (empty($list)) {
            return [$this->image_url];
        }

        return array_values(array_map(function ($img) {
            if (str_starts_with($img, 'http')) {
                return $img;
            }
            if (str_starts_with($img, 'images/')) {
                return asset($img);
            }
            if (str_starts_with($img, 'storage/')) {
                return asset($img);
            }
            return asset('storage/' . $img);
        }, $list));
    }

    public function getGalleryItemUrl($img): string
    {
        if (str_starts_with($img, 'http')) {
            return $img;
        }
        if (str_starts_with($img, 'images/')) {
            return asset($img);
        }
        if (str_starts_with($img, 'storage/')) {
            return asset($img);
        }
        return asset('storage/' . $img);
    }

    public static function getDefaultActivities(): array
    {
        return [
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
    }

    public static function seedDefaults(): void
    {
        foreach (self::getDefaultActivities() as $act) {
            self::updateOrCreate(['short_title' => $act['short_title']], $act);
        }
    }
}
