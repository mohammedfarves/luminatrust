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
            return asset('storage/' . $img);
        }, $list));
    }
}
