<div class="chat-head responsive d-md-none">
   <h6 class="chat-head-title text-capitalize">All conversations</h6>
</div>
<div class="all-coversation-area">
   <div class="all-conversation-list">
      @foreach($getchatuser as $user)
      <a style="cursor: pointer;" id="{{ $user->connect_user_id }}"  data-name="{{ !empty($user->getconnectuser->name) ? ucwords($user->getconnectuser->name) : '' }} {{ !empty($user->getconnectuser->last_name) ? ucwords($user->getconnectuser->last_name) : '' }}" class="single-chat d-flex getnewchat">
         <div class="user-img">
             <img src="{!! $user->getconnectuser->getImage() !!}" alt="user-image"> 
             @if($user->getconnectuser->OnlineUser())
             <i class="fa fa-circle online-user-chat"></i> 
             @endif
         </div>
         <div  class="user-chat-info">
            <h6 class="user-name" style="text-transform: capitalize;">{{ !empty($user->getconnectuser->name) ? $user->getconnectuser->name : '' }} {{ !empty($user->getconnectuser->last_name) ? $user->getconnectuser->last_name : '' }}
            </h6>
            <p class="message">{{ $user->message }}</p>
            <p class="last-seen">{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
         </div>

           @if(!empty($user->countmessage($user->connect_user_id)))
            <div id="clear_count_{{ $user->connect_user_id }}" class="msg-badge show">
              <div class="badge-inner">
                <i class="fas fa-envelope"></i>
                <span class="number">{{ $user->countmessage($user->connect_user_id) }}</span>
              </div>                      
            </div>
            @endif
            
      </a>

      @endforeach
   </div>
</div>