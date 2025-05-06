<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'email',
        'wedding_date',
        'wedding_venue',
        'package_id',
        'type'
    ];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
