<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function courses ()
    {
        return $this->hasMany(Course::class);
    }

    public function getCourse($id)
    {
        return Category::with('courses')->find($id);
    }
}
