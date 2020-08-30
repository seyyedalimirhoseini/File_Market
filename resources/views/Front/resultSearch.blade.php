@extends('Front.layout.master')
<?php

sleep(3);
$response = new stdClass;
$response->status = "success";
// die(json_encode($response));
?>
@section('title')
نتیجه جستجو
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
                            echo '<span style="color: #ff0000"> به مناسبت '.$coupon[0]->name.' </span>';
                            echo'<span style="color: #ff0000">'.'مهلت باقی مانده'.$days.'روز</span>';
            }
    ?>

 @endif
<div class="header_bottom">
		<div class="header_bottom_right">
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.html"> <img src="images/pic4.png" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>آی فون</h2>
						<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
						<div class="button"><span><a href="preview.html">افزودن به سبد خرید</a></span></div>
				   </div>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview-5.html"><img src="images/pic3.png" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>سامسونگ</h2>
						  <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
						  <div class="button"><span><a href="preview-5.html">افزودن به سبد خرید</a></span></div>
					</div>
				</div>
			</div>
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview-3.html"> <img src="images/pic3.jpg" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
						<div class="button"><span><a href="preview-3.html">افزودن به سبد خرید</a></span></div>
				   </div>
			   </div>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview-6.html"><img src="images/pic1.png" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
						  <div class="button"><span><a href="preview-6.html">افزودن به سبد خرید</a></span></div>
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
						<li><img src="/front/images/1.jpg" alt=""/></li>
						<li><img src="/front/images/2.jpg" alt=""/></li>
						<li><img src="/front/images/3.jpg" alt=""/></li>
						<li><img src="/front/images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
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

@if($courses && count($courses))
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
    @else
        <p style="color:red">نتیجه مورد نظر یافت نشد!</p>
       @endif

    </div>
@endsection
