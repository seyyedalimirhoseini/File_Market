<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>

</div>
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">{{auth()->user()->name}} سلام </span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="{{route('avatar.show')}}"><i class="icon-user"></i>پروفایل</a></li>
        @if( empty(\Illuminate\Support\Facades\Auth::user()->avatar['id']))
         <li class="divider"></li>
        <li><a href="{{route('avatar.complete')}}"><i class="icon-user"></i>تکمیل پروفایل</a></li>
        @else
        <li class="divider"></li>
        @endif

        <li class="divider"></li>
        {{--<li><a href="#"><i class="icon-check"></i> My Tasks</a></li>--}}
        <li class="divider"></li>
        <li><a href="{{route('logout')}}"><i class="icon-key"></i>خروج</a></li>
      </ul>
    </li>
    {{--<li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>--}}
      {{--<ul class="dropdown-menu">--}}
        {{--<li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>--}}
        {{--<li class="divider"></li>--}}
        {{--<li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>--}}
        {{--<li class="divider"></li>--}}
        {{--<li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>--}}
        {{--<li class="divider"></li>--}}
        {{--<li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>--}}
      {{--</ul>--}}
    {{--</li>--}}
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<div id="search" >
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
