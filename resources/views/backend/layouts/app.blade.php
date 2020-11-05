<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>@if(Auth::user()->is_admin == 1) Admin Panel - {{ config('app.name') }} @elseif(Auth::user()->is_admin == 2) Tutor Panel - {{ config('app.name') }} @elseif(Auth::user()->is_admin == 3) Student Panel - {{ config('app.name') }} @else Super Admin Panel - {{ config('app.name') }} @endif </title>
	
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
<body class="{{ !empty($body) ? $body : '' }}">
	<!-- start: pre loader -->
	<div id="preloader-container">
		<div class="spinner"></div>
	</div>
	<!-- end: pre loader -->


	@include('backend.layouts._header')

        @yield('content')

  @include('backend.layouts._footer')

    <div class="modal fade getSetudentData" id="getSetudentData" tabindex="-1" role="dialog" aria-labelledby="studentPop1Title" aria-hidden="true"></div>

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
	


	
	$('#change-language').change(function(){
		var url = $(this).val();
		window.location.href = url;
	});


	function success_message(message) {
		swal("Success", message, "success")
	}

	function error_message(message) {
		swal("Error", message, "error")
	}

	
	function delete_record(url)
	{
		swal({
			title: 'Are you sure?',
			text: "You want to proceed ?",
			type: 'warning',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,
			preConfirm: function() {
			  return new Promise(function() {
		  		window.location.href = url; 
			  });
		    },
			allowOutsideClick: false			  
		});	
	}

	function complete_course(url)
	{
		swal({
			title: 'Are you sure?',
			text: "You want to proceed ?",
			type: 'warning',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, complete it!',
			showLoaderOnConfirm: true,
			preConfirm: function() {
			  return new Promise(function() {
		  		window.location.href = url; 
			  });
		    },
			allowOutsideClick: false			  
		});	
	}


	

	function approve_record(url)
	{
		swal({
			title: 'Are you sure?',
			text: "You want to proceed ?",
			type: 'warning',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, approve it!',
			showLoaderOnConfirm: true,
			preConfirm: function() {
			  return new Promise(function() {
		  		window.location.href = url; 
			  });
		    },
			allowOutsideClick: false			  
		});	
	}

	function reject_record(url)
	{
		swal({
			title: 'Are you sure?',
			text: "You want to proceed ?",
			type: 'warning',
			showCancelButton: true,
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, reject it!',
			showLoaderOnConfirm: true,
			preConfirm: function() {
			  return new Promise(function() {
		  		window.location.href = url; 
			  });
		    },
			allowOutsideClick: false			  
		});	
	}


	

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
