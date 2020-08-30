<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>@yield('title')</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="{{url('/front/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{url('/front/css/menu.css')}}" rel="stylesheet" type="text/css" media="all"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="/front/js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="{{url('/front/js/jquery-1.7.2.min.js')}}"></script>
<script type="text/javascript" src="{{url('/front/js/nav.js')}}"></script>
<script type="text/javascript" src="{{url('/front/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{url('/front/js/easing.js')}}"></script>
<script type="text/javascript" src="{{url('/front/js/nav-hover.js')}}"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>

<style>
    #pageloader
{
  /* background: rgba( 255, 255, 255, 0.8 );
  display: none;
  /* height: 100%; */
  background: white;
  opacity: 0.5;
  display: none;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

#pageloader img
{
  left: 50%;
  margin-left: -32px;
  margin-top: -32px;
  position: absolute;
  top: 50%;
}
</style>
@yield('css')
</head>
<html>
<body>

 <div class="wrap">
	 @include('Front.partials.header')
           <div class="content">
            @yield('content')


           </div>

  @include('Front.partials.footer')

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script>
    $(document).ready(function(){
  $("#myform").on("submit", function(){
    $("#pageloader").fadeIn();
  });//submit
});//
</script>

 <!-- Latest compiled and minified JavaScript -->

  </script>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
	 		};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="{{url('/front/css/flexslider.css')}}" rel='stylesheet' type='text/css' />
<script defer src="{{url('/front/js/jquery.flexslider.js')}}"></script>
							  <script type="text/javascript">
								$(function(){
								  SyntaxHighlighter.all();
								});
								$(window).load(function(){
								  $('.flexslider').flexslider({
									animation: "slide",
									start: function(slider){
									  $('body').removeClass('loading');
									}
								  });
							});
							  </script>
  <script  src="{{url('/front/js/sweetalert.min.js')}}"></script>

@yield('script')
@include('sweet::alert')
</body>
</html>


