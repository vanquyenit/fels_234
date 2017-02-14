<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public $timestamps = true;

    public function lesson () 
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function word () 
    {
        return $this->hasMany('App\Models\Word');
    }
}
