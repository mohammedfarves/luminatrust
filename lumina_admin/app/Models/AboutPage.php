<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'story',
        'hero_button_text',
        'hero_button_link',
        'secondary_button_text',
        'secondary_button_link',
        'who_we_are_title',
        'who_we_are_description',
        'image_badge_text',
        'mission',
        'vision',
        'vision_title',
        'vision_points',
        'mission_title',
        'mission_points',
        'impact_subtitle',
        'impact_title',
        'impact_description',
        'impact_items',
        'process_subtitle',
        'process_title',
        'process_description',
        'process_steps',
        'team_subtitle',
        'team_title',
        'team_description',
        'team_members',
        'established_year',
        'founder_name',
        'founder_title',
        'founder_message',
        'beneficiaries_count',
        'projects_count',
        'volunteers_count',
        'cities_count',
        'core_values',
        'main_image',
        'founder_image',
    ];

    protected $casts = [
        'core_values' => 'array',
        'vision_points' => 'array',
        'mission_points' => 'array',
        'impact_items' => 'array',
        'process_steps' => 'array',
        'team_members' => 'array',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->main_image) {
            if (str_starts_with($this->main_image, 'http')) {
                return $this->main_image;
            }
            return asset('storage/' . $this->main_image);
        }
        return 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?w=800&auto=format&fit=crop&q=80';
    }

    public function getFounderImageUrlAttribute()
    {
        if ($this->founder_image) {
            if (str_starts_with($this->founder_image, 'http')) {
                return $this->founder_image;
            }
            return asset('storage/' . $this->founder_image);
        }
        return 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80';
    }
}
