@extends('Admin.layout.master')

@section('title')
صفحه پروفایل
@endsection

@section('content')
@include('message')
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                @if( empty(\Illuminate\Support\Facades\Auth::user()->avatar['id']) && (Auth::user()->role == 'teacher' || Auth::user()->role =='admin'))
                <div class="alert alert-info alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>برای تدریس باید حساب خود را تکمیل کنید</strong>
                </div>
                @endif
            <div class="widget-box">

                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>

                    <h5>پروفایل</h5>
                </div>
                <div class="widget-content ">
                    <div class="control-group">
                    <form >


                        <div class="control-group">
                            <label class="control-label">نام و نام خانوادگی:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" disabled value="{{auth()->user()->name}}">

                            </div>
                        </div>
                          <div class="control-group">
                           <label class="control-label">ایمیل:</label>
                              <div class="controls">
                                            <input type="text"  name="email" id="email"  disabled value="{{auth()->user()->email}}" >
                               </div>
                            </div>

                     <div class="control-group">
                                            <label class="control-label">موبایل:</label>
                                          <div class="controls">
                                           <input type="text" name="phone" id="phone" disabled value="{{auth()->user()->phone}}" >
                                          </div>
                                        </div>

                            @if(isset($complete))
                                 <div class="control-group">
                                    <label class="control-label">کد ملی:</label>
                                   <div class="controls">
                                     <input type="text" disabled name="nationalcode" id="nationalcode" value="{{$complete->nationalcode}}">

                                   </div>
                                 </div>

                                <label class="control-label">توضیحات در مورد خودتان:</label>
                               <div class="controls">
                                 <textarea  disabled name="description" id="description" rows="10">{{$complete->description}}</textarea>


                                </div>
                                 <div class="controls">
                                <img src="{{url('avatars/')}}/{{$complete->image_pro}}" width="100px" height="100px">
                                </div>
                            @endif
                                    <div class="control-group">
                                          <label for="control-label"></label>
                                         <div class="controls">
                                             <a class="btn btn-success" href="{{Route('avatar.edit',['id'=>auth()->user()->id])}}">ویرایش</a>
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
