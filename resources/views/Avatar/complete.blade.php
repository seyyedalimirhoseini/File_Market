@extends('Admin.layout.master')

@section('title')
صفحه تکمیل پروفایل
@endsection
@section('content')
<div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>پروفایل</h5>
                </div>
                <div class="widget-content ">
                    <div class="control-group">
                    <form  method="post" action="{{route('avatar.complete.store')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf

                        <div class="control-group{{$errors->has('nationalcode')?' has-error':''}}">
                            <label class="control-label">کد ملی:</label>
                            <div class="controls">
                                <input type="text" name="nationalcode" id="nationalcode" value="{{old('nationalcode')}}">
                                <span class="text-danger" id="nationalcode" style="color: red;">{{$errors->first('nationalcode')}}</span>
                            </div>
                        </div>

                        <label class="control-label">توضیحات در مورد خودتان:</label>
                     <div class="controls {{$errors->has('description')?' has-error':''}}">
                                 <textarea name="description" id="description" rows="10">{{old('description')}}</textarea>
                                <span class="text-danger" id="description" style="color: red;">{{$errors->first('description')}}</span>

                     </div>

                    <div class="form-group {{$errors->has('image_pro')?' has-error':''}}">
                           <label for="image_pro" class="control-label">تصویر پروفایل:</label>
                             <div class="controls">
                           <input type="file" class="form-control" name="image_pro" id="image_pro" value="">
                           </div>
                        <span class="text-danger" id="image_pro" style="color: red;">{{$errors->first('image_pro')}}</span>
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

<script src="{{url('/ckeditor/ckeditor.js')}}"></script>
<script>

 CKEDITOR.replace('description' ,{
                filebrowserUploadUrl : '/admin/panel/upload-image',
                filebrowserImageUploadUrl :  '/admin/panel/upload-image'
            });
</script>
@endsection
