@extends('Admin.layout.master')
@section('title')
صفحه ویرایش اسلایدر
@endsection
@section('content')
  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="row-fluid">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>ویرایش اسلایدر</h5>
                  </div>
                  <div class="widget-content">
                    <div class="control-group">
                      <form method="post" action="{{route('admin.slider.update',$slider->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="control-group{{$errors->has('name')?' has-error':''}}">
                            <label class="control-label">نام اسلایدر:</label>
                            <div class="controls">
                                <input type="text" name="name" id="name" value="{{$slider->name}}" >
                                <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>






                            <div class="form-group   {{$errors->has('image')?' has-error':''}}">
                                 <label for="image" class="control-label">تصویر:</label>
                                <input type="file" class="form-control" name="image" id="image" value="{{$slider->image }}">
                                     <span class="text-danger" id="image" style="color: red;">{{$errors->first('image')}}</span>
                           </div>
                           <img src="{{URL('sliderimages/')}}/{{$slider->image}}" height="100px" width="100px">

                         <div class="form-actions">
                                    <button type="submit" class="btn btn-success">بروزرسانی</button>
                            </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

          </div>
          </div>
      </div>


      </div>

@endsection

@section('script')
<!--end-Footer-part-->


<script src="{{url('/ckeditor/ckeditor.js')}}"></script>





<script>

     CKEDITOR.replace('description' ,{
                filebrowserUploadUrl : '/admin/panel/upload-image',
                filebrowserImageUploadUrl :  '/admin/panel/upload-image'
            });


</script>

@endsection
