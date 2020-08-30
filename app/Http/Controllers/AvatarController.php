<?php

namespace App\Http\Controllers;


use App\Avatar;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class AvatarController extends Controller
{
    public function show()
    {
       $user_id =Auth::user()->id;
        $complete=Avatar::where('user_id','=',$user_id)->first();


        return view('Avatar.show',compact('complete'));
    }
    public function create()
    {
        return view('Avatar.complete');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nationalcode' => 'required',
            'description'=>'required|max:500',

            'image_pro'=>'required|mimes:png,jpg,jpeg',
        ], [
            'nationalcode.required' => 'وارد کردن کد ملی الزامی می باشد.',
            'description.required'=>'قسمت توضیحات الزامی می باشد.',
            'description.max'=>'متن باید حداکثر 500 کاراکتر باشد.',
            'image_pro.required'=>'وارد کردن تصویر الزامی می باشد.',
            'image_pro.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',

        ]);
        $data=[
            'user_id'=>auth()->user()->id,
            'nationalcode'=>$request['nationalcode'],

            'description'=>$request['description']
        ];
        $image_pro= $request->file('image_pro');
        $uploadImage=$this->uploadImage($image_pro);
        $avatar=Avatar::create(array_merge($data,['image_pro'=>$uploadImage]));

        Session::flash('success', 'اطلاعات شما با موفقیت ذخیره شد.');
        return redirect('/avatar');
    }

        public function edit()
        {

            $user_id =Auth::user()->id;
            $complete=Avatar::where('user_id','=',$user_id)->first();
            return view('Avatar.edit',compact('complete'));
        }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:users,email,'. auth()->user()->id . ',id',
            'phone'=>'required|numeric|digits:11',

            'password' => 'required|min:8',
            'password_confirmation' => 'required:password|same:password|min:6',

        ], [
            'name.requierd'=>'وارد کردن نام الزامی می باشد.',
            'email.required'=>'وارد کردن ایمیل الزامی می باشد.',
            'email.unique'=>'این ایمیل قبلا رزرو شده است.',
            'phone.required'=>'وارد کردن شماره تلفن همراه الزامی می باشد.',
            'phone.numeric'=>'شماره تلفن همراه باید عدد باشد.',
            'phone.digits'=>'شماره تلفن همراه  باید 11 رقم باشد',

            'password.required'=>'وارد کردن رمز عبور الزامی می باشد.',
            'password.min'=>'کلمه عبور حداقل 8 کاراکتر نیاز  دارد.',
            'password_confirmation.required'=>'وارد کردن تکرار رمز عبور الزامی می باشد.',
            'password_confirmation.min'=>'تکرار کلمه عبور حداقل 8 کاراکتر نیاز دارد.',
            'password_confirmation.same'=>'تکرار رمز عبور نادرست می باشد.',

        ]);
        $user_id =Auth::user()->id;
        $user=User::find($user_id);
//        dd($user_id);
        $user->update([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'password'=>Hash::make($request->password)

        ]);
            if($request->has(['nationalcode']) && $request->has(['description'] )){

                $this->validate($request, [
                    'nationalcode' => 'required',
                    'description'=>'required|max:500',

                    'image_pro'=>'required|mimes:png,jpg,jpeg',


                ],[
                    'nationalcode.required' => 'وارد کردن کد ملی الزامی می باشد.',
                    'description.required'=>'قسمت توضیحات الزامی می باشد.',
                    'description.max'=>'متن باید حداکثر 500 کاراکتر باشد.',
                    'image_pro.required'=>'وارد کردن تصویر الزامی می باشد.',
                    'image_pro.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',
                ]);
                $complete=Avatar::where('user_id','=',$user_id)->first();
                $data=[
                    'nationalcode'=>$request['nationalcode'],
                    'description'=>$request['description'],
                    'user_id'=>auth()->user()->id
                ];
                if($request->hasFile('image_pro'))
                {
                    $image_pro=$request->file('image_pro');
                    $uploadImage= $this->uploadImage($image_pro);

                }else{
                    $uploadImage=$request->image_pro;
                }

                $complete->update(array_merge($data,['image_pro'=>$uploadImage]));
            }

        Session::flash('success', 'پروفایل با موفقیت بروزرسانی شد.');
        return redirect('avatar');
    }

    private function uploadImage($image_pro)
    {
        $filename= time().'.'.$image_pro->getClientOriginalName();
        $image_pro->move(public_path('avatars/'),$filename);
        return $filename;
    }
}
