@extends('Front.layout.master')
@section('title')
صفحه سوالات متداول
@endsection
@section('content')


  <h2> پرسش و پاسخهای متداول</h2>
                <?php $i=1 ?>
                    @foreach ($faqs as $faq )



                      <div class="questions">
                                <h4>{{$i++}}.{{$faq->question}}</h4>
                      <p>{!! $faq->answer !!}</p>
                     </div>

                @endforeach










@endsection
