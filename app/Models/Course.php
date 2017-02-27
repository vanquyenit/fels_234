<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Course extends Model
{
    protected $fillable = [
        'name',
        'image',
        'describe',
        'category_id',
    ];

    public $timestamps = true;

    public function learneds()
    {
        return $this->hasMany(Learned::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getList()
    {
        return Course::with([
            'category' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->get();
    }

    public function checkCourse($input)
    {
        return Course::where('id', $input)->count();
    }

    public function getCat()
    {
        return Course::with('category')->paginate(4);
    }
}
