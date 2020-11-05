<div class="single sent">
   <div class="inner">
      <div class="message">
         <p class="text">{!! $chat->message !!}</p>
      </div>
      <p class="chat-time">{!! date('Y-m-d h:i A',strtotime($chat->created_at)) !!}</p>
   </div>
</div>