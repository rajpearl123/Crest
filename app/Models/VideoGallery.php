<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $table = 'video_gallery';

    protected $fillable = [
        'video_url',
        'active',
        'created_at',
        'title'
    ];

    // Cast created_at to a Carbon instance
    protected $casts = [
        'created_at' => 'datetime',
        'active' => 'boolean', // Optional: Cast active as boolean for consistency
    ];

    public $timestamps = false; // Keep this since created_at is managed manually or by DB
}