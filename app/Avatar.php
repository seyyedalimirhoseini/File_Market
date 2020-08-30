<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'image_pro','description','user_id','nationalcode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
