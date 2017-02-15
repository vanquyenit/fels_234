<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name', 
        'image', 
        'user_id', 
        'category_id', 
        'result', 
    ];

    public $timestamps = true;
    
    public function user () 
    {
        return $this->belongTo(User::class);
    }

    public function lessonwords () 
    {
        return $this->hasMany(LessonWord::class);
    }

    public function category () 
    {
        return $this->belongTo(Category::class);
    }
}
