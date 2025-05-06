<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_url', 'slug', 'author'];

    protected $casts = [
        'image_url' => 'array',
    ];

    public static function getEnumValues($column = 'slug')
    {
        $type = DB::select("SHOW COLUMNS FROM albums WHERE Field = ?", [$column])[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = explode(',', str_replace("'", '', $matches[1]));
        return $values;
    }
}
