@extends('Admin.layout.master')
@section('title')
صفحه ویرایش دوره
@endsection
@section('css')

<link rel="stylesheet" href="{{url('/admin/css/select2.css')}}" />


@endsection
@section('content')
  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="row-fluid">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>ویرایش دوره</h5>
                  </div>
                  <div class="widget-content">
                    <div class="control-group">
                      <form method="post" action="{{route('admin.course.update',$course->id)}}" enctype="multipart/form-data">
                        @csrf
                      <div class="control-group {{$errors->has('name')?' has-error':''}}">
                               <label class="control-label">نام دوره:</label>
                                   <div class="controls">
                                           <input type="text" name="name" id="name" class="span10 m-wrap" value="{{$course->name}}">
                              <span class="text-danger" id="name" style="color: red;">{{$errors->first('name')}}</span>

                                   </div>
                        </div>
                        <div class="control-group {{$errors->has('code')?' has-error':''}}">
                            <label class="control-label">کد شناسایی:</label>
                                <div class="controls">
                                        <input type="text" name="code" id="code" class="span10 m-wrap" value="{{$course->code}}">
                                         <span class="text-danger" id="code" style="color: red;">{{$errors->first('code')}}</span>

                                </div>
                     </div>

                            <div class="control-group {{$errors->has('description')?' has-error':''}}">
                                   <label for="description" class="control-label">توضیحات:</label>
                                     <textarea rows="5" class="form-control" name="description" id="description" placeholder="توضیحات مربوط به  محصول را بنویسید">{{$course->description}}</textarea>
                                <span class="text-danger" id="file" style="color: red;">{{$errors->first('description')}}</span>
                          </div>

                          <div class="form-group {{$errors->has('courses')?' has-error':''}}">
                            <label for="courses">دوره اصلی:</label>
                            <select name="courses[]" id="courses" class="form-control"  multiple>
                                @foreach($courses as $cour)
                                <option
                                    @foreach($array as $item)
                                         @if($item == $cour->id)
                                        {{"selected"}}
                                        @endif
                                    @endforeach
                                 value="{{$cour->id}}">{{$cour->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="file" style="color: red;">{{$errors->first('courses')}}</span>

                    </div>
                <div class="form-group {{$errors->has('categories')?' has-error':''}}">
                        <label for="categories">دسته بندی:</label>
                        <select name="categories[]" id="categories" class="form-control" title="دسته بندی مورد نظر را انتخاب کنید" multiple>
                            @foreach($categories as $category)
                            <option
                                @foreach($course->categories as $item)
                                     @if($item->id == $category->id)
                                    {{"selected"}}
                                    @endif
                                @endforeach
                             value="{{$category->id}}">{{$category->name}}</option>

                                 @endforeach
                        </select>
                        <span class="text-danger" id="file" style="color: red;">{{$errors->first('categories')}}</span>

                </div>
                  <div class="control-group {{$errors->has('price')?' has-error':''}}">
                                                   <label class="control-label">قیمت دوره:</label>
                                                     <div class="controls">

                                                 <input type="text" class="span10 m-wrap"  name="price" id="price"  value="{{$course->price}}">

                                         </div>
                                          <span class="text-danger" id="url" style="color: red;">{{$errors->first('price')}}</span>

                                          </div>


                            <div class="form-group  {{$errors->has('image')?' has-error':''}}">
                                                <label for="image" class="control-label">تصویر محصول:</label>
                                                <input type="file" class="form-control" name="image" id="image" placeholder="تصویر محصول را وارد کنید" value="{{ $course->image }}">
                                                      <span class="text-danger" id="image" style="color: red;">{{$errors->first('image')}}</span>
                                            </div>
            <img src="{{URL('images/')}}/{{$course->image}}" height="100px" width="100px">

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
