<div class="header">
    <div class="header_top">
        <div class="logo">
            <a href="index.html"><img src="/front/images/logo.png" alt="" /></a>
        </div>
          <div class="header_top_left">
            <div class="search_box">

        <div id="pageloader">
          <img src="/loader/Flip Flop.gif" alt="درحال جستجو" />
        </div>


            <form id="myform" method="GET" action="{{route('search')}}">
          
                    <input type="text" name="q" placeholder="جستجوی دوره" >
                    <input type="submit" value="جستجو">

                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                <a href="{{url('/cart')}}" title="View my shopping cart" rel="nofollow">
                        <strong class="opencart"> </strong>
                            <span class="cart_title">سبد خرید</span>

                            @if(Cart::count() >0)
                            <span >({{Cart::count()}})</span>
                            @else
                                <span class="no_product">(خالی)</span>
                            @endif
                        </a>
                    </div>
              </div>
    <div class="languages" title="لاگین">
        <div id="teacher" class="wrapper-dropdown" tabindex="1"><a href="{{route('login')}}"><img src="/front/images/login.png" alt="" title="login"/></a>
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <strong class="opencart"> </strong>
                    <ul class="dropdown languges">
                         <li>
                             <a href="{{route('teach')}}" title="">
                                <span>مدرس شوید</span>
                            </a>
                         </li>

               </ul>
               @endif
         </div>
         <script type="text/javascript">
        function DropDown(el) {
            this.dd = el;
            this.initEvents();
        }
        DropDown.prototype = {
            initEvents : function() {
                var obj = this;

                obj.dd.on('click', function(event){
                    $(this).toggleClass('active');
                    event.stopPropagation();
                });
            }
        }

        $(function() {

            var dd = new DropDown( $('#teacher') );

            $(document).click(function() {
                // all dropdowns
                $('.wrapper-dropdown').removeClass('active');
            });

        });

    </script>
     </div>

       {{--<div class="login">--}}
              {{--<span><a href="login.html"><img src="/front/images/login.png" alt="" title="login"/></a></span>--}}
       {{--</div>--}}
     <div class="clear"></div>
 </div>
 <div class="clear"></div>
</div>
<div class="menu">
  <ul id="dc_mega-menu-orange" class="dc_mm-orange">
  <li><a href="{{route('index')}}">صفحه اصلی</a></li>



<li><a href="faq.html">دوره های آموزشی</a>
<?php
        $categories=\App\Category::where([['status',1],['parent_id',0]])->get();
    ?>

  <ul>
    @foreach($categories as $category)
    <li><a href="{{route('cats',$category->id)}}">{{$category->name}}</a>
    <?php
                         $sub_categories=DB::table('categories')->select('id','name')->where([['parent_id',$category->id],['status',1]])->get();
          ?>
       @if(count($sub_categories)>0)
            @foreach($sub_categories as $sub_cate)
              <ul>
                <li><a href="{{route('cats',$sub_cate->id)}}">{{$sub_cate->name}}</a></li>

              </ul>
            @endforeach
            @endif
    </li>
@endforeach
  </ul>

</li>
<li><a href="{{route('about')}}">درباره ما</a></li>

<li><a href="{{route('faq')}}">سوالات متداول</a></li>
<li><a href="{{route('contact')}}">تماس با ما</a> </li>
<div class="clear"></div>
</ul>
</div>

</div>
