<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
   @can('isAdmin')
    <li ><a href="{{route('dashboard')}}"><i class="icon icon-home"></i> <span>داشبورد</span></a> </li>
    @endcan
 @cannot('isUser')

    @if( !empty(\Illuminate\Support\Facades\Auth::user()->avatar['id']))
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>دوره ها</span></a>

      <ul>
      <li><a href="{{route('admin.course.index')}}">لیست دوره ها</a></li>
      <li><a href="{{route('admin.course.create')}}">ایجاد دوره</a></li>

      </ul>

    </li>
    @endif
   @endcan
   {{-- @cannot('isUser')
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>ویدئو ها</span></a>
        <ul>
        <li><a href="{{route('admin.eposide.index')}}">لیست ویدئو ها</a></li>


        </ul>
      </li>
      @endcan --}}
      @can('isAdmin')
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>دسته بندی ها</span></a>
        <ul>
        <li><a href="{{route('admin.category.index')}}">لیست دسته بندی ها</a></li>
        <li><a href="{{route('admin.category.create')}}">ایجاد دسته بندی</a></li>

        </ul>
      </li>
      @endcan




    </li>


       @can('isAdmin')
             <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>تخفیف</span></a>
                    <ul>
                    <li><a href="{{route('admin.coupon.index')}}">لیست تخفیفات</a></li>
                    <li><a href="{{route('admin.coupon.create')}}">ایجاد تخفیف</a></li>


                    </ul>
                  </li>


          </li>
            @endcan
            @can('isAdmin')
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>درباره ما</span></a>
                   <ul>
                   <li><a href="{{route('admin.about.index')}}">نمایش درباره ما</a></li>
                   <li><a href="{{route('admin.about.create')}}">ایجاد درباره ما</a></li>


                   </ul>
                 </li>


         </li>
           @endcan

           @can('isAdmin')
           <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>سوالات متداول</span></a>
                  <ul>
                  <li><a href="{{route('admin.faq.index')}}">لیست سوالات متداول</a></li>
                  <li><a href="{{route('admin.faq.create')}}">ایجاد سوالات متداول</a></li>


                  </ul>
                </li>


        </li>
          @endcan
          @can('isAdmin')
          <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>ارتباط با ما</span></a>
                 <ul>
                 <li><a href="{{route('admin.showContact')}}">لیست ارتباط ما</a></li>


                 </ul>
               </li>


       </li>
         @endcan
         @can('isAdmin')
         <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>اسلایدر</span></a>
                <ul>
                <li><a href="{{route('admin.slider.index')}}">لیست اسلایدر</a></li>
                <li><a href="{{route('admin.slider.create')}}">ایجاد اسلایدر</a></li>

                </ul>
              </li>


      </li>
        @endcan
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>سفارشات</span></a>
            <ul>
            <li><a href="{{route('order.show')}}">لیست سفارشات</a></li>


            </ul>
  </li>
  </ul>
</div>
