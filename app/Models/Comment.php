<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments'; // Explicitly defining the table name

    protected $fillable = ['name', 'email', 'comment', 'approve', 'blog_id'];

    protected $casts = [
        'approve' => 'boolean',
    ];
}
