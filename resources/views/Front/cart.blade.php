@extends('Front.layout.master')
@section('title')
سبد خرید
@endsection
@section('css')
<style>
    table, th, td {
      border: 1px solid #EEE;
      border-collapse: collapse;
    }
    th, td {
      padding: 15px;
      text-align: center;
    }


    </style>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
  {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
  {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
@endsection

@section('content')
{{-- <script>
    $(document).ready(function(){
$(document).on('click','.remove_item', function () {
    var id= $('#id').val();
    $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/cart/delete';/'+id,
          dataType : 'json',
          type: 'get',
          data: {},
          contentType: false,
          processData: false,
          success:function(response) {
               console.log(response);
          }
     });
      });
    });
   </script> --}}




{{-- @include('message') --}}
@if ($message = Session::get('success'))
<div style="width:100%;height:20%;background-color:#33d9b2;color:#218c74"><strong>{{$message}}</strong></div>
@endif
            <div class="row">
                       <!--Middle Part Start-->
                       <div id="content" class="col-sm-12">
                           <h1 class="title">سبد خرید</h1>


<table style="width:100%">
    <thead>
        <tr>

            <td >نام محصول</td>
            <td>کد شناسایی</td>
            <td >قیمت واحد</td>
            <td >تعداد</td>
            <td >قیمت کل</td>
            <td>عملیات</td>
        </tr>
        </thead>
        @if(Cart::content()->isEmpty())
            <tr>
                <td>سبد خرید شما خالی می باشد.</td>
            </tr>
            @else
        @foreach(Cart::content() as $cart)
    <tr>
      <td>{{$cart->name}}</td>
    <td>{{$cart->options->code}}</td>
      <td>{{$cart->price}}تومان</td>
      <td>
          <input disabled="disabled" class="cart_quantity_input" type="text" name="quantity" value="{{$cart->qty}}" autocomplete="off" size="2">
      </td>
      <td>
        {{$cart->qty * $cart->price}}تومان
      </td>
      <td>
        {{-- <button type="submit" class="remove_item" >حذف</button>
        <input type="hidden" id="id" value="{{$cart->rowId}}"/> --}}
        <a class="remove_item"

            href="{{url('/cart/delete')}}/{{$cart->rowId}}"
                onclick="return confirm('آیا مطمئن هستید ؟  ')">
          <img src="/front/cartImage/delete.png" width="10px" height="10px">
        </a>
      </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="4">جمع کل</td>

          @if(isset($data))
             <td class="text-center">{{$data }} تومان</td>
             @else

           <td class="text-center">{{Cart::initial(0,'','','')  }} تومان</td>
              @endif
       </tr>
       @endif
  </table>
  <br>
  @if(count(Cart::content())>0)

<a style="margin-right: 50%"  href="{{url('/payment')}}" ><< پرداخت >> </a>
  @endif

                       </div>
                   </div>







@endsection
