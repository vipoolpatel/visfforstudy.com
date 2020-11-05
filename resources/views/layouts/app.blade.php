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

	<style type="text/css">

	</style>
	@yield('style')
</head>
<body class="{{ $body }} loggedin">
	<!-- start: pre loader -->
	<div id="preloader-container">
		<div class="spinner"></div>
	</div>
	<!-- end: pre loader -->

	 @include('layouts._header')

        @yield('content')

    @include('layouts._footer')


	<!-- scroll to top button -->
	<button type="button" id="scrollTop"><i class="fas fa-chevron-up"></i></button>
	<!--vendor js-->
    <script src="{{ url('assets/js/vendor.js') }}"></script>
	<!--custom js-->
	<script src="{{ url('assets/js/main.js') }}"></script>
	<script src="{{ url('assets/js/sweetalert2.min.js') }}"></script>
	@include('layouts._socket')
	@yield('script')
	<script type="text/javascript">
	@if(!empty(session('success')))
		swal("Success", "{{ session('success') }}", "success")
	@endif
	@if(!empty(session('error')))
		swal("Error", "{{ session('error') }}", "error")
	@endif

	function success_message(message) {
		swal("Success", message, "success")
	}

	function error_message(message) {
		swal("Error", message, "error")
	}




	
	$('#change-language').change(function(){
		var url = $(this).val();
		window.location.href = url;
	});

	$('.SendofferStudent').click(function(){
	      var id = $(this).attr('id');
	      $.ajax({
	         url: "{{ url('findstudent/getPopupLoaddata') }}",
	         type: "POST",
	         data:{
	           "_token": "{{ csrf_token() }}",
	             id:id,
	          },
	          dataType:"json",
	          success:function(response){
	               $('.getSetudentData').html(response.success);
	               $('#getSetudentData').modal('show');
	          },
	        });

	});

	$('#getSetudentData').delegate('#offer-first-fee-free','change',function(){
	      $('#offer-first-fee-amount').val('');
	      if(this.checked)
	      {
	         $('.hide-offer-price').hide();
	         $("#offer-first-fee-amount").prop('required',false);
	      }
	      else
	      {
	         $('.hide-offer-price').show();
	         $("#offer-first-fee-amount").prop('required',true);
	      }
	});


	$('#getSetudentData').delegate('#get_course_id','change',function(){
	      var url =  $('#get_course_id option:selected').attr('data-url');
	      $('#getVideoURLOffer').html('<video controls="" width="100%" height="375"><source  src="'+url+'" type="video/mp4"></video>');
	});


	</script>
</body>
</html>
