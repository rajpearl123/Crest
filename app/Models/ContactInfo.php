<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;
    
    protected $fillable = ['website_url', 'phone', 'address1', 'address2', 'map1', 'map2', 'email'];
}
