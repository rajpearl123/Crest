<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'ip_address', 'device', 'logged_at'];

    public $timestamps = false;
    protected $casts = [
        'logged_at' => 'datetime',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
