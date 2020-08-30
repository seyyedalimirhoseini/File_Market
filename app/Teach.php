<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
    protected  $fillable=['degree','resume','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
