@extends('Admin.layout.master')
@section('title')
صفحه لیست تخفیفات
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
                   <h5>لیست تخفیف</h5>
                 </div>
                 <div class="widget-content nopadding">
                   <table class="table table-bordered data-table">
                     <thead>
                       <tr>
                         <th>ردیف</th>
                         <th>نام</th>
                          <th>درصد تخفیف</th>
                          <th>تاریخ انقضا</th>
                          <th>وضعیت</th>
                         <th>ویرایش</th>
                         <th>حذف</th>


                       </tr>
                     </thead>
                     <?php $i=1 ?>
                     @foreach($coupons as $coupon)

                     <tbody>

                       <tr class="gradeU">
                         <td>{{$i++}}</td>
                         <td>{{$coupon->name}}</td>
                         <td>{{$coupon->percent}}%</td>
                         <td>{{$coupon->expiry_date}}</td>
                         <td>{{($coupon->status==0)?' غیرفعال':'فعال'}}</td>
                         <td><a  href="{{route('admin.coupon.edit', $coupon->id)}}"  class="btn btn-primary btn-mini">ویرایش</a></td>
                         <td><a  href="{{route('admin.coupon.delete', $coupon->id)}}"  class="btn btn-danger btn-mini">حذف</a></td>
                       </tr>
                     </tbody>
                     @endforeach
                   </table>
                 </div>
               </div>
             <div class="container">

               <ul class="pagination alternate" >
               {{$coupons->links()}}
               </ul>
             </div>
 </div>
@endsection

@section('script')

@endsection
