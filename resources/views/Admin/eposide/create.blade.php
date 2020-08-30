@extends('Admin.layout.master')
@section('title')
صفحه ایجاد ویدئو
@endsection
@section('css')
{{--<link rel="stylesheet" type="text/css" href="{{url('/dist/bootstrap-clockpicker.min.css')}}">--}}
<link type="text/css" href="{{url("/dist/bootstrap-timepicker.min.css")}}" />

@endsection

@section('content')

<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>اضافه کردن ویدئو</h5>
                </div>
                <div class="widget-content ">
                    <div class="control-group">
                    <form  method="post" action="{{route('admin.eposide.store',$course->id)}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf

                        <div class="control-group{{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">نام ویدئو:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="{{old('name')}}">
                                <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                          <div class="control-group  {{$errors->has('time')?' has-error':''}}"   >
                                                    <label class="control-label">زمان ویدئو:</label>
                                      <div class="controls">
                                            <input type="text" placeholder="--:--:-"  name="time" id="timepicker2" value="{{old('time')}}" >

                                            <span class="text-danger" id="time" style="color: red;">{{$errors->first('time')}}</span>

                                       </div>
                            </div>
                    {{--<div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">--}}
                        {{--<input type="text" class="form-control" value="13:14">--}}
                        {{--<span class="input-group-addon">--}}
                            {{--<span class="glyphicon glyphicon-time"></span>--}}
                        {{--</span>--}}
                    {{--</div>--}}
                     <div class="control-group">
                                            <label class="control-label">نام دوره:</label>
                                          <div class="controls">
                                           <input type="text" name="course_id" id="course_id" disabled value="{{$course->name}}" >
                                           <span class="text-danger" id="time" style="color: red;">{{$errors->first('time')}}</span>
                                            </div>
                                        </div>
                               <div class="form-group {{$errors->has('url')?' has-error':''}}">
                                         <label class="control-label">لینک:</label>
                                          <div class="controls">
                                      <input type="url" class="form-control" name="url" id="url" placeholder="لینک ویدئو را وارد کنید" value="{{old('url')}}">
                                        </div>
                                    <span class="text-danger" id="url" style="color: red;">{{$errors->first('url')}}</span>
                                </div>

                <div class="form-group {{$errors->has('type')?' has-error':''}}">
                        <label class="control-label">نوع ویدئو:</label>
                         <div class="controls">
                         <select name="type" id="type" class="form-control" >
                                <option
                                @if($course->price =='0')
                                value="رایگان" selected>رایگان</option>
                                @else
                                    <option value="رایگان">رایگان</option>
                                 <option value="نقدی">نقدی</option>
                                @endif



                        </select>
                         <span class="text-danger" id="type" style="color: red;">{{$errors->first('type')}}</span>
                         </div>

                </div>

                         <div class="form-group {{$errors->has('file')?' has-error':''}}">
                                     <label for="file" class="control-label">فایل دوره:</label>
                                     <div class="controls">
                                     <input type="file" class="form-control" name="file" id="file" value="">
                                    </div>
                                  <span class="text-danger" id="file" style="color: red;">{{$errors->first('file')}}</span>
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
    <script type="text/javascript" src="{{url("/dist/bootstrap-timepicker.min.js")}}"></script>
    <script type="text/javascript">
        $('#timepicker2').timepicker({
            minuteStep: 1,
            template: 'modal',
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
    </script>
@endsection
