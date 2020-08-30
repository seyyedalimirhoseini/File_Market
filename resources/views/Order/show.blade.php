@extends('Admin.layout.master')



@section('content')

  @include('message')
  <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
              <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                      <h5>سفارشات</h5>
                  </div>
                  <div class="widget-content nopadding">


                    <?php

                    $sub_courses = DB::table('sub_courses')->where('course_id', $course->id)->orderBy('course_id', 'desc')->get();

                           $array = array();
                           foreach ( $sub_courses as $key => $value) {
                               $array[$key] = $value->subCourse_id;
                           }
                        //    dd($array);
                           $eposides = App\Eposide::whereIn('course_id', $array)->get();
                        //    dd($eposides);

                ?>


                        <?php
                            $i=1
                        ?>
                          <ol start="{{$i++}}">
                                @if(count($sub_courses)>0)
                                @foreach($eposides as $item)
                                @if((Auth::user()->role=='teacher' || Auth::user()->role=='user')&& $item->status==1)
                                      <li><a href="{{$item->download()}}">{{$item->name}}</a></li>
                                      @elseif(Auth::user()->role=='admin')
                                      <li><a href="{{$item->download()}}">{{$item->name}}</a></li>
                                      @else
                                            <li></li>
                                @endif
                                @endforeach
                                @else
                                @foreach($course->eposides as $item)
                                @if((Auth::user()->role=='teacher' || Auth::user()->role=='user')&& $item->status==1)
                                      <li><a href="{{$item->download()}}">{{$item->name}}</a></li>
                                      @elseif(Auth::user()->role=='admin')
                                      <li><a href="{{$item->download()}}">{{$item->name}}</a></li>
                                      @else
                                            <li></li>
                                @endif
                                @endforeach
                                @endif

                          </ol>
                  </div>
              </div>
          </div>
          </div>
      </div>
@endsection
