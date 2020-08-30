@extends('Admin.layout.master')
@section('title')
صفحه لیست دوره ها
@endsection
@section('content')
{{-- <div id="content-header">
       <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
     </div> --}}
   <!--End-breadcrumbs-->
    @include('message')
   <!--Action boxes-->

     <div class="container-fluid">

        <div class="widget-box">
                 <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                   <h5>لیست دوره ها:</h5>
                 </div>
                 <div class="widget-content nopadding">
                   <table class="table table-bordered data-table">
                     <thead>
                       <tr>
                         <th>ردیف</th>
                         <th>نام</th>
                         <th>کد شناسایی</th>
                         <th>نام مدرس</th>
                         <th>توضیحات</th>
                         <th>نوع دوره</th>
                         <th>تصویر</th>

                         <th>ویرایش</th>
                         <th>حذف</th>

                        <th>آپلود ویدئو</th>
                        <th>تعداد ویدئو</th>
                         <th>وضعیت</th>
                        <th>لیست ویدئو ها</th>

                       </tr>
                     </thead>
                     <?php $i=1 ?>
                      @foreach($courses as $course)
                      <?php

                            $sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

                            $array = array();
                            foreach ( $sub_courses as $key => $value) {
                                $array[$key] = $value->subCourse_id;
                            }
                            // dd($array);
                            $eposides = App\Eposide::whereIn('course_id', $array)->get();


                        ?>
                     <tbody>

                       <tr class="gradeU">
                         <td>{{$i++}}</td>
                         <td>{{$course->name}}</td>
                         <td>{{$course->code}}</td>
                         <td>{{$course->user['name']}}</td>
                         <td>{!! Str::limit($course->description, 20)!!}</td>
                         @if($course->price ==0)
                         <td>رایگان</td>
                         @else
                         <td>نقدی</td>
                         @endif
                         <td><img src="{{URL('images/')}}/{{$course->image}}" height="100px" width="100px"></td>

                         @if( auth()->user()->id==$course->user_id)
                         <td><a  href="{{route('admin.course.edit',$course->id)}}" class="btn btn-primary btn-mini">ویرایش</a></td>
                            @else
                            <td></td>
                         @endif

                         <td ><a  href="{{route('admin.course.delete',$course->id)}}" class="btn btn-danger btn-mini">حذف</a></td>
                         @if(count($sub_courses)>0)
                            <td></td>
                          @else
                         @if( auth()->user()->id==$course->user_id)
                         <td ><a  href="{{route('admin.eposide.create',$course->id)}}" class="btn btn-info btn-mini">آپلود ویدئو</a></td>
                         @else
                         <td></td>
                      @endif
                      @endif
                      @if(count($sub_courses)>0)
                      <td><span class="badge badge-info">{{$eposides->count()}}</span></td>
                        @else
                       <td><span class="badge badge-info">{{$course->eposides()->count()}}</span></td>
                       @endif
                       @if(auth()->user()->role=="admin")

                         @if($course->status == 0)
                                 <td><a  href="{{route('active.course',$course->id)}}"  class="btn btn-success btn-mini">فعال</a></td>
                                     @else
                              <td><a  href="{{route('inactive.course',$course->id)}}"  class="btn btn-danger btn-mini">غیر فعال</a></td>
                              @endif
                              @else
                              <td></td>
                            @endif

                              <td><a  href="{{route('admin.listEposide',$course->id)}}" class="btn btn-warning btn-mini">لیست ویدئو</a></td>

                       </tr>
                     </tbody>
                     @endforeach
                   </table>




                 </div>
               </div>
             <div class="container">

               <ul class="pagination alternate" >
               {{$courses->links()}}
               </ul>
             </div>
 </div>

@endsection


