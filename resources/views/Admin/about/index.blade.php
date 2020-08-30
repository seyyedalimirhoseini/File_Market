@extends('Admin.layout.master')
@section('title')
صفحه لیست درباره ما
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
                   <h5>لیست درباره ما</h5>
                 </div>
                 <div class="widget-content nopadding">
                   <table class="table table-bordered data-table">
                     <thead>
                       <tr>
                         <th>ردیف</th>
                         <th>عکس</th>
                            <th>توضیحات</th>
                         <th>ویرایش</th>
                         <th>حذف</th>


                       </tr>
                     </thead>
                     <?php $i=1 ?>
                     @foreach($abouts as $about)

                     <tbody>

                       <tr class="gradeU">
                         <td>{{$i++}}</td>
                         <td><img src="{{URL('aboutimages/')}}/{{$about->image}}" height="100px" width="100px"></td>
                         <td>{!! Str::limit($about->description, 20)!!}</td>

                         <td><a class="tip" href="{{route('admin.about.edit', $about->id)}}" data-original-title="ویرایش" class="btn btn-primary btn-mini">ویرایش</a></td>
                         <td class="center"><a class="tip" href="{{route('admin.about.delete', $about->id)}}" data-original-title="حذف" class="btn btn-danger btn-mini ">حذف</a></td>
                       </tr>
                     </tbody>
                     @endforeach
                   </table>
                 </div>
               </div>
             <div class="container">

               <ul class="pagination alternate" >
               {{$abouts->links()}}
               </ul>
             </div>
 </div>
@endsection

@section('script')

@endsection
