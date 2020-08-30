<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\SoftDeletes;
class Eposide extends Model
{
    use SoftDeletes;
    protected $fillable=['name','time','course_id','file','url','user_id','type','status'];
    protected $dates = ['deleted_at'];
    public function course()
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }

    public  function download()
    {

       $timestamp = Carbon::now()->addHours(5)->timestamp;
        $hash = Hash::make('fds@#T@#56@sdgs131fasfq' . $this->id. request()->ip() . $timestamp);

        return  "/download/ $this->id?mac=$hash&t=$timestamp" ;


    }
}
