<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAlbum extends Model
{
    use HasFactory;

    protected $table = 'home_album';

    protected $fillable = [
        'title',
        'description',
        'album',
    ];

    protected $casts = [
        'album' => 'array', // Automatically convert JSON to array
    ];
}
