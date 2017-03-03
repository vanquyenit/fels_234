<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{

    protected $fillable = [
        'following',
        'follower',
    ];

    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function checkFollow($id)
    {
        return Relationship::where('follower_id', $id)->where('following_id', Auth()->id())->select('id')->first();
    }
}
