<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required:password|same:password|min:8',
            'phone'=>'required|numeric|digits:11',
        ],[
            'name.required' =>'وارد کردن نام الزامی است.',
            'email.required'=>'وارد کردن ایمیل الزامی می باشد.',
            'email.email'=>'تایپ باید از نوع ایمیل باشد.',
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone'=>$data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
