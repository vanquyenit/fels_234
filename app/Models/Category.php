<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 
    ];

    public $timestamps = true;

    public function lessons () 
    {
        return $this->hasMany(Lesson::class);
    }

    public function words () 
    {
        return $this->hasMany(Word::class);
    }
}
