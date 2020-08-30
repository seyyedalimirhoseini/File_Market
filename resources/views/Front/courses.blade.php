@extends('Front.layout.master')
@section('title')
دوره ها
@endsection
@section('content')

<div class="content_top">
    <div class="heading">
<h3>
  دوره  {{$category->name}}
</h3>
    </div>

    <div class="page-no">
     <p>
      تعداد صفحات:
         <ul>
{{--           {{$courses->links()}}--}}
        </ul>
    </p>
    </div>
    <div class="clear"></div>
</div>
  <div class="section group">

    @if($list_courses && count($list_courses)>0)
    @foreach( $list_courses as  $list_course)
    <div class="grid_1_of_4 images_1_of_4">

    <img src="{{url('images')}}/{{$list_course->image}}" alt="" />
         <h2>
            {{$list_course->name}}
        </h2>
    <p>{!! Str::limit($list_course->description, 20)!!}</p>
         {{-- <p><span class="strike">$436.22</span><span class="price">$415.54</span></p> --}}
       @if($list_course->price =='')
    <div class="button"><span><img src="/front/images/cart.jpg" alt="" /><a href="#" class="cart-button">رایگان</a></span> </div>
       @else
           <div class="button"><span><img src="/front/images/cart.jpg" alt="" /><a href="#" class="cart-button">نقدی</a></span> </div>
    @endif
    <div class="button"><span><a href="{{$list_course->details()}}" class="details">جزئیات</a></span></div>
    </div>
    @endforeach
    @else
        <p>دوره ای وجود ندارد!</p>

    @endif

    </div>
@endsection
