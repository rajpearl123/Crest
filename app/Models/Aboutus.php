<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    use HasFactory;
    protected $table = 'about_us';
    protected $fillable = ['subtitle', 'title', 'description', 'progress_bars','op_desc','operation_data'];

    protected $casts = [
        'progress_bars' => 'array', 
        'operation_data' => 'array', 

    ];
}
