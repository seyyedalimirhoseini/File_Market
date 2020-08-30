<?php

namespace App\Http\Controllers;

use App\Course;
use App\Eposide;
use App\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
//        $orders=DB::table('orders')
//
//            ->join('eposides','eposides.course_id','=','orders.course_id')
//
//            ->where('orders.user_id','=',Auth::user()->id)
//            ->get();
$user=auth()->user();
    if($user->isAdmin())
        {
        $orders=Order::latest()->paginate(10);
        }
        else{
        $orders= Order::withTrashed()->where('user_id','=',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
      }



        return view('Order.index',compact('orders'));
    }
//     public function download($id)
//     {

//         $eposide=Eposide::withTrashed()->find($id);
//             if (file_exists(storage_path("app/public/eposides/{$eposide->file}"))) {
// //
//                 return response()->download(storage_path("app/public/eposides/{$eposide->file}"));
//             }
//             else{
//                 return false;

//             }


//     }
    public function show($id)
    {
            $course=Course::where('id',$id)->withTrashed()->first();
            // dd($course1->name);
            return view('Order.show',compact('course'));


    }
    public function delete(Order $order)
    {
        $this->authorize('isAdmin');
        try{
            $order->delete();
            Session::flash('success','حذف شد.');
            return redirect()->back();
        }catch(\Exception $e)
        {
            Session::flash('error','حذف نشد.');
            return redirect()->back();
        }

    }


}
