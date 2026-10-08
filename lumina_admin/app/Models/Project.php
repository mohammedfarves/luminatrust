<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'status',
        'target_amount',
        'raised_amount',
        'description',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
