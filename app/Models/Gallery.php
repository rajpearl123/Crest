<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries'; 

    protected $fillable = [
        'title',
        'author',
        'image',
        'link',
        'gallery_category_id', // Add this to allow mass assignment
    ];

    /**
     * Relationship: A gallery belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }
}
