<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeVideo extends Model
{
    use HasFactory;

    protected $table = 'home_video'; // Table name

    protected $fillable = [
        'video_file', 
        'video_link',
    ];

    public $timestamps = true; // Enables created_at & updated_at
}
