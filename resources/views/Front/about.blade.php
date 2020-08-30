@extends('Front.layout.master')
@section('title')
صفحه درباره ما
@endsection
@section('content')




				<div class="">
                    <div class="section group">
                    <h3 style="color:gray">کی هستیم</h3>
                    @foreach ($abouts as $about  )


                    <img src="{{URL('aboutimages/')}}/{{$about->image}}" >
                    <p>{!! $about->description !!}</p>
                 </div>
                @endforeach

			</div>
			<h2>تیم ما</h2>
			<div class="section group">
				<div class="grid_1_of_5 images_1_of_5">
                <img src="{{url('front/images/team1.jpg')}}" alt="" />
					  <h3>استاد وب</h3>
					<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
                </div>
                <div class="grid_1_of_5 images_1_of_5">
                <img src="{{url('front/images/team2.jpg')}}" alt="" />
                     <h3>استاد اندروید</h3>
                   <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
               </div>
               <div class="grid_1_of_5 images_1_of_5">
               <img src="{{url('front/images/team3.jpg')}}" alt="" />
                 <h3>استاد طراحی</h3>
               <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
           </div>
           <div class="grid_1_of_5 images_1_of_5">
           <img src="{{url('front/images/team4.jpg')}}" alt="" />
             <h3>استاد هوش مصنوعی</h3>
           <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
       </div>
       <div class="grid_1_of_5 images_1_of_5">
       <img src="{{url('front/images/team1.jpg')}}" alt="" />
         <h3>استاد بیگ دیتا</h3>
       <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>
   </div>
			</div>








@endsection
