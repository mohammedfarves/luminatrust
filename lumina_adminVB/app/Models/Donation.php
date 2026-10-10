<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_email',
        'amount',
        'project_id',
        'payment_method',
        'payment_status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
