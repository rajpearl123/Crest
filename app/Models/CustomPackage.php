<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPackage extends Model
{
    use HasFactory;

    protected $table = 'custom_packages';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'package',
        'event',
        'event_datetime',
        'venue',
        'requirement',
        'photography',
        'videography',
        'extras',
        'budget',
    ];

    protected $casts = [
        'event' => 'array',
        'photography' => 'array',
        'videography' => 'array',
        'extras' => 'array',
        'event_datetime' => 'datetime',
    ];
}