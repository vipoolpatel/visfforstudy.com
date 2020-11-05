
@if(Auth::check())


<audio controls id="music" style="display: none;">
    <source src="{{ url('upload/mp3/notification.mp3') }}" type="audio/mpeg">
</audio>

{{-- <script src="https://visfforstudy.com:3000/socket.io/socket.io.js"></script> --}}
<script src="http://localhost:3000/socket.io/socket.io.js"></script>

<script type="text/javascript">
	
	// liveserver
	// var app_base_url = 'https://visfforstudy.com:3000';

	// localhost
	var app_base_url = 'http://localhost:3000';

	var socket = io.connect(app_base_url);

	socket.on('connect', function(data) {
	  @if(Auth::check())
	      socket.emit('UpdateSocket', '{"user_id":"{{ Auth::user()->id }}", "auth_token":"{{ Auth::user()->token }}"}');
	  @endif
	});

	var myMusic = document.getElementById("music");


 	socket.on('UpdateSocket', function(data) {
        console.log(data);
    });

 	socket.on('app_student_contact', function(data) {


 		if(data.status) {	



			var sender_id = "{{ Auth::user()->id }}";
			var receiver_id = $('#get_receiver_id_chat').val();

			var api_receiver_id = data.result.sender_id;
			var api_sender_id = data.result.receiver_id;

			console.log(sender_id);
			console.log(receiver_id);

			console.log(api_sender_id);
			console.log(api_receiver_id);

			if(parseInt(sender_id) == parseInt(api_sender_id) && parseInt(receiver_id) == parseInt(api_receiver_id)) {

			    $('#getMessageAppend').append('  <div class="single received"><div class="inner"><div class="message"><p class="text">'+data.result.message+'</p><div class="options"><button class="poper-btn"><i class="fas fa-chevron-down"></i></button><div class="options-wrap"><ul class="options-content"><li><a class="getReportMessage" id="'+receiver_id+'" chat-id="'+data.result.id+'" style="cursor: pointer;">Report</a></li></ul></div></div></div><p class="chat-time">'+data.result.created_date+'</p></div></div>');

				$(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);

				$.ajax({
	                url: "{{ url('update_message_count') }}",
	                type: "POST",
	                data:{
	                 "_token": "{{ csrf_token() }}",
	                   sender_id:receiver_id,
	                },
	                dataType:"json",
	                success:function(response){

	                },
	            });
			}
			else
			{	
			 
				$.ajax({
	                url: "{{ url('get_chat_user') }}",
	                type: "POST",
	                data:{
	                 "_token": "{{ csrf_token() }}"	                  
	                },
	                dataType:"json",
	                success:function(response){
	                	$('#getChatUserChat').html(response.success)
	                },
	            });

	            myMusic.play();
			}
 		}
 		else {

 		}        
    });


</script>

@endif