<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function index()
    {
        $this->authorize('isAdmin');
        $faqs=Faq::latest()->paginate(10);
        return view('admin.faq.index',compact('faqs'));
    }
    public function create()
    {
        $this->authorize('isAdmin');
        return view('admin.faq.create');
    }
    public function store(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'question' => 'required|unique:faqs,question',
            'answer'=>'required',


        ], [
            'question.required'=>'وارد کردن سوال الزامی می باشد.',
            'question.unique'=>'سوال باید منحصربه فرد باشد.',
            'answer.required'=>'وارد کردن جواب  الزامی می باشد.',


        ]);
        Faq::create($request->all());
        Session::flash('success', 'عملیات با موفقیت انجام شد.');
        return redirect('admin/faq');
    }
    public function edit(Faq $faq)
    {
        $this->authorize('isAdmin');
        return view('admin.faq.edit',compact('faq'));
    }
    public function update(Request $request ,Faq $faq)
    {
        $this->authorize('isAdmin');
        $this->validate($request, [
            'question' => 'required|unique:faqs,question,'.$faq->id,
            'answer'=>'required',


        ], [
            'question.required'=>'وارد کردن سوال الزامی می باشد.',
            'question.unique'=>'سوال باید منحصربه فرد باشد.',
            'answer.required'=>'وارد کردن جواب  الزامی می باشد.',


        ]);
        $faq->update($request->all());
        Session::flash('success', 'عملیات با موفقیت بروزرسانی شد.');
        return redirect('admin/faq');

    }
    public function delete(Faq $faq)
    {
        $this->authorize('isAdmin');
        try{
            $faq->delete();
            Session::flash('success', 'حذف شد.');
            return redirect('admin/faq');
        }catch(\Exception $e){

            Session::flash('success', 'حذف نشد.');
            return redirect('admin/faq');
        }
    }

}
