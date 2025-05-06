<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallery_categories';

    protected $fillable = ['name'];

    /**
     * Relationship: A category has many galleries.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'gallery_category_id');
    }
}
