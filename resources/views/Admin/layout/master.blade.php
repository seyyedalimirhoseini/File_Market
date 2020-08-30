<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{url('/admin/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('/admin/css/bootstrap-responsive.min.css')}}" />
{{--<link rel="stylesheet" href="/admin/css/fullcalendar.css" />--}}
<link rel="stylesheet" href="{{url('/admin/css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{url('/admin/css/matrix-media.css')}}" />
<link href="{{url('/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
{{--<link rel="stylesheet" href="/admin/css/jquery.gritter.css" />--}}
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<style>


</style>
@yield('css')


</head>
<body >

<!--Header-part-->

<!--close-Header-part-->


<!--top-Header-menu-->

@include('Admin.partials.nav')

<!--close-top-Header-menu-->
<!--start-top-serch-->

<!--close-top-serch-->
<!--sidebar-menu-->
@include('Admin.partials.sidebar')
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
 @yield('content')
</div>

<!--end-main-container-part-->

<!--Footer-part-->


@include('Admin.partials.footer')
<!--end-Footer-part-->
{{--<script src="{{ mix('js/category.js') }}"></script>--}}


{{--<script src="/admin/js/excanvas.min.js"></script>--}}
<script src="{{url('/admin/js/jquery.min.js')}}"></script>
{{--<script src="/admin/js/jquery.ui.custom.js"></script>--}}
<script src="{{url('/admin/js/bootstrap.min.js')}}"></script>
{{--<script src="/admin/js/jquery.flot.min.js"></script>--}}
{{--<script src="/admin/js/jquery.flot.resize.min.js"></script>--}}
<script src="{{'/admin/js/jquery.peity.min.js'}}"></script>
{{--<script src="/admin/js/fullcalendar.min.js"></script>--}}
<script src="{{url('/admin/js/matrix.js')}}"></script>
{{--<script src="/admin/js/matrix.dashboard.js"></script>--}}
{{--<script src="/admin/js/jquery.gritter.min.js"></script>--}}
{{--<script src="/admin/js/matrix.interface.js"></script>--}}
{{--<script src="/admin/js/matrix.chat.js"></script>--}}
{{--<script src="/admin/js/jquery.validate.js"></script>--}}
{{--<script src="/admin/js/matrix.form_validation.js"></script>--}}
{{--<script src="/admin/js/jquery.wizard.js"></script>--}}
{{--<script src="/admin/js/jquery.uniform.js"></script>--}}

{{--<script src="/admin/js/matrix.popover.js"></script>--}}
{{--<script src="/admin/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="/admin/js/matrix.tables.js"></script>--}}

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
@yield('script')

</body>
</html>
