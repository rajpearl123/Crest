<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;

    protected $table = 'blog_categories'; // explicitly set table name

    protected $fillable = ['name'];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }
}
