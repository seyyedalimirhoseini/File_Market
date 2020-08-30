@extends('Front.layout.master')
@section('title')
صفحه درخواست تدریس
@endsection

@section('content')

@include('message')
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">

				  	<h2>درخواست تدریس</h2>
					    <form method="post" action="{{route('request.teach')}}">
					    @csrf
					    	<div {{$errors->has('degree')?' has-error':''}}>
						    	<span><label>آخرین مدرک تحصیلی</label></span>
						    	<span><input type="text" value="" name="degree"></span>
						    	<span class="text-danger" id="degree" style="color: red;">{{$errors->first('degree')}}</span>
						    </div>


						    <div {{$errors->has('resume')?' has-error':''}}>
						    	<span><label>رزومه کاری</label></span>
						    	<span><textarea name="resume"> </textarea></span>
						    	<span class="text-danger" id="resume" style="color: red;">{{$errors->first('resume')}}</span>
						    </div>
						   <div>
						   		<span><input type="submit" value="ارسال"></span>
						  </div>
					    </form>
				  </div>
  				</div>

			  </div>

@endsection



