<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $fillable = [
        // Hero Section
        'hero_badge_text',
        'hero_title_line1',
        'hero_title_line2',
        'hero_description',
        'hero_button_donate_text',
        'hero_button_volunteer_text',
        'hero_card_title',
        'hero_card_subtitle',
        'hero_stat_completed',
        'hero_trust_badge_1',
        'hero_trust_badge_2',

        // Impact Counters (Numbers That Speak)
        'impact_subtitle',
        'impact_title',
        'counter_people_helped',
        'counter_people_helped_suffix',
        'counter_people_helped_label',
        'counter_volunteers',
        'counter_volunteers_suffix',
        'counter_volunteers_label',
        'counter_projects_done',
        'counter_projects_done_suffix',
        'counter_projects_done_label',
        'counter_communities',
        'counter_communities_suffix',
        'counter_communities_label',

        // About & Purpose Preview Section
        'about_subtitle',
        'about_title',
        'about_description',
        'about_feature_1_title',
        'about_feature_1_desc',
        'about_feature_2_title',
        'about_feature_2_desc',

        // Newsletter Section
        'newsletter_subtitle',
        'newsletter_title',
        'newsletter_description',
    ];

    protected $casts = [
        'counter_people_helped' => 'integer',
        'counter_volunteers' => 'integer',
        'counter_projects_done' => 'integer',
        'counter_communities' => 'integer',
    ];

    /**
     * Default values helper
     */
    public static function defaultData(): array
    {
        return [
            'hero_badge_text' => 'Empowering Communities Across Tamil Nadu',
            'hero_title_line1' => 'Transforming Lives',
            'hero_title_line2' => 'Through Compassion',
            'hero_description' => 'Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable education, healthcare, and livelihood initiatives.',
            'hero_button_donate_text' => 'Donate Today',
            'hero_button_volunteer_text' => 'Volunteer with Us',
            'hero_card_title' => 'Lumina Trust Grassroots Drive',
            'hero_card_subtitle' => 'Nagapattinam & Surrounding Districts',
            'hero_stat_completed' => '150+ Projects',
            'hero_trust_badge_1' => '100% Transparent NGO',
            'hero_trust_badge_2' => 'Grassroots Impact',

            'impact_subtitle' => 'OUR IMPACT',
            'impact_title' => 'Numbers That Speak',
            'counter_people_helped' => 1000,
            'counter_people_helped_suffix' => '+',
            'counter_people_helped_label' => 'PEOPLE HELPED',
            'counter_volunteers' => 50,
            'counter_volunteers_suffix' => '+',
            'counter_volunteers_label' => 'ACTIVE VOLUNTEERS',
            'counter_projects_done' => 10,
            'counter_projects_done_suffix' => '+',
            'counter_projects_done_label' => 'PROJECTS DONE',
            'counter_communities' => 10,
            'counter_communities_suffix' => '+',
            'counter_communities_label' => 'COMMUNITIES',

            'about_subtitle' => 'About Lumina Trust',
            'about_title' => 'Uplifting Underserved Communities with Dignity',
            'about_description' => 'Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work at the grassroots level to enable individuals and communities to achieve dignity, independence, and long-term growth.',
            'about_feature_1_title' => 'Grassroots Reach',
            'about_feature_1_desc' => 'Direct village & town level impact.',
            'about_feature_2_title' => 'Full Transparency',
            'about_feature_2_desc' => '100% non-profit accountability.',

            'newsletter_subtitle' => 'Stay Connected',
            'newsletter_title' => 'Join Hands for a Brighter Future',
            'newsletter_description' => 'Subscribe to our newsletter to receive updates on our grassroots programs, health drives, and volunteer opportunities.',
        ];
    }
}
