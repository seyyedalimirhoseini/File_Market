<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class Course extends Model
{
    use Sluggable,Rateable,SoftDeletes;

    protected  $fillable=['name','code','description','price','image','user_id'];
    protected $dates = ['deleted_at'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function categories()

    {
        return $this->belongsToMany(Category::class);
    }
    public function eposides()
    {
        return $this->hasMany(Eposide::class)->withTrashed();

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function details()
    {
        return '/details/'.$this->slug;
    }

}
