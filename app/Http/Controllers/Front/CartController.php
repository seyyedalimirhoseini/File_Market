<?php

namespace App\Http\Controllers\Front;

use App\Coupon;
use App\Course;
use App\Http\Controllers\Controller;
use App\Order;
use Facade\FlareClient\Http\Response;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Zarinpal\Zarinpal;
class CartController extends Controller
{
    public function addCart(Request $request,$id)
    {

       $course= Course::find($id);

        $coupon=Coupon::where('status',1)->get();
        $data['id']=$id;
       $data['name']=$course->name;

        if(isset($coupon[0]))
        {

            $dis=(($coupon[0]->percent)*($course->price))/100;
            $English_Number = str_replace(

                array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
                array('0','1','2','3','4','5','6','7','8','9'),
                $coupon[0]->expiry_date
            );
            if(jdate(\Carbon\Carbon::now())->format('Y/m/d') < $English_Number)
             {
                 $data['price']=$dis;

            }

            else
            {
                $data['price']=$course->price;
            }
        }
        else
        {
            $data['price']=$course->price;
        }


        $data['qty']=1;
       $data['weight']=0;
       $data['options']['code']=$course->code;

        // Session::flash('success','محصول اضافه شد');
            $cart= Cart::add($data);


   




        return back();
    }

    public function cart()
    {
        return view('Front.cart');
    }
    public function remove($id)
    {
//       $rowId= Cart::get($rowId);
        Cart::remove($id);



        Session::flash('success', 'آیتم مورد نظر با موفقیت حذف شد');
        // $rowId= url()->current();
        // if($rowId)
        // {
        //     delete($rowId);
            return back();
        // }


    }
    public function zarinpal()
    {
        $total_cart = Cart::initial(0, '', '', '');

        $zarinpal = new Zarinpal('aae0a368-021a-11e6-a1db-005056a205be');
        $zarinpal->enableSandbox(); // active sandbox mod for test env
        // $zarinpal->isZarinGate(); // active zarinGate mode

        $results = $zarinpal->request(
            route('zarinpal.callback'),         //required
            $total_cart,                                //required
            auth()->user()->name,                             //required
            auth()->user()->email,                      //optional
            '09000000000',                        //optional
            [                          //optional
                "Wages" => [
                    "zp.1.1"=> [
                        "Amount"=> 120,
                        "Description"=> "part 1"
                    ],
                    "zp.2.5"=> [
                        "Amount"=> 60,
                        "Description"=> "part 2"
                    ]
                ]
            ]
        );
        echo json_encode($results);
        if (isset($results['Authority'])) {
            file_put_contents('Authority', $results['Authority']);
            $zarinpal->redirect();
        }
    }
    public function callback()
    {
        $status=$_GET['Status'];

        if($status == 'OK')
        {

           foreach(Cart::content() as $cart)
           {
               $data=Order::create([
          'name'=>$cart->name,
           'price'=>$cart->price,
           'qty'=>$cart->qty,
            'user_id'=>auth()->user()->id,
            'course_id'=>$cart->id,
            'authority'=>$_GET['Authority'],
                ]);

           }
            Cart::destroy();
            alert()->success('خرید با موفقیت انجام شد.', 'باتشکر')->persistent("باشه");

        return redirect('/cart');

        }else{
                return 'مشکلی در پرداخت به وجود آمده است.';
        }
    }


}

