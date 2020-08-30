<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','parent_id','status'];
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }


}
