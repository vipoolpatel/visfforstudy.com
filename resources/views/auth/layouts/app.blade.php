<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--site title-->
	<title>{!! !empty($meta_title) ? $meta_title : '' !!}</title>
	@if(!empty($meta_description))
    	<meta name="description" content="{!! $meta_description !!}" />
	@endif
	@if(!empty($meta_keyword))
		<meta name="keywords" content="{!! $meta_description !!}" />
	@endif
	<!-- site favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ url('assets/img/favicon.png') }}">

	<!--vendor css-->
	<link rel="stylesheet" href="{{ url('assets/css/vendor.css') }}">
	<!--custom css-->
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
	<!--responsive css-->
	<link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/sweetalert2.min.css') }}">

	
</head>
<body class="{{ $body }}">
	<!-- start: pre loader -->
	<div id="preloader-container">
		<div class="spinner"></div>
	</div>
	<!-- end: pre loader -->

	@include('auth.layouts._header')

        @yield('content')

    @include('auth.layouts._footer')

	<!--vendor js-->
    <script src="{{ url('assets/js/vendor.js') }}"></script>
	<!--custom js-->
   	<script src="{{ url('assets/js/main.js') }}"></script>
   		<script src="{{ url('assets/js/sweetalert2.min.js') }}"></script>
		<script type="text/javascript">
	@if(!empty(session('success')))
		swal("Success", "{{ session('success') }}", "success")
	@endif
	@if(!empty(session('error')))
		swal("Error", "{{ session('error') }}", "error")
	@endif

		</script>
</body>
</html>
