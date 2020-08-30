@extends('Admin.layout.master')
@section('title')
صفحه ویرایش پروفایل
@endsection


@section('content')
@include('message')
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>ویرایش پروفایل</h5>
                </div>
                <div class="widget-content ">
                    <div class="control-group">
                    <form  method="post" action="{{Route('avatar.update',['id'=>auth()->user()->id])}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf

                        <div class="control-group {{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">نام و نام خانوادگی:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name"  value="{{auth()->user()->name}}">
                              <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>

                            </div>
                        </div>
                        <div class="control-group {{$errors->has('password')?' has-error':''}}">
                                 <label class="control-label">رمز عبور:</label>
                                 <div class="controls">
                                     <input type="password" name="password" id="password"  value="">
                                      <span class="text-danger" id="password" style="color: red;">{{$errors->first('password')}}</span>

                                </div>
                            </div>
                          <div class="control-group {{$errors->has('password_confirmation')?' has-error':''}}">
                                   <label class="control-label">تکرار رمز عبور:</label>
                                        <div class="controls">
                                            <input type="password" name="password_confirmation" id="password_confirmation"  value="">
                                            <span class="text-danger" id="password_confirmation" style="color: red;">{{$errors->first('password_confirmation')}}</span>

                                      </div>
                           </div>
                          <div class="control-group {{$errors->has('email')?' has-error':''}} ">
                                                    <label class="control-label">ایمیل:</label>
                                      <div class="controls">
                                         <input type="text"  name="email" id="email"   value="{{auth()->user()->email}}" >
                                         <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>

                                       </div>
                            </div>

                     <div class="control-group {{$errors->has('phone')?' has-error':''}}">
                             <label class="control-label">موبایل:</label>
                                  <div class="controls">
                                       <input type="text" name="phone" id="phone"  value="{{auth()->user()->phone}}" >
                                        <span class="text-danger" id="phone" style="color: red;">{{$errors->first('phone')}}</span>

                                   </div>
                             </div>

                            @if(isset($complete))
                                 <div class="control-group {{$errors->has('nationalcode')?' has-error':''}}">
                                    <label class="control-label">کد ملی:</label>
                                   <div class="controls">
                                     <input type="text"  name="nationalcode" id="nationalcode" value="{{$complete->nationalcode}}">
                                      <span class="text-danger" id="nationalcode" style="color: red;">{{$errors->first('nationalcode')}}</span>

                                   </div>
                                 </div>

                                <label class="control-label">توضیحات در مورد خودتان:</label>
                               <div class="controls {{$errors->has('description')?' has-error':''}}">
                                 <textarea  name="description" id="description" rows="10">{{$complete->description}}</textarea>

                                       <span class="text-danger" id="description" style="color: red;">{{$errors->first('description')}}</span>
                                </div>
                                 <div class="form-group {{$errors->has('image_pro')?' has-error':''}}">
                                      <label for="file" class="control-label">تصویر پروفایل:</label>
                                            <div class="controls">
                                                 <input type="file" class="form-control" name="image_pro" id="image_pro" value="">
                                           </div>
                                     <span class="text-danger" id="file" style="color: red;">{{$errors->first('image_pro')}}</span>
                                  </div>
                                 <div class="controls">
                                <img src="{{url('avatars/')}}/{{$complete->image_pro}}" width="100px" height="100px">
                                </div>
                            @endif

                        <div class="control-group">
                            <label for="control-label"></label>
                            <div class="controls ">
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

<script src="{{url('/ckeditor/ckeditor.js')}}"></script>
<script>

 CKEDITOR.replace('description' ,{
                filebrowserUploadUrl : '/admin/panel/upload-image',
                filebrowserImageUploadUrl :  '/admin/panel/upload-image'
            });
</script>
@endsection
