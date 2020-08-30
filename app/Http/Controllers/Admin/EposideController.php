<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use DB;
use App\Course;
use App\Eposide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EposideController extends Controller
{
    public function index()
    {
        $eposides=Eposide::latest()->paginate(10);
        $teacher_eposides=Eposide::where('user_id',Auth::user()->id)->latest()->paginate(10);
        return view('Admin.eposide.index',compact('eposides','teacher_eposides'));
    }
    public function create(Course $course)
    {


        $sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

        $array = array();
        foreach ( $sub_courses as $key => $value) {
            $array[$key] = $value->subCourse_id;
        }
        // dd($array);
        $eposides = Eposide::whereIn('course_id', $array)->get();



        if( auth()->user()->id==$course->user_id && count($sub_courses)>0){
            return abort(403);
        }
        else{

            return view('Admin.eposide.create',compact('course'));
        }

    }
    public function store(Request $request,Course $course)
    {
        $this->validate($request, [
            'name' => 'required|unique:eposides,name',
            'time'=>'required',
            'url'=>'required|url',
//            'price'=>'required|numeric',
            'file'=>'required|mimes:mp4,zip,rar',
        ], [
            'name.required' => 'وارد کردن نام دوره الزامی  می باشد.',
            'name.unique'=>'نام ویدئو قبلا رزرو شده است.',
            'time.required'=>'وارد کردن زمان دوره الزامی می باشد.',
            'url.required'=>'وارد کردن لینک ویدئو الزامی می باشد.',
            'url.url'=>'لینک صحیح نمی باشد.',
//            'price.required'=>'وارد کردن قیمت دوره الزامی می باشد.',
//            'price.numeric'=>'قیمت دوره الزامی می باشد.',
            'file.required'=>'وارد کردن ویدئو الزامی می باشد.',
            'file.mimes'=>'فرمت ویدئو باید mp4 باشد.',
//            'file.video'=>'فایل باید ویدئو باشد.',
        ]);
        $sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

        $data=[
            'name'=>$request['name'],
            'time'=>$request['time'],
            'type'=>$request['type'],
            'course_id'=>$course->id,
            'user_id'=>auth()->user()->id,
            'url'=>$request['url']
        ];
        if (count($sub_courses) == 0) {
        $file= $request->file('file');

            $uploadFile = $this->uploadImage($file);

            $eposide = Eposide::create(array_merge($data, ['file' => $uploadFile]));

            Session::flash('success', 'ویدئو با موفقیت ذخیره شد.');
            return redirect('admin/courses');
        }else{
            return  redirect()->back();
        }
    }
    public function edit(Eposide $eposide)
    {
        if( auth()->user()->id==$eposide->user_id){
        return view('admin.eposide.edit',compact('eposide'));
        }
        else{
            return abort(403);
        }
    }
    public function update(Request $request,Eposide $eposide)
    {
        if( auth()->user()->id==$eposide->user_id){
        $this->validate($request, [
            'name' => 'required|unique:eposides,name,'.$eposide->id,
//            'price'=>'required|numeric',
              'url'=>'required|url',
            'time'=>'required',
            'file'=>'required|mimes:mp4,zip,rar',
        ], [
            'name.required' => 'وارد کردن نام دوره الزامی  می باشد.',
            'name.unique'=>'نام ویدئو قبلا رزرو شده است.',
              'url.required'=>'وارد کردن لینک ویدئو الزامی می باشد.',
            'url.url'=>'لینک صحیح نمی باشد.',
            'time.required'=>'وارد کردن زمان دوره الزامی می باشد.',
//            'price.required'=>'وارد کردن قیمت دوره الزامی می باشد.',
//            'price.numeric'=>'قیمت دوره الزامی می باشد.',
            'file.required'=>'وارد کردن ویدئو الزامی می باشد.',
            'file.mimes'=>'فرمت ویدئو باید mp4 باشد.',
//            'file.video'=>'فایل باید ویدئو باشد.',
        ]);
        if($request->hasFile('file'))
        {
            $file=$request->file('file');
            $uploadImage= $this->uploadImage($file);

        }else{
            $uploadImage=$request->file;
        }

        $eposide->update(array_merge($request->all(),['file'=>$uploadImage]));

        Session::flash('success', 'ویدئو با موفقیت بروزرسانی شد.');
        return redirect('admin/courses');
    }
    else{
        return abort(403);
    }
    }
    public function active(Eposide $eposide)
    {
        $this->authorize('isAdmin');
        $eposide->status=1;
        $eposide->save();


        Session::flash('success', 'نمایش ویدئو فعال شد.');
        return redirect()->back();
    }
    public function inactive(Eposide $eposide)
    {
        $this->authorize('isAdmin');
        $eposide->status=0;
        $eposide->save();

        Session::flash('success', 'نمایش ویدئو غیر فعال شد.');
        return redirect()->back();
    }
    public function delete(Eposide $eposide)
    {

        $eposide->destroy=3;
        $eposide->save();
        Session::flash('success', 'ویدئو حذف شد.');
        return redirect()->back();
        // try{
        //     $file=storage_path().'/app/public/eposides/'.$eposide->file;
        //     if($eposide->delete())
        //     {
        //         unlink($file);
        //     }
        //     Session::flash('success', 'ویدئو با موفقیت حذف شد');
        //     return redirect('admin/eposides');
        // }catch (\Exception $e)
        // {
        //     Session::flash('error', 'ویدئو با موفقیت حذف نشد.');
        //     return redirect('admin/eposides');
        // }
    }
    private function uploadImage($file)
    {
        $filename= time().'.'.$file->getClientOriginalName();
        $file->move(storage_path('/app/public/eposides/'),$filename);
        return $filename;
    }
}
