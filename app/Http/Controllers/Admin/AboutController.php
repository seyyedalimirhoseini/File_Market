<?php

namespace App\Http\Controllers\Admin;

use App\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AboutController extends Controller
{
        public function index()
        {
            $this->authorize('isAdmin');
            $abouts=About::latest()->paginate('1');
            return view('Admin.about.index',compact('abouts'));
        }
        public function create()
        {
            $this->authorize('isAdmin');
            return view('Admin.about.create');
        }
        public function store(Request $request)
        {
            $this->authorize('isAdmin');
            $this->validate($request, [

                'description'=>'required',

                'image'=>'required|mimes:jpeg,jpg,png',
            ], [

                'description.required'=>'وارد کردن توضیحات  الزامی می باشد.',

                'image.required'=>'وارد کردن تصویر الزامی می باشد.',
                'image.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',

            ]);

               $image= $request->file('image');
                    $uploadImage=$this->uploadImage($image);
                    $about=About::create(array_merge($request->all(),['image'=>$uploadImage]));

            Session::flash('success', 'عملیات با موفقیت انجام شد.');
            return redirect('admin/about');
        }
        public function edit(About $about)
        {
            $this->authorize('isAdmin');
            return view('Admin.about.edit',compact('about'));
        }
        public function update(Request $request ,About $about)
        {
            $this->authorize('isAdmin');
            $this->validate($request, [

                'description'=>'required',

                'image'=>'required|mimes:jpeg,jpg,png',
            ], [

                'description.required'=>'وارد کردن توضیحات  الزامی می باشد.',

                'image.required'=>'وارد کردن تصویر الزامی می باشد.',
                'image.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',

            ]);

            if($request->hasFile('image'))
            {
                $image=$request->file('image');
                $uploadImage= $this->uploadImage($image);

            }else{
                $uploadImage=$request->image;
            }

            $about->update(array_merge($request->all(),['image'=>$uploadImage]));

            Session::flash('success', 'عملیات با موفقیت بروزرسانی شد.');
            return redirect('admin/about');
        }
        public function delete(About $about)
        {
            $this->authorize('isAdmin');
            try{
                $image=public_path().'/aboutimages/'.$about->image;
                if($about->delete())
                {
                    unlink($image);
                }

                Session::flash('success', 'حذف شد.');
                return redirect('admin/about');

            }catch (\Exception $e)
            {
                Session::flash('success', 'حذف نشد.');
                return redirect('admin/about');
            }
        }


    private function uploadImage($image)
    {
        $filename= time().'.'.$image->getClientOriginalName();
        $image->move(public_path('aboutimages/'),$filename);
        return $filename;
    }

}
