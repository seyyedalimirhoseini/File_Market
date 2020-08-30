<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Eposide;
use App\Http\Controllers\Controller;
use App\Order;
use App\SubCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public  function  index()
    {
        $user=auth()->user();
        if($user->isAdmin())
        {
            $courses=Course::latest()->paginate(10);
        }
        else{
            $courses= Course::where('user_id',Auth::user()->id)->latest()->paginate(10);
        }


        return view('Admin.course.index',compact('courses'));
    }
    public function create()
    {
        $categories=Category::all()->pluck('name','id');
        $courses=Course::all()->pluck('name','id');
        return view('Admin.course.create',compact('categories','courses'));
    }
    public function  store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code'=>'required|numeric|digits:4|unique:courses,code',
            'description'=>'required',
            'price'=>'required|numeric',
            'categories'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'وارد کردن نام دوره الزامی  می باشد.',
            'code.required'=>'وارد کردن کد دوره الزامی می باشد.',
            'code.numeric'=>'کد شناسایی باید عدد باشد',
            'code.digits'=>'کد شناسایی باید 4 رقم باشد.',
            'code.unique'=>'کد دوره باید منحصر به فرد باشد.',
            'description.required'=>'وارد کردن توضیحات دوره الزامی می باشد.',
            'price.required'=>'وارد کردن قیمت الزامی می باشد.',
            'price.numeric'=>'قیمت باید عدد باشد.',
            'image.required'=>'وارد کردن تصویر الزامی می باشد.',
            'image.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',
            'categories.required'=>'انتخاب دسته بندی الزامی می باشد.',
        ]);
                $data=[
                        'name'=>$request['name'],
                        'code'=>$request['code'],
                        'description'=>$request['description'],
                        'price'=>$request['price'],
                        'user_id'=>auth()->user()->id,

                ];

           $image= $request->file('image');
                $uploadImage=$this->uploadImage($image);
                $course=Course::create(array_merge($data,['image'=>$uploadImage]));
                if(isset($request->courses))
                {
                    for($i=0 ; $i<=count($request->courses) ;$i++)
                    {
                        if(empty($request['courses'][$i]) || !is_numeric($request['courses'][$i])) continue;
                       $data =[
                           'course_id'=>$course->id,
                           'subCourse_id'=>intval($request['courses'][$i]),
                       ];
                    //    dd($data);
                    SubCourse::create($data);
                    }
                }

               $course->categories()->attach($request->categories);
        Session::flash('success', 'دوره با موفقیت اضافه شد.');
        return redirect('admin/courses');
    }


     public function edit(Course $course)
        {

            if( auth()->user()->id==$course->user_id){
            $sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

            $array = array();
            foreach ( $sub_courses as $key => $value) {
                $array[$key] = $value->subCourse_id;
            }

            $categories=Category::all();
            $courses=Course::all();
            return view('Admin.course.edit',compact('course','courses','categories','array'));
        }
        else{
            return abort(403);
        }
        }

    public function update(Request $request ,Course $course)
    {
        if( auth()->user()->id==$course->user_id){
        $this->validate($request, [
            'name' => 'required',
            'code'=>'required|numeric|digits:4|unique:courses,code,'.$course->id,
            'description'=>'required',
            'price'=>'required|numeric',
            'categories'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',
        ], [
            'name.required' => 'وارد کردن نام دوره الزامی  می باشد.',
            'code.required'=>'وارد کردن کد دوره الزامی می باشد.',
            'code.numeric'=>'کد شناسایی باید عدد باشد',
            'code.digits'=>'کد شناسایی باید 4 رقم باشد.',
            'code.unique'=>'کد دوره باید منحصر به فرد باشد.',
            'description.required'=>'وارد کردن توضیحات دوره الزامی می باشد.',
            'price.required'=>'وارد کردن قیمت الزامی می باشد.',
            'price.numeric'=>'قیمت باید عدد باشد.',
            'image.required'=>'وارد کردن تصویر الزامی می باشد.',
            'image.mimes'=>'فرمت تصویر باید از نوع png,jpg,jpeg می باشد.',
            'categories.required'=>'انتخاب دسته بندی الزامی می باشد.',
        ]);

        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $uploadImage= $this->uploadImage($image);

        }else{
            $uploadImage=$request->image;
        }
//        DB::table('sub_courses')->where('course_id',$course->id)->delete();
        if(isset($request->courses))
        {
            for($i=0 ; $i<=count($request->courses) ;$i++)
            {
                if(empty($request['courses'][$i]) || !is_numeric($request['courses'][$i])) continue;
               $data =[
                   'course_id'=>$course->id,
                   'subCourse_id'=>intval($request['courses'][$i]),
               ];
            //    dd($data);
            SubCourse::where('course_id',$course->id)->update($data);
            }
        }
        $course->update(array_merge($request->all(),['image'=>$uploadImage]));
        $course->categories()->attach($request->categories);
        Session::flash('success', 'دوره با موفقیت بروزرسانی شد.');
        return redirect('admin/courses');
    }
    else{
        return abort(403);
    }
    }

    public function active(Course $course)
    {
        $this->authorize('isAdmin');
        $course->status=1;
        $course->save();


        Session::flash('success', 'نمایش دوره فعال شد.');
        return redirect()->back();
    }
    public function inactive(Course $course)
    {
        $this->authorize('isAdmin');
        $course->status=0;
        $course->save();
        Session::flash('success', 'نمایش دوره غیر فعال شد.');
        return redirect()->back();
    }
    public function delete(Course $course)
    {
       $user=auth()->user();
       if($user->isAdmin())
       {
        try{

            $course=$course->delete();

              Session::flash('success', 'دوره  با موفقیت حذف شد');
              return redirect('admin/courses');

          }catch (\Exception $e)
          {
              Session::flash('success', 'دوره  با موفقیت حذف شد');
              return redirect('admin/courses');
          }


       }elseif(auth()->user()->id==$course->user_id){
        try{

            $course=$course->delete();

              Session::flash('success', 'دوره  با موفقیت حذف شد');
              return redirect('admin/courses');

          }catch (\Exception $e)
          {
              Session::flash('success', 'دوره  با موفقیت حذف شد');
              return redirect('admin/courses');
          }
       }else{
           return abort(403);
       }


    }
    public function listEposide(Course $course)
    {
        $user=auth()->user();
        if($user->isAdmin())
        {
            $eposides=  $course->eposides()->orderBy('id','DESC')->paginate(10);
        }
        else{

            $eposides=  $course->eposides()->where('user_id',Auth::user()->id)->latest()->paginate(10);
        }
        return view('Admin.course.listEposides',compact('eposides','course'));
    }

    private function uploadImage($image)
    {
        $filename= time().'.'.$image->getClientOriginalName();
        $image->move(public_path('images/'),$filename);
        return $filename;
    }
}
