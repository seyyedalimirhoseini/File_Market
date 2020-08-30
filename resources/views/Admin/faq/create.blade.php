@extends('Admin.layout.master')
@section('title')
صفحه ایجاد سوال
@endsection
@section('content')
  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="row-fluid">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>سوالات متداول</h5>
                  </div>
                  <div class="widget-content">
                    <div class="control-group">
                      <form method="post" action="{{route('admin.faq.store')}}" >
                        @csrf

                        <div class="control-group{{$errors->has('question')?' has-error':''}}">
                            <label class="control-label">سوال:</label>
                            <div class="controls">
                                <input type="text" name="question" id="question" value="{{old('question')}}" >
                                <span class="text-danger" id="question" style="color: red;">{{$errors->first('question')}}</span>
                            </div>
                        </div>


                        <div class="control-group @if ($errors->has('answer')) has-error @endif">
                                   <label for="answer" class="control-label">جواب:</label>
                                     <textarea rows="5" class="form-control" name="answer" id="answer" >{{ old('answer') }}</textarea>
                                     <span class="text-danger" id="answer" style="color: red;">{{$errors->first('answer')}}</span>
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





<script>

     CKEDITOR.replace('answer' ,{
                filebrowserUploadUrl : '/admin/panel/upload-image',
                filebrowserImageUploadUrl :  '/admin/panel/upload-image'
            });


</script>

@endsection
