@extends('Admin.layout.master')



@section('content')

  @include('message')

  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                      <h5>سفارشات</h5>
                  </div>
                  <div class="widget-content nopadding">



                    <table class="table table-bordered data-table">
                                          <thead>
                                            <tr>
                                            <th>ردیف</th>
                                            <th>نام دوره</th>
                                            <th>قیمت</th>
                                            <th>کد تراکنش</th>
                                            <th>نام مشتری</th>
                                            <th>تاریخ خرید</th>
                                            <th>لینک دانلود</th>
                                            @if(auth()->user()->role=="admin")
                                            <th>حذف</th>

                                                @endif
                                            </tr>
                                          </thead>
                                          <?php $i=1 ?>
                                           @foreach($orders as $order)

                                               <tbody>

                                            <tr class="gradeU">
                                              <td>{{$i++}}</td>
                                              <td>{{$order->name}}</td>
                                              <td>{{$order->price}}</td>
                                              <td>{{$order->authority}}</td>
                                             <td>{{$order->user['name']}}</td>
                                                <td>{{jdate($order->created_at)->format('%d,%B ,%Y')}}</td>


                                              <td><a  href="{{route('show',$order->course_id)}}" class="btn btn-primary btn-mini">مشاهده لینک دانلود</a></td>
                                                @if(auth()->user()->role=="admin")
                                              <td><a  href="{{route('order.delete',$order->id)}}" class="btn btn-danger btn-mini ">حذف</a></td>
                                               
                                                @endif
                                            </tr>

                                          </tbody>
                                          @endforeach
                                        </table>

                     <div class="container">

                              <ul class="pagination alternate" >
                                  {{$orders->links()}}
                              </ul>
                     </div>

                  </div>
              </div>
          </div>
          </div>
      </div>
@endsection
