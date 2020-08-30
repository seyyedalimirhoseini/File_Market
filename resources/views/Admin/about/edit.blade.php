@extends('Admin.layout.master')
@section('title')
صفحه ویرایش درباره ما
@endsection
@section('content')
  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="row-fluid">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>ویرایش درباره ما</h5>
                  </div>
                  <div class="widget-content">
                    <div class="control-group">
                      <form method="post" action="{{route('admin.about.update',$about->id)}}" enctype="multipart/form-data">
                        @csrf


                            <div class="control-group @if ($errors->has('description')) has-error @endif">
                                   <label for="description" class="control-label">توضیحات:</label>
                                     <textarea rows="5" class="form-control" name="description" id="description" >{{ $about->description }}</textarea>
                                     <span class="text-danger" id="description" style="color: red;">{{$errors->first('description')}}</span>
                          </div>







                            <div class="form-group   {{$errors->has('image')?' has-error':''}}">
                                 <label for="image" class="control-label">تصویر:</label>
                                <input type="file" class="form-control" name="image" id="image" value="{{ $about->image}}">
                                     <span class="text-danger" id="image" style="color: red;">{{$errors->first('image')}}</span>
                           </div>
                           <img src="{{URL('aboutimages/')}}/{{$about->image}}" height="100px" width="100px">

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
