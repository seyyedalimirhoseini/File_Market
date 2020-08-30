@extends('Admin.layout.master')
@section('content')
{{-- <div id="content-header">
       <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
     </div> --}}
   <!--End-breadcrumbs-->

   <!--Action boxes-->
   @include('message')
     <div class="container-fluid">
       <div class="quick-actions_homepage">
         <ul class="quick-actions">
           <li class="bg_lb"> <a href="index.html"> <i class="icon-dashboard"></i> <span class="label label-important">20</span> My Dashboard </a> </li>
           <li class="bg_lg span3"> <a href="charts.html"> <i class="icon-signal"></i> Charts</a> </li>
           <li class="bg_ly"> <a href="widgets.html"> <i class="icon-inbox"></i><span class="label label-success">101</span> Widgets </a> </li>
           <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
           <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
           <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
           <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
           <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
           <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
           <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>

         </ul>
       </div>



             <div class="container-fluid">

                <div class="widget-box">
                         <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                           <h5>درخواست برای تدریس</h5>
                         </div>
                         <div class="widget-content nopadding">

                           <table class="table table-bordered data-table">
                             <thead>
                               <tr>
                                 <th>ردیف</th>
                                 <th>نام</th>
                                 <th>مدرک تحصیلی</th>
                                 <th>نقش</th>
                                 <th>رزومه کاری</th>
                                  <th>سطح دسترسی</th>
                                  <th>بروزرسانی</th>
                                  <th>حذف</th>




                               </tr>
                             </thead>
                             <?php $i=1 ?>
                              @foreach($teaches as $teach)

                             <tbody>
                                <form  method="post" action="{{route('admin.update.role',$teach->user->id)}}">
                                    @csrf
                               <tr class="gradeU">
                                 <td>{{$i++}}</td>
                                 <td>{{$teach->user['name']}}</td>
                                 <td>{{$teach->degree}}</td>
                                 <td>{{$teach->user['role']}}</td>
                                 <td>
                                       <a href="#myModal{{$teach->id}}" data-toggle="modal" class="btn btn-info btn-mini">مشاهده</a>

                                 </td>
                                 <td>
                                    <div class="form-group">

                                             <div class="controls">
                                                  <select name="role" id="type" class="form-control" >
                                                        <option value="admin">مدیر</option>
                                                        <option value="teacher">استاد</option>
                                                        <option value="user">کاربر</option>


                                                  </select>

                                              </div>

                                   </div>

                                 </td>

                                <td >
                                  <input type="submit" value="بروزرسانی" class="btn btn-success"></td>






                                <div id="myModal{{$teach->id}}" class="modal hide">
                                                           <div class="modal-header">
                                                               <button data-dismiss="modal" class="close" type="button">×</button>
                                                               <h3>{{$teach->user->name}}</h3>
                                                           </div>
                                                           <div class="modal-body">
                                                               <p class="text-center">{{$teach->resume}}</p>
                                                           </div>
                                                       </div>
                                 </form>
                                   <td ><a   href="{{route('admin.delete.teach',$teach->id)}}" class="btn btn-danger btn-mini">حذف</a></td>
</tr>
                             </tbody>

                             @endforeach
                           </table>




                         </div>
                       </div>
                     <div class="container">

                       <ul class="pagination alternate" >
                       {{$teaches->links()}}
                       </ul>
                     </div>
         </div>



 </div>


@endsection
