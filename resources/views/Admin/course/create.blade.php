@extends('Admin.layout.master')
@section('title')
صفحه ایجاد دوره
@endsection
@section('css')
 <link type="text/css" rel="stylesheet" href="{{URL('/admin/css/persian-datepicker.min.css')}}" />
 <link rel="stylesheet" href="{{url('/admin/css/select2.css')}}" />
@endsection
@section('content')
  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="row-fluid">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>ایجاد دوره</h5>
                  </div>
                  <div class="widget-content">
                    <div class="control-group">
                      <form method="post" action="{{route('admin.course.store')}}" enctype="multipart/form-data">
                        @csrf
                      <div class="control-group @if ($errors->has('name')) has-error @endif">
                               <label class="control-label">نام دوره:</label>
                         <div class="controls">
                            <input type="text" name="name" id="name" class="span10 m-wrap" value="{{old('name')}}">
                           <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>
                        </div>
                     </div>
                     <div class="control-group @if ($errors->has('code')) has-error @endif">
                        <label class="control-label">کد شناسایی:</label>
                     <div class="controls">
                        <input type="text" name="code" id="code" class="span10 m-wrap" value="{{old('code')}}">
                        <span class="text-danger" id="code" style="color: red;">{{$errors->first('code')}}</span>
                        </div>
                      </div>

                            <div class="control-group @if ($errors->has('description')) has-error @endif">
                                   <label for="description" class="control-label">توضیحات:</label>
                                     <textarea rows="5" class="form-control" name="description" id="description" >{{ old('description') }}</textarea>
                                     <span class="text-danger" id="description" style="color: red;">{{$errors->first('description')}}</span>

                          </div>
                    <div class="form-group {{$errors->has('courses')?' has-error':''}}">
                            <label for="courses">دوره اصلی:</label>
                            <select name="courses[]" id="courses" class="form-control"  title="دسته بندی مورد نظر را انتخاب کنید" multiple >
                            @foreach($courses as $key=>$value)
                                <option value="{{ $key }}" @if(in_array($key, old('courses',[]))) selected @endif>{{$value}}</option>
                            @endforeach
                            </select>
                            <span class="text-danger" id="file" style="color: red;">{{$errors->first('courses')}}</span>
                    </div>

                <div class="form-group {{$errors->has('categories')?' has-error':''}}">
                        <label for="categories">دسته بندی:</label>
                        <select name="categories[]" id="categories" class="form-control"  title="دسته بندی مورد نظر را انتخاب کنید" multiple >
                        @foreach($categories as $key=>$value)
                            <option value="{{ $key }}" @if(in_array($key, old('categories',[]))) selected @endif>{{$value}}</option>
                        @endforeach
                        </select>
                        <span class="text-danger" id="file" style="color: red;">{{$errors->first('categories')}}</span>
                </div>



                        <div class="control-group {{$errors->has('price')?' has-error':''}}">
                                   <label class="control-label">قیمت دوره:</label>
                                     <div class="controls">

                                 <input type="text" class="span10 m-wrap"  name="price" id="price"  value="{{old('price')}}">

                         </div>
                          <span class="text-danger" id="url" style="color: red;">{{$errors->first('price')}}</span>

                          </div>
                            <div class="form-group   {{$errors->has('image')?' has-error':''}}">
                                 <label for="image" class="control-label">تصویر محصول:</label>
                                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}">
                                     <span class="text-danger" id="image" style="color: red;">{{$errors->first('image')}}</span>
                           </div>


                         <div class="form-actions">
                                    <button type="submit" class="btn btn-success">ذخیره</button>
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

<script src="{{url('/admin/js/select2.min.js')}}"></script>



<script>

     CKEDITOR.replace('description' ,{
                filebrowserUploadUrl : '/admin/panel/upload-image',
                filebrowserImageUploadUrl :  '/admin/panel/upload-image'
            });
            $(document).ready(function() {
                $('#categories').select2();
            });
            $(document).ready(function() {
                $('#courses').select2();
            });

</script>

@endsection
