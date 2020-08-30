@extends('Admin.layout.master')
@section('title')
صفحه ایجاد تخفیف
@endsection
@section('css')
 <link type="text/css" rel="stylesheet" href="{{url('/admin/css/persian-datepicker.min.css')}}" />
@endsection
@section('content')
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>ایجاد تخفیف</h5>
                </div>
                <div class="widget-content ">
                    <div class="control-group">
                    <form  method="post" action="{{route('admin.coupon.store')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" >
                         @csrf
                     <div class="control-group{{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">نام تخفیف:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="{{old('name')}}" >
                                <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                       <div class="control-group{{$errors->has('percent')?' has-error':''}}">
                          <label class="control-label">درصد تخفیف:</label>
                             <div class="controls">
                               <input type="number" name="percent"  min="0" id="percent" value="{{old('percent')}}" >
                             <span class="text-danger" id="name" style="color: red;">{{$errors->first('percent')}}</span>
                            </div>
                     </div>
                        <div class="control-group{{$errors->has('expiry_date')?' has-error':''}}">
                               <label class="control-label">تاریخ انقضا:</label>
                                      <div class="controls">
                                           <input type="text" name="expiry_date" class="observer-example" id="expiry_date" value="{{old('expiry_date')}}" >
                                          <span class="text-danger" id="expiry_date" style="color: red;">{{$errors->first('expiry_date')}}</span>
                                     </div>
                          </div>


                          <div class="control-group{{$errors->has('status')?' has-error':''}}">
                                                    <label class="control-label">فعال :</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="status" id="status" value="1">
                                                        <span class="text-danger">{{$errors->first('status')}}</span>
                                                    </div>
                                                </div>

                        <div class="control-group">
                            <label for="control-label"></label>
                            <div class="controls">
                                <input type="submit" value="ایجاد" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


@endsection

@section('script')
     <script type="text/javascript" src="{{URL('/admin/js/persian-date.min.js')}}"></script>
       <script type="text/javascript" src="{{URL('/admin/js/persian-datepicker.js')}}"></script>
          <script type="text/javascript">
                $('.observer-example').persianDatepicker({
                    observer: true,
                    format: 'YYYY/MM/DD',
                    altField: '.observer-example-alt'
                });
            </script>
   @endsection
