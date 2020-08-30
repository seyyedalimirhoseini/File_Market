<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public  function index()
    {
        $this->authorize('isAdmin');
        $coupons=Coupon::orderBy('id','ASC')->paginate(10);

        return view('Admin.coupon.index',compact('coupons'));
    }
    public function create()
    {
        $this->authorize('isAdmin');
        return view('Admin.coupon.create');
    }
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'name' => 'required|unique:coupons,name',
            'percent'=>'required|between:1,99',
            'expiry_date'=>'required|date_format:Y/m/d'
        ], [
            'name.required' => 'وارد کردن نام دسته بندی الزامی می باشد.',
            'name.unique'=>'نام باید منحصر به فرد باشد.',
            'percent.required'=>'وارد کردن درصد تخفیف الزامی می باشد.',
            'percent.between'=>'درصد باید بین 1 تا 99 باشد.',
            'expiry_date.required'=>'وارد کردن تاریخ انقضا الزامی می باشد.',
            'expiry_date.date_format'=>'فرمت تاریخ صحیح نمی باشد.',
//            'expiry_date.date'=>'باید فرمت تاریخ باشد',

        ]);
        if(empty($request['status'])){
            $request['status']=0;
        }
        Coupon::create($request->all());

        Session::flash('success','تخفیف با موفقیت ذخیره شد.');
        return redirect('admin/coupons');
    }
    public function edit(Coupon $coupon)
    {
        $this->authorize('isAdmin');
        return view('Admin.coupon.edit',compact('coupon'));
    }
    public function  update(Request $request,Coupon $coupon)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'name' => 'required|unique:coupons,name,'.$coupon->id,
            'percent'=>'required|between:1,99',
            'expiry_date'=>'required|date_format:Y/m/d'
        ], [
            'name.required' => 'وارد کردن نام دسته بندی الزامی می باشد.',
            'name.unique'=>'نام باید منحصر به فرد باشد.',
            'percent.required'=>'وارد کردن درصد تخفیف الزامی می باشد.',
            'percent.between'=>'درصد باید بین 1 تا 99 باشد.',
            'expiry_date.required'=>'وارد کردن تاریخ انقضا الزامی می باشد.',
            'expiry_date.date_format'=>'فرمت تاریخ صحیح نمی باشد.',
//            'expiry_date.date'=>'باید فرمت تاریخ باشد',

        ]);

        if(empty($request['status'])){
            $request['status']=0;
        }
        $coupon->update($request->all());

        Session::flash('success','تخفیف با موفقیت بروزرسانی شد.');
        return redirect('admin/coupons');
    }
    public function delete(Coupon $coupon)
    {
        $this->authorize('isAdmin');
        try{
            $coupon->delete();
            Session::flash('success','تخفیف با موفقیت حذف شد.');
            return redirect('admin/coupons');
        }catch (\Exception $e)
        {
            Session::flash('error','تخفیف حذف نشد.');
            return redirect('admin/coupons');
        }
    }
}
