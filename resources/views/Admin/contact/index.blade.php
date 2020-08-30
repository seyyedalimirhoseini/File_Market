@extends('Admin.layout.master')
@section('title')
صفحه تماس با ما
@endsection
@section('content')
 @include('message')

 <div class="container-fluid">

    <div class="widget-box">
             <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
               <h5>ارتباط با ما</h5>
             </div>
             <div class="widget-content nopadding">

               <table class="table table-bordered data-table">
                 <thead>
                   <tr>
                     <th>ردیف</th>
                     <th>نام</th>
                     <th>ایمیل</th>
                     <th>موبایل</th>
                     <th>توضیحات</th>

                      <th>حذف</th>




                   </tr>
                 </thead>
                 <?php $i=1 ?>
                  @foreach($contacts as $contact)

                 <tbody>


                   <tr class="gradeU">
                     <td>{{$i++}}</td>
                     <td>{{$contact->name}}</td>
                     <td>{{$contact->email}}</td>

                     <td>{{$contact->phone}}</td>
                     <td>
                           <a href="#myModal{{$contact->id}}" data-toggle="modal" class="btn btn-info btn-mini">مشاهده</a>

                     </td>








                    <div id="myModal{{$contact->id}}" class="modal hide">
                                               <div class="modal-header">
                                                   <button data-dismiss="modal" class="close" type="button">×</button>
                                                   {{-- <h3>{{$contact->user->name}}</h3> --}}
                                               </div>
                                               <div class="modal-body">
                                                   <p class="text-center">{{$contact->description}}</p>
                                               </div>
                                           </div>

                       <td ><a  href="{{route('admin.contact.delete',$contact->id)}}" class="btn btn-danger btn-mini" >حذف</a></td>
</tr>
                 </tbody>

                 @endforeach
               </table>




             </div>
           </div>
         <div class="container">

           <ul class="pagination alternate" >
           {{$contacts->links()}}
           </ul>
         </div>
</div>
@endsection
