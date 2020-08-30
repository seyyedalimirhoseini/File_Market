@extends('Front.layout.master')
@section('title')
صفحه تماس با ما
@endsection
@section('content')

<div class="support">
    <div class="support_desc">
        <h3>
پشتیبانی زنده
</h3>
        <p><span>
24 ساعت | 7 روز هفته | 365 روز سال زنده پشتیبانی فنی
</span></p>
        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد</p>
    </div>
<img src="{{url('front/images/contact.png')}}" alt="" />
    <div class="clear"></div>
</div>
<div class="section group">
    <div class="col span_2_of_3">
      <div class="contact-form">
          <h2>تماس با ما</h2>
      <form  method="POST" action="{{route('contactStore')}}">
        @csrf
                <div @if ($errors->has('name')) has-error @endif>
                    <span><label>نام</label></span>
                <span><input name="name" type="text" value="{{old('name')}}"></span>
                <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>
                </div>
                <div @if ($errors->has('email')) has-error @endif>
                    <span><label>ایمیل</label></span>
                <span><input name="email" type="text" value="{{old('email')}}"></span>
                <span class="text-danger" id="email" style="color: red;">{{$errors->first('email')}}</span>
                </div>
                <div @if ($errors->has('phone')) has-error @endif>
                     <span><label>موبایل</label></span>
                <span><input name="phone" type="text" value="{{old('phone')}}"></span>
                <span class="text-danger" id="phone" style="color: red;">{{$errors->first('phone')}}</span>
                </div>
                <div @if ($errors->has('description')) has-error @endif>
                    <span><label>عنوان</label></span>
                    <span><textarea name="description">{{old('description')}} </textarea></span>
                    <span class="text-danger" id="description" style="color: red;">{{$errors->first('description')}}</span>

                </div>
               <div>
                       <span><input type="submit" value="ارسال"></span>
              </div>
            </form>
      </div>
      </div>
    <div class="col span_1_of_3">
        <div class="contact_info">
             <h2>
ما در اینجا پیدا کنید
</h2>
                  <div class="map">
                           <iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:right;font-size:12px">
مشاهده بزرگتر نقشه
</a></small>
                  </div>
          </div>
      <div class="company_address">
             <h2>
اطلاعات شرکت:
</h2>
                    <p>مرجع تخصصی برنامه نویسان</p>
                       <p>خیابان ملک-نرسیده به شریعتی</p>
                       <p>ایران</p>
               <p>تلفن:(00) 222 666 444</p>
               <p>فکس: (000) 000 00 00 0</p>
              <p>ایمیل: <span>info@barnamenevisan.org</span></p>
               <p>
دنبال شده در:
<span>Facebook</span>, <span>Twitter</span></p>
       </div>
     </div>
  </div>








@endsection
