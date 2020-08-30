<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public  function index()
    {
        $this->authorize('isAdmin');
        $categories=Category::latest()->paginate(10);
        return view('Admin.category.index',compact('categories'));
    }
    public function create()
    {
        $this->authorize('isAdmin');
        $plucked=Category::where('parent_id',0)->pluck('name','id');
        $categories=['0'=>'دسته بندی اصلی']+$plucked->all();
        return view('Admin.category.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'name' => 'required|unique:categories,name',

        ], [
            'name.required' => 'وارد کردن نام دسته بندی الزامی می باشد.',
            'name.unique'=>'نام دسته بندی قبلا رزرو شده است.',



        ]);
        if(empty($request['status']))
        {
            $request['status']=0;
        }
        $categories=Category::create($request->all());
        Session::flash('success', 'دسته بندی با موفقیت ذخیره شد.');
        return redirect(route('admin.category.index'));
    }
    public function edit(Category $category)
    {
        $this->authorize('isAdmin');
        $plucked=Category::where('parent_id',0)->pluck('name','id');
        $categories=['0'=>'دسته بندی اصلی']+$plucked->all();
        return view('Admin.category.edit',compact('category','categories'));
    }
    public function update(Request $request,Category $category)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [

            'name' => 'required|unique:categories,name,'.$category->id,
        ], [
            'name.required' => 'وارد کردن نام دسته بندی الزامی می باشد.',
            'name.unique'=>'نام دسته بندی قبلا رزرو شده است.',


        ]);
        if(empty($request['status']))
        {
            $request['status']=0;
        }
        $category->update($request->all());
        Session::flash('success', 'دسته بندی با موفقیت بروزرسانی شد.');
        return redirect(route('admin.category.index'));

    }
    public function delete(Category $category)
    {
        $this->authorize('isAdmin');
            try{
                $category->delete();
                Session::flash('success', 'دسته بندی با موفقیت حذف شد.');
                return redirect(route('admin.category.index'));

            }catch(\Exception $e)
            {
                Session::flash('success', 'دسته بندی با موفقیت حذف نشد.');
                return redirect(route('admin.category.index'));
            }

        }

}
