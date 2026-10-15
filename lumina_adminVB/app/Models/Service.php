<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_title',
        'category',
        'icon',
        'description',
        'full_description',
        'service_charge',
        'availability',
        'location',
        'contact_person',
        'contact_phone',
        'main_image',
        'gallery_images',
        'features',
        'status',
    ];

    protected $casts = [
        'service_charge' => 'decimal:2',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->main_image) {
            if (str_starts_with($this->main_image, 'http')) {
                return $this->main_image;
            }
            return asset('storage/' . $this->main_image);
        }
        return 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=300&auto=format&fit=crop&q=80';
    }
}
