<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use SoftDeletes;
    protected  $fillable=['name','price','user_id','course_id','authority','qty'];
    protected $dates = ['deleted_at'];

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
