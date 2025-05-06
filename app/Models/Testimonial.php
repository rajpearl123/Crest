<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Define table name explicitly
    protected $table = 'testimonials';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'rating',
        'review',
        'name',
        'image',
        'country'
    ];
}
