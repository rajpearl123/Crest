<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $table = 'steps';

    protected $fillable = [
        'title',
        'image',
        'step_count',
        'description',
    ];
}
