<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin');
        $sliders=Slider::latest()->paginate('10');
        return view('Admin.slider.index',compact('sliders'));
    }
    public function create()
    {
        $this->authorize('isAdmin');
        return view('Admin.slider.create');
    }
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [

            'name'=>'required',

            'image'=>'required|mimes:jpeg,jpg,png',
        ], [

            'name.required'=>'وارد کردن نام اسلایدر الزامی می باشد.',

            'image.required'=>'وارد کردن تصویر اسلایدر الزامی می باشد.',
            'image.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',

        ]);

           $image= $request->file('image');
                $uploadImage=$this->uploadImage($image);
                $slider=Slider::create(array_merge($request->all(),['image'=>$uploadImage]));

        Session::flash('success', 'اسلایدر با موفقیت اضافه شد.');
        return redirect('admin/sliders');
    }
    public function edit(Slider $slider)
    {
        $this->authorize('isAdmin');
        return view('Admin.slider.edit',compact('slider'));
    }
    public function update(Request $request ,Slider $slider)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [

            'name'=>'required',

            'image'=>'required|mimes:jpeg,jpg,png',
        ], [

            'name.required'=>'وارد کردن نام اسلایدر الزامی می باشد.',

            'image.required'=>'وارد کردن تصویر اسلایدر الزامی می باشد.',
            'image.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',

        ]);

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $uploadImage= $this->uploadImage($image);

        }else{
            $uploadImage=$request->image;
        }

        $slider->update(array_merge($request->all(),['image'=>$uploadImage]));

        Session::flash('success', 'اسلایدر با موفقیت بروزرسانی شد.');
        return redirect('admin/sliders');
    }
    public function delete(Slider $slider)
    {
        $this->authorize('isAdmin');
        try{
            $image=public_path().'/sliderimages/'.$slider->image;
            if($slider->delete())
            {
                unlink($image);
            }

            Session::flash('success', 'اسلایدر حذف شد.');
            return redirect('admin/sliders');

        }catch (\Exception $e)
        {
            Session::flash('success', 'اسلایدر حذف نشد.');
            return redirect('admin/sliders');
        }
    }


private function uploadImage($image)
{
    $filename= time().'.'.$image->getClientOriginalName();
    $image->move(public_path('sliderimages/'),$filename);
    return $filename;
}
}
