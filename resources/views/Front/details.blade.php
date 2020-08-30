@extends('Front.layout.master')
@section('title')
صفحه جزئیات
@endsection
@section('css')
{{-- {{-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> --}}
<style>
    td{
        width: 30%;
    }
</style>
@endsection
@section('content')
<script>
    $(document).ready(function(){

        $('#cartBtn').click(function(){
            var id= $('#id').val();


            $.ajax({
                type: 'get',
                 url: '<?php echo url('/cart/add');?>/'+id,

                success:function(){


                        $('#cartBtn').hide();
                            $('#successMsg').show();
                            $('#successMsg').append('محصول اضافه شد.');
                }

      });

    });


});

    </script>

<?php

$sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

$array = array();
foreach ( $sub_courses as $key => $value) {
    $array[$key] = $value->subCourse_id;
}
// dd($array);
$eposides = App\Eposide::whereIn('course_id', $array)->get();
// dd($eposides);

?>

 <div class="main">
    <div class="content">
<video width="100%" controls>
    @if(count($sub_courses)>0)
         <source src="{{ asset('storage/eposides/'.$eposides->first()->file) }}" type="video/mp4">
     @else
        @if(isset($course->eposides()->first()->file))
        <source src="{{ asset('storage/eposides/'.$course->eposides()->first()->file) }}" type="video/mp4">

            {{-- <source src="{{ asset('storage/eposides/'.$eposides->first()->file) }}" type="video/mp4"> --}}
         @endif
     @endif
        </video>


    	<div class="section group">
				<div class="cont-desc span_1_of_2">

		<div class="product-desc">
            <input type="hidden" id="pro_id" value="{{$course->id}}"/>
			<h2>
                جزئیات محصول
            </h2>
            <p>{!! $course->description!!}</p>
	     </div>

	    <div class="product-tags">
			<h2>لینک های دانلود</h2>
            <br>

           @if(count($sub_courses)>0)
           @foreach($eposides as $item)
           @if($item->destroy == 2)
           @if($item->status == 1)
                 <table style="width:100%">
                   @if(Auth::check())

                   <tr>
                   @if($item->type=='نقدی')
                     <td><a href="#"><h3>{{$item->name}}</h3></a></td>
                      <td>{{$item->time}}دقیقه</td>
                      <td>{{$item->type}}</td>
                      <td><a href="#"><img src="{{url('/front/images/padlock.png')}}" style="width: 20px"></a></td>
                  @else
                   <td><a href="{{$item->download()}}"><h3>{{$item->name}}</h3></a></td>
                    <td>{{$item->time}}دقیقه</td>
                    <td>{{$item->type}}</td>
                    <td><a href="{{$item->download()}}"><img src="{{url('/front/images/down.png')}}" style="width: 20px"></a></td>
                  @endif
                  @else
                  <td><a href="#"><h3>{{$item->name}}</h3></a></td>
                      <td>{{$item->time}}دقیقه</td>
                      <td>{{$item->type}}</td>
                      <td><a href="#"><img src="{{url('/front/images/padlock.png')}}" style="width: 20px"></a></td>
                  @endif

                   </tr>


                 </table>
                 @endif
                @endif
                 <br>
                   @endforeach
                 @else
                    @foreach($course->eposides as $item)
                    @if($item->destroy == 2)
                    @if($item->status == 1)
                          <table style="width:100%">
                            @if(Auth::check())

                            <tr>
                            @if($item->type=='نقدی')
                              <td><a href="#"><h3>{{$item->name}}</h3></a></td>
                               <td>{{$item->time}}دقیقه</td>
                               <td>{{$item->type}}</td>
                               <td><a href="#"><img src="{{url('/front/images/padlock.png')}}" style="width: 20px"></a></td>
                           @else
                            <td><a href="{{$item->download()}}"><h3>{{$item->name}}</h3></a></td>
                             <td>{{$item->time}}دقیقه</td>
                             <td>{{$item->type}}</td>
                             <td><a href="{{$item->download()}}"><img src="{{url('/front/images/down.png')}}" style="width: 20px"></a></td>
                           @endif
                           @else
                           <td><a href="#"><h3>{{$item->name}}</h3></a></td>
                               <td>{{$item->time}}دقیقه</td>
                               <td>{{$item->type}}</td>
                               <td><a href="#"><img src="{{url('/front/images/padlock.png')}}" style="width: 20px"></a></td>
                           @endif

                            </tr>


                          </table>
                          @endif
                         @endif
                          <br>
                            @endforeach
                   @endif

			<h4>برچسب ها خود را اضافه کنید:</h4>
			<div class="input-box">
				<input type="text" value="" />
			</div>
			<div class="button"><span><a href="#">اضافه کردن برچسب ها</a></span></div>
	    </div>
	</div>
				<div class="leftsidebar span_3_of_1" dir=ltr>

                   <div >
                             <div class="grid images_3_of_2" style="width: 67%" >

                                  <img src="{{URL('avatars/')}}/{{$course->user->avatar['image_pro']}}" height="100px" width="100px">
                                    <p>{{$course->user['name']}}</p>
                             </div>
                   </div>

                        <div class="desc span_3_of_2">


                        					<h2 >:توضیحات در مورد مدرس</h2>

                        					<p >{!! $course->user->avatar['description'] !!}</p>
                        					<div class="price">

                                                      @if($course->price != 0)

                                                          @if(isset($coupon[0]))
                                                              <?php $dis=(($coupon[0]->percent)*($course->price))/100;

                                                                      $English_Number = str_replace(

                                                                       array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
                                                                       array('0','1','2','3','4','5','6','7','8','9'),
                                                                         $coupon[0]->expiry_date
                                                                        );
                                                                      ?>
                                                                      @if(jdate(\Carbon\Carbon::now())->format('Y/m/d') < $English_Number)
                                                                <p>قیمت:<span >{{$dis}}تومان</span></p>

                                                                     @else
                                                                     <p>قیمت:<span >
                                                                            {{$course->price}}تومان
                                                                          </span></p>
                                                                      @endif
                                                           @else
                                                                  <p>قیمت:<span >
                                                                            {{$course->price}}تومان
                                                                          </span></p>

                                                          @endif

                                                          @else
                                                          <p>قیمت:<span class="price">رایگان</span></p>
                                                          @endif

                                            </div>

                                            {{-- <form action="{{ route('rates') }}" method="POST">
                                                    @csrf
                                                    <div class="rating">

                                                        <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $course->userAverageRating }}" data-size="xs">

                                                        {{-- <input type="hidden" name="id" required="" value="{{ $course->id }}"> --}}

                                                        {{-- <span class="review-no">422 reviews</span> --}}

                                                        {{-- <br/>

                                                        <button class="btn btn-success">رتبه بده</button>

                                                    </div> --}}
                                            {{-- </form> --}}
                                    {{-- <form method="post" action="{{ url('/cart/add/'.$course->id) }}">
                        				@csrf --}}
                        				<div class="add-cart">

                        					@if(Auth::check())
                        					    {{--<div class="button" >--}}


                                                {{--<span><a href="{{url('/cart/add/'.$course->id)}}">افزودن به سبد خرید</a></span>--}}
                                                {{--</div>--}}
                                     {{-- @foreach(Cart::content() as $cart) --}}
                                                     {{-- @if(isset($cart->id)) --}}

                                                    {{-- @else --}}

                                                    @if($course->price !=0)
                                                        @if(in_array($course->id,Cart::content()->pluck('id')->toArray() ))
                                                            <a class="button1" id="cartBtn1">افزودن به سبد خرید</a>

                                                        @else
                                                <button type="submit" class="button1" id="cartBtn"> افزودن به سبد خرید</button>
                                                <input type="hidden" id="id" value="{{$course->id}}"/>
                                                    <div id="successMsg" style="width:100%;height:20%;background-color:#33d9b2;color:#218c74"></div>


                                                        @endif

                                                @endif
                                          {{-- @endif --}}
                                {{-- @endforeach --}}

                                            @endif

                        					<div class="clear"></div>
                        				</div>
                        	    {{-- </form> --}}
                        			</div>

 				</div>
 		</div>
 	</div>
	</div>



{{--
@section('script')
<script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>

@endsection --}}

{{-- @section('script')
<script type="text/javascript">

    $("#input-id").rating();

</script>

@endsection --}}

@endsection

