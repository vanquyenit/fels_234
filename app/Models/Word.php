<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'content', 
        'category_id', 
    ];

    public $timestamps = true;

    public function lessonwords () 
    {
        return $this->hasMany(LessonWord::class);
    }

    public function category () 
    {
        return $this->belongTo(Category::class);
    }

    public function wordanswers () 
    {
        return $this->hasMany(WordAnswer::class);
    }

    public function learneds () 
    {
        return $this->hasMany(Learned::class);
    }
}
