@extends('Admin.layout.master')
@section('title')
صفحه دسته بندی ها
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
                   <h5>دسته بندی ها</h5>
                 </div>
                 <div class="widget-content nopadding">
                   <table class="table table-bordered data-table">
                     <thead>
                       <tr>
                         <th>ردیف</th>
                         <th>نام</th>
                           <th>دسته بندی اصلی</th>
                           <th>وضعیت</th>
                         <th>ویرایش</th>
                         <th>حذف</th>


                       </tr>
                     </thead>
                     <?php $i=1 ?>
                      @foreach($categories as $category)
                       <?php
                            $parent_cates = DB::table('categories')->select('name')->where('id',$category->parent_id)->get();
                        ?>
                     <tbody>

                       <tr class="gradeU">
                         <td>{{$i++}}</td>
                         <td>{{$category->name}}</td>
                         <td>
                            @foreach($parent_cates as $parent_cate)
                               {{$parent_cate->name}}
                            @endforeach
                        </td>
                    <td>{{$category->status==1?'فعال':'غیرفعال'}}</td>
                         <td><a  href="{{route('admin.category.edit',$category->id)}}"  class="btn btn-primary btn-mini">ویرایش</a></td>
                         <td ><a  href="{{route('admin.category.delete',$category->id)}}"  class="btn btn-danger btn-mini ">حذف</a></td>
                       </tr>
                     </tbody>
                     @endforeach
                   </table>
                 </div>
               </div>
             <div class="container">

               <ul class="pagination alternate" >
               {{$categories->links()}}
               </ul>
             </div>
 </div>
@endsection

@section('script')

@endsection
