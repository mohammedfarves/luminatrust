<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // Contact Information
        'email',
        'phone',
        'secondary_phone',
        'whatsapp_number',
        'address',
        'map_link',
        'working_hours',

        // Social Media Links
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',

        // Trust / Organization Details
        'site_title',
        'site_tagline',
        'registration_number',
        'tax_exemption_info',
        'footer_about',
    ];

    /**
     * Default fallback configuration data.
     */
    public static function defaultData(): array
    {
        return [
            'email' => 'support@luminatrust.org',
            'phone' => '+91 98947 77349',
            'secondary_phone' => '+91 94891 16189',
            'whatsapp_number' => '+91 98947 77349',
            'address' => 'Lumina Trust, Nagapattinam, Tamil Nadu, India',
            'map_link' => 'https://www.google.com/maps?q=Nagapattinam,Tamil%20Nadu&output=embed',
            'working_hours' => 'Mon – Sat: 9:00 AM – 6:00 PM',

            'facebook_url' => 'https://facebook.com',
            'twitter_url' => 'https://twitter.com',
            'instagram_url' => 'https://instagram.com',
            'youtube_url' => 'https://youtube.com',
            'linkedin_url' => 'https://linkedin.com',

            'site_title' => 'Lumina Trust',
            'site_tagline' => 'Empowering Communities, Transforming Lives',
            'registration_number' => 'Trust Reg. No: 123/2018',
            'tax_exemption_info' => 'Donations are 100% tax exempt under Section 80G of IT Act',
            'footer_about' => 'Lumina Trust is a registered non-profit organization dedicated to grassroots social welfare, education, environment, and healthcare initiatives across Tamil Nadu.',
        ];
    }
}
