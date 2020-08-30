@extends('Admin.layout.master')
@section('title')
صفحه ویرایش ویدئو
@endsection
@section('css')
    <link type="text/css" href="{{url("/dist/bootstrap-timepicker.min.css")}}" />
@endsection
@section('content')
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>ویرایش ویدئو</h5>
                </div>
                <div class="widget-content ">
                    <div class="control-group">
                    <form  method="post" action="{{route('admin.eposide.update',$eposide->id)}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf

                        <div class="control-group{{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">نام ویدئو:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="{{$eposide->name}}">
                                <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                          <div class="control-group {{$errors->has('time')?' has-error':''}}"  data-align="right" data-autoclose="true">
                                                    <label class="control-label">زمان ویدئو:</label>
                                      <div class="controls">
                                            <input  placeholder="--:--:-" type="text" name="time" id="timepicker2" value="{{$eposide->time}}" >
                                            <span class="text-danger" id="time" style="color: red;">{{$errors->first('time')}}</span>
                                       </div>
                            </div>


                              <div class="form-group {{$errors->has('url')?' has-error':''}}">
                                            <label class="control-label">لینک:</label>
                                     <div class="controls">
                                      <input type="url" class="form-control" name="url" id="url" placeholder="لینک ویدئو را وارد کنید" value="{{$eposide->url}}">
                                      </div>
                                                    <span class="text-danger" id="url" style="color: red;">{{$errors->first('url')}}</span>
                                 </div>

                <div class="form-group {{$errors->has('type')?' has-error':''}}">
                        <label class="control-label">نوع ویدئو:</label>
                         <div class="controls">
                         <select name="type" id="type" class="form-control" >
                                <option>{{$eposide->type}}</option>
                                <option
                                    @if($eposide->course['price'] == 0)
                                 value="رایگان" selected>رایگان</option>
                                 @else
                                <option value="رایگان">رایگان</option>
                                <option value="نقدی">نقدی</option>
                                @endif

                        </select>
                         <span class="text-danger" id="type" style="color: red;">{{$errors->first('type')}}</span>
                         </div>

                </div>

                                               <div class="form-group {{$errors->has('time')?' has-error':''}}">
                                                           <label for="file" class="control-label">فایل دوره:</label>
                                                           <div class="controls">
                                                           <input type="file" class="form-control" name="file" id="file" value="">
                                                          </div>
                                                        <span class="text-danger" id="time" style="color: red;">{{$errors->first('file')}}</span>
                                                 </div>
                                        <div class="controls">
                                       <video width="400" controls>
                                          <source src="{{ asset('storage/eposides/'.$eposide->file)}}" type="video/mp4">
                                            {{-- <source src="{{storage_path('/app/public/eposides/'.$eposide->file) }}" type="video/mp4"> --}}
                                       </video>
                                       </div>

                                        <div class="control-group">
                                            <label for="control-label"></label>
                                            <div class="controls">
                                                <input type="submit" value="بروزرسانی" class="btn btn-success">
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
