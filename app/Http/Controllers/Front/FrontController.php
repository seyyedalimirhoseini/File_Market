<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Coupon;
use App\Course;
use App\Eposide;
use App\About;
use App\Contact;
use App\Faq;
use App\Front;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Teach;
use App\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public  function index()
    {

    //    $courses=Course::withTrashed()->get();
    //    dd($courses);
        $courses=Course::where('status',1)->orderBy('id','DESC')->paginate(5);
        $coupon=Coupon::where('status',1)->get();
        $eposides=Eposide::get();
        $teachers=User::where('role','teacher')->orwhere('role','admin')->get();
        $users=User::where('role','user')->get();
        $sliders=Slider::orderBy('id','DESC')->get();


        return view('Front.index',compact('courses','coupon','eposides','teachers','users','sliders'));
    }
    public function details($slug)
    {

        if(!Auth::check())
        {
            alert()->message('برای دانلود باید به حساب کاربری خود دسترسی داشته باشید.')->persistent("باشه");

        }


        $coupon=Coupon::where('status',1)->get();
        $course= Course::where('slug', $slug)->first();

            if(!$course)
            {
               return abort(404);
            }
        else{
            return view('Front.details',compact('course','coupon'));
        }

    }
    public function listByCat(Category $category)
    {
            //  $list_courses=$category->courses()->where('status',1 )->get();
            // $cat = Category::where('id', $category->id)->first();

        if ($category) {
            $course = DB::table('category_course')->where('category_id', $category->id)->orderBy('course_id', 'desc')->get();

            $array = array();
            foreach ($course as $key => $value) {
                $array[$key] = $value->course_id;
            }
            $list_courses = Course::orderBy('id', 'ASC')->where('status',1 )->whereIn('id', $array)->get();

            return view('Front.courses',compact('list_courses','category'));

        }
        else{
          return  abort(404);
        }




    }
    public function download(Eposide $eposide)
    {

        //    $eposide=Eposide::withTrashed()->find($id);
        //    dd($eposide->id);
        $hash = 'fds@#T@#56@sdgs131fasfq' . $eposide->id . \request()->ip() . \request('t');

        if(Hash::check($hash , \request('mac'))) {
            if (file_exists(storage_path("app/public/eposides/{$eposide->file}"))) {

                return response()->download(storage_path("app/public/eposides/{$eposide->file}"));
                // return Response::json(storage_path("app/public/eposides/{$eposide->file}"));
            }
            else{
              return false;

            }

        }
        else {
            return 'لینک دانلود شما از کار افتاده است';
        }
    }

    public function teach()
    {
        return view('Front.teach');
    }
    public function requestTeach(Request $request)
    {
        $this->validate($request, [
            'degree' => 'required|regex:/^[a-zA-Z,آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/',
            'resume'=>'required|regex:/^[a-zA-Z,آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/',

        ], [
            'degree.required' => 'وارد کردن مدرک تحصیلی الزامی می باشد.',
            'degree.regex'=>'داده باید حروف باشد.',
            'resume.required' => 'وارد کردن رزومه کاری الزامی می باشد.',
            'resume.regex'=>'داده باید حروف باشد.',

        ]);

        $data=[
            'degree'=>$request['degree'],
            'resume'=>$request['resume'],
            'user_id'=>auth()->user()->id
        ];
        $check=Teach::all()->pluck('user_id')->toArray();

        if( in_array(Auth::user()->id,$check) || Auth::user()->role == "teacher")
        {

            alert()->error('شما یک دفعه درخواست داده اید!', 'خطا')->persistent("باشه");
            return redirect()->back();
        }elseif(Auth::user()->role == "admin")
        {
            alert()->error('', 'خطا')->persistent("باشه");
            return redirect()->back();
        }
        else{
            Teach::create($data);
            alert()->success('درخواست شما با موفقیت ثبت شد.', 'باتشکر')->persistent("باشه");

            return redirect()->back();
        }





    }

    public function search(Request $request)
    {


        if($request['q'] == null)
        {

            return redirect()->back();
        }else{
            $q=$request['q'];
            $courses = Course::where('name','LIKE','%'.$q.'%')->where('status',1)->orderBy('id','DESC')->paginate(5);
                return view('Front.resultSearch',compact('courses'));
        }

   }
   public function rate(Request $request)
   {
    request()->validate(['rate' => 'required']);

    $course = Course::find($request->id);



    $rating = new \willvincent\Rateable\Rating;

    $rating->rating = $request->rate;

    $rating->user_id = auth()->user()->id;



    $course->ratings()->save($rating);



    return redirect()->route("index");
   }
   public function about()
   {
       $abouts=About::all();
       return view('Front.about',compact('abouts'));
   }
   public function faq()
   {
       $faqs=Faq::all();
       return view('Front.faq',compact('faqs'));
   }
   public function contactForm()
   {
       return view('Front.contact');
   }
   public function contactStore(Request $request)
   {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric|digits:11',
            'description'=>'required',
        ],[
            'name.required' =>'وارد کردن نام الزامی است.',
            'email.required'=>'وارد کردن ایمیل الزامی می باشد.',
            'email.email'=>'تایپ باید از نوع ایمیل باشد.',
            // 'email.unique'=>'این ایمیل قبلا رزرو شده است.',
            'phone.required'=>'وارد کردن شماره تلفن همراه الزامی می باشد.',
            'phone.numeric'=>'شماره تلفن همراه باید عدد باشد.',
            'phone.digits'=>'شماره تلفن همراه  باید 11 رقم باشد',

            'description.required'=>'متن الزامی می باشد.',
        ]);
        Contact::create($request->all());
        alert()->success('پیام شما با موفقیت ثبت شد.', 'باتشکر')->persistent("باشه");

        return redirect()->back();
   }
}
