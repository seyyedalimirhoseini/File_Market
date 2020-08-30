@extends('Admin.layout.master')
@section('title')
صفحه لیست ویدئو ها
@endsection
@section('content')
{{-- <div id="content-header">
       <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
     </div> --}}
   <!--End-breadcrumbs-->
    @include('message')
   <!--Action boxes-->
   <?php

   $sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

   $array = array();
   foreach ( $sub_courses as $key => $value) {
       $array[$key] = $value->subCourse_id;
   }
   // dd($array);
   $link_eposides = App\Eposide::whereIn('course_id', $array)->latest()->paginate(10);


?>


            <div class="container-fluid">

                    <div class="widget-box">
                             <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                               <h5>لیست ویدئو:</h5>
                             </div>
                             <div class="widget-content nopadding">
                               <table class="table table-bordered data-table">
                                 <thead>
                                   <tr>
                                     <th>ردیف</th>
                                     <th>نام</th>
                                     <th>نام مدرس</th>
                                     <th>مدت زمان</th>
                                     <th>نوع ویدئو</th>
                                     <th>لینک</th>
                                     <th>فایل</th>
                                     <th>وضعیت</th>
                                     <th>ویرایش</th>
                                     {{-- <th>حذف</th> --}}

                                   </tr>
                                 </thead>
                                 <?php $i=1 ?>
                                 @if(count($sub_courses)>0)
                                 @if(!empty( $link_eposides) )
                                 @foreach(  $link_eposides as  $link)

                                   @if( $link->destroy == 2)
                                 <tbody>

                                  <tr class="gradeU">
                                    <td>{{$i++}}</td>
                                    <td>{{ $link->name}}</td>
                                  <td>{{ $link->course->user['name']}}</td>
                                  <td>{{ $link->time}}</td>
                                  <td>{{ $link->type}}</td>
                                  <td>{{ $link->url}}</td>
                                  <td><a href="{{ $link->download()}}"><img src="{{url('/front/images/down.png')}}" style="width: 20px"></a></td>
                                    @if(auth()->user()->role=='admin')
                                   @if( $link->status == 0)
                                   <td><a  href="{{route('active.eposide', $link->id)}}"  class="btn btn-success btn-mini">فعال</a></td>
                                       @else
                                <td ><a  href="{{route('inactive.eposide', $link->id)}}" class="btn btn-danger btn-mini">غیر فعال</a></td>
                                @endif
                                @else
                                    <td></td>
                                @endif
                            @if( auth()->user()->id== $link->user_id)
                        <td><a  href="{{route('admin.eposide.edit', $link->id)}}" class="btn btn-primary btn-mini" >ویرایش</a></td>
                                   @else
                                   <td></td>
                             @endif
                        {{-- <td ><a href="{{route('admin.eposide.delete',$eposide->id)}}" class="btn btn-danger btn-mini">حذف</a></td> --}}

                                  </tr>
                                </tbody>
                                   @endif
                                @endforeach
                                @endif
                                 @else
                                 @if(!empty($eposides) )
                                 @foreach( $eposides as  $eposide)

                                   @if($eposide->destroy == 2)
                                 <tbody>

                                  <tr class="gradeU">
                                    <td>{{$i++}}</td>
                                    <td>{{$eposide->name}}</td>
                                  <td>{{$eposide->course->user['name']}}</td>
                                  <td>{{$eposide->time}}</td>
                                  <td>{{$eposide->type}}</td>
                                  <td>{{$eposide->url}}</td>
                                  <td><a href="{{$eposide->download()}}"><img src="{{url('/front/images/down.png')}}" style="width: 20px"></a></td>
                                  @if(auth()->user()->role=='admin')
                                   @if($eposide->status == 0)
                                   <td><a  href="{{route('active.eposide',$eposide->id)}}"  class="btn btn-success btn-mini">فعال</a></td>
                                       @else
                                <td ><a  href="{{route('inactive.eposide',$eposide->id)}}" class="btn btn-danger btn-mini">غیر فعال</a></td>
                                @endif
                                @else
                                <td></td>
                            @endif
                            @if( auth()->user()->id==$eposide->user_id)
                        <td><a  href="{{route('admin.eposide.edit',$eposide->id)}}" class="btn btn-primary btn-mini" >ویرایش</a></td>
                                   @else
                                   <td></td>
                             @endif
                        {{-- <td ><a href="{{route('admin.eposide.delete',$eposide->id)}}" class="btn btn-danger btn-mini">حذف</a></td> --}}

                                  </tr>
                                </tbody>
                                   @endif
                                @endforeach
                                @endif
                                @endif
                                </table>



                             </div>
                           </div>
                         <div class="container">

                           <ul class="pagination alternate" >
                            @if(count($sub_courses)>0)
                            {{ $link_eposides->links()}}
                            @else
                            {{$eposides->links()}}
                            @endif

                           </ul>
                         </div>
             </div>

@endsection


