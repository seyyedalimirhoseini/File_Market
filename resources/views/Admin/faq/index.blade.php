@extends('Admin.layout.master')
@section('title')
صفحه لیست سوالات
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
                   <h5>سوالات متداول</h5>
                 </div>
                 <div class="widget-content nopadding">
                   <table class="table table-bordered data-table">
                     <thead>
                       <tr>
                         <th>ردیف</th>
                         <th>سوال</th>
                            <th>جواب</th>
                         <th>ویرایش</th>
                         <th>حذف</th>


                       </tr>
                     </thead>
                     <?php $i=1 ?>
                     @foreach($faqs as $faq)

                     <tbody>

                       <tr class="gradeU">
                         <td>{{$i++}}</td>
                       <td>{{$faq->question}}</td>
                         <td>{!! Str::limit($faq->answer, 20)!!}</td>

                         <td><a  href="{{route('admin.faq.edit', $faq->id)}}" class="btn btn-primary btn-mini">ویرایش</a></td>
                         <td ><a  href="{{route('admin.faq.delete', $faq->id)}}" class="btn btn-danger btn-mini">حذف</a></td>
                       </tr>
                     </tbody>
                     @endforeach
                   </table>
                 </div>
               </div>
             <div class="container">

               <ul class="pagination alternate" >
               {{$faqs->links()}}
               </ul>
             </div>
 </div>
@endsection

@section('script')

@endsection
