@extends('backend.layouts.app')

@section('style')
<style type="text/css">
   .online-chat-status
   {
      width: 60px;
      height: 20px;
      font-size: 9px !important;
      padding: 5px 5px !important;
      color: #5CB85C !important;
      border: 1px solid #5CB85C;
      border-radius: 30px;
      text-align: center;
   }

   .online-chat-status i
   {
      margin-right: 4px;
   }

 .modal-sm {
      max-width: 500px !important;
  }
   
</style>
@endsection


@section('content')
<!-- start: breadcrumb area -->
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">Chat</a>
               </span>
               <span class="breadcr-separator">
               <i class="fas fa-chevron-right"></i>
               </span>
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ $chat_title }}</a>
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: breadcrumb area -->
<!-- start: main content -->
<div class="main-content chat-page-content">
   <div class="container">
      <!-- start: chat detail section -->
      <section class="chat-detail-section admin-chat other">

         @include('backend.chat._chat')

      </section>
      <!-- end: chat detail section -->
   </div>
</div>




<div class="modal fade" id="getReportMessageModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
         <h4 style="font-size: 20px;" class="modal-title">Report</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" id="SubmitReportFunction" method="post">
        {{ csrf_field() }}
          <input type="hidden" id="get_chat_id" name="chat_id">
          <input type="hidden" id="get_receiver_id" name="receiver_id">
          <div class="modal-body ">
             <label>Message</label>
             <textarea class="form-control" name="reason" id="getReason" required></textarea>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Submit</button>  
          </div>
       </form>
    </div>
  </div>
</div>




<!-- end: main content -->
@endsection

@section('script')
   <script type="text/javascript">
      $('document').ready(function(){

        $('#getMessageChat').delegate('.getReportMessage','click',function(){
            var chat_id = $(this).attr('chat-id');
            var get_receiver_id = $(this).attr('id');

            $('#get_chat_id').val(chat_id);
            $('#get_receiver_id').val(get_receiver_id);

            $('#getReportMessageModal').modal('show');
        });


        $('#getReportMessageModal').delegate('#SubmitReportFunction','submit',function(e){
               e.preventDefault();
               $.ajax({
                  url: "{{ url('report_submit') }}",
                  type: "POST",
                  data: $(this).serialize(),
                  dataType:"json",
                  success:function(response){
                      $('#getReportMessageModal').modal('hide');
                      $('#getReason').val('');
                      swal("Success", response.message, "success");
                  },
              });
         });


        $('body').delegate('.getnewchat','click',function(){
          
            var sender_id = $(this).attr('id');
            var name      = $(this).attr('data-name');

            $('#getChatName').html(name);

            $.ajax({
                url: "{{ url('getchatdata') }}",
                type: "POST",
                data:{
                 "_token": "{{ csrf_token() }}",
                   sender_id:sender_id,
                   chat_history : '{{ $chat_history }}'
                },
                dataType:"json",
                success:function(response){
                     $('#getMessageChat').html(response.success);
                     $('#clear_count_'+sender_id).html('');
                     $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);
                },
              });

         });

         @if(!empty($sender_id))

          var sender_id = '{{ $sender_id }}';
          $('#getChatName').html('{{ ucwords($sender_name->name) . ' '. ucwords($sender_name->last_name) }}');

            $.ajax({
                url: "{{ url('getchatdata') }}",
                type: "POST",
                data:{
                 "_token": "{{ csrf_token() }}",
                   sender_id:sender_id,
                   chat_history : '{{ $chat_history }}'
                },
                dataType:"json",
                success:function(response){
                     $('#getMessageChat').html(response.success);
                     $('#clear_count_'+sender_id).html('');
                     $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);
                },
              });

         @endif


         $('#getMessageChat').delegate('#messaging-form','submit',function(e){


              e.preventDefault();

              $.ajax({
                url: app_base_url+"/api/app_student_contact",
                method: "POST",
                data:$(this).serialize(),
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                dataType:"json",
                 success:function(data){
                    if(data.status) {
                        $('#chat-message').val('');
                        $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);
                        $('#getMessageAppend').append('<div class="single sent"> <div class="inner"><div class="message"><p class="text">'+data.result.message+'</p></div><p class="chat-time">'+data.result.created_date+'</p></div></div>');  
                        $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);
                    }
                 },
               });
    


              //  e.preventDefault();
              //  $.ajax({
              //     url: "{{ url('sendreplychat') }}",
              //     type: "POST",
              //     data: $(this).serialize(),
              //     dataType:"json",
              //     success:function(response){
              //           $('#chat-message').val('');
              //           if(response.success != "")
              //           {
              //             $('#getMessageAppend').append(response.success);  
              //             $(".blank-space").stop().animate({ scrollTop: $(".blank-space")[0].scrollHeight}, 1);
              //           }
              //     },
              // });




         });
         


      });
   </script>
@endsection

