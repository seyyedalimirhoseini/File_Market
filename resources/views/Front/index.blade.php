@extends('Front.layout.master')
@section('title')
صفحه اصلی
@endsection

@section('content')
 @if(isset($coupon[0]))
    <?php
         $English_Number = str_replace(

                    array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
                    array('0','1','2','3','4','5','6','7','8','9'),
                    $coupon[0]->expiry_date
                );
                $end =\Carbon\Carbon::parse($English_Number); // add this line

               $start=\Carbon\Carbon::parse(jdate(\Carbon\Carbon::now()->format('Y/m/d')));
            if(jdate(\Carbon\Carbon::now())->format('Y/m/d') < $English_Number){
                $days = $end->diffInDays($start);
                             echo '<span style="color: #ff0000">% '.$coupon[0]->percent.' تخفیف</span>';

                            echo '<span style="color: #ff0000"> به مناسبت '.$coupon[0]->name.' </span>';
                            echo'<span style="color: #ff0000">'.'مهلت باقی مانده'.$days.'روز</span>';
            }
    ?>

 @endif
<div class="header_bottom">
		<div class="header_bottom_right">
			<div class="section group " >
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1   ">
                    <a href="#"> <img src="{{url('/front/images/video.png')}} " alt="" style="width:100px" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>ویدئو</h2>
                    <p>{{count($eposides)}}</p>

				   </div>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="#"><img src="{{url('/front/images/course.png')}}" alt="" style="width:100px"/ ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>دوره</h2>
                    <p>{{count($courses)}}</p>

					</div>
				</div>
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="#"> <img src="{{url('/front/images/student.png')}}" alt="" style="width:100px"/></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>دانشجو</h2>
                    <p>{{count($users)}}</p>

				   </div>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="#"><img src="{{url('/front/images/teacher.png')}}" alt="" style="height:100px" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>استاد</h2>
						  <p>{{count($teachers)}}</p>

					</div>
				</div>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_left_images">
		   <!-- FlexSlider -->
              <section class="slider" dir=ltr>
				  <div class="flexslider">
					<ul class="slides">
                        @foreach($sliders as $slider)


						<li>  <img src="{{URL('sliderimages/')}}/{{$slider->image}}" height="200px"></li>

                        @endforeach
				    </ul>
				  </div>
        </section>
        <br>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>
<div class="content_top">
    <div class="heading">
<h3>
    دوره های برگزار شده
</h3>
    </div>

    <div class="page-no">
     <p>
      تعداد صفحات:
         <ul>
           {{$courses->links()}}
        </ul>
    </p>
    </div>
    <div class="clear"></div>
</div>
  <div class="section group">


    @foreach($courses as $course)
    <div class="grid_1_of_4 images_1_of_4">
    <img src="{{url('images')}}/{{$course->image}}" alt="" />
         <h2>
            {{$course->name}}
        </h2>
    <p>{!! Str::limit($course->description, 20)!!}</p>
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
          <p><span class="strike">{{$course->price}}تومان</span><span class="price">{{$dis}}تومان</span></p>

                @else
                      <p><span class="price">
                                 {{$course->price}}تومان
                                 </span></p>
                @endif
    @else
           <p><span class="price">
           {{$course->price}}تومان
           </span></p>
    @endif
    @else
          <p><span class="price">رایگان</span></p>
    @endif
    @if($course->price ==0)
    <div class="button"><span><img src="{{url('/front/images/cart.jpg')}}" alt="" /><a href="#" class="cart-button">رایگان</a></span> </div>
    @else
           <div class="button"><span><img src="{{url('/front/images/cart.jpg')}}" alt="" /><a href="#" class="cart-button">نقدی</a></span> </div>
    @endif
    <div class="button"><span><a href="{{$course->details()}}" class="details">جزئیات</a></span></div>
    </div>
    @endforeach

    </div>
@endsection
