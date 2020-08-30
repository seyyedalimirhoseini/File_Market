<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teach;
use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public  function index()
    {
        $this->authorize('isAdmin');
        $teaches=Teach::latest()->paginate(10);
        return view('Admin.index',compact('teaches'));
    }
    public function updateRole(Request $request,User $user)
    {
        $this->authorize('isAdmin');
//        $user->update(array('role' => $request['role']));

            $user->role=$request['role'];
            $user->save();
        Session::flash('success','نقش کاربر بروز رسانی شد.');
        return redirect()->back();

    }
    public function deleteTeach(Teach $teach)
    {
        $this->authorize('isAdmin');
        try{
            $teach->delete();
            Session::flash('success','درخواست کاربر با موفقیت حذف شد.');
            return redirect()->back();
        }catch (\Exception $e)
        {
            Session::flash('error','درخواست کاربر با موفقیت حذف نشد!');
            return redirect()->back();
        }
    }
    public function showContact()
    {
        $this->authorize('isAdmin');
        $contacts=Contact::latest()->paginate(10);
        return view('Admin.contact.index',compact('contacts'));
    }
    public function deleteContact(Contact $contact)
    {
        $this->authorize('isAdmin');
        try{
            $contact->delete();
            Session::flash('success','حذف شد.');
            return redirect()->back();
        }catch (\Exception $e)
        {
            Session::flash('error','حذف نشد.');
            return redirect()->back();
        }
    }
}
