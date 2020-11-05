<div class="chatbox">

   <div class="user-info">
      <div class="row">
         <div class="col-12 col-lg-7">
            <div class="profile-list-bio">
               <div class="bio-image">
                  <div class="profile-image">
                     <img src="{!! $user->getImage() !!}" alt="profile-picture">
                  </div>
               </div>
               <div class="bio-desc">
                  <h3 class="profile-name">{{ ucwords($user->name) }} {{ ucwords($user->last_name) }}</h3>
                  <div class="rating d-flex justify-content-center justify-content-lg-start">
                     <span class="stars">
                      {!! $user->getHTMLRating() !!}
                     </span>
                     <span class="point">{!! $user->totalRating() !!}</span>
                     <span class="text">Reviews</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-5 mt-2 mt-lg-0">
            <div class="lesson-history h-100">
               <div class="lesson-history-items-box">
                  @if(!empty($user->hour_per_rate))
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-money-check-alt"></i>Price For Each Lesson ($)</span>
                     <span class="history-info">{{ $user->hour_per_rate }}</span>
                  </p>
                  @endif
                  @if(!empty($user->getlevelofstudent->level_of_student_name))
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-signal"></i>
                     Level of Education
                     </span>
                     <span class="history-info">
                        {{ ucwords($user->getlevelofstudent->level_of_student_name) }}
                     </span>
                  </p>
                  @endif
                   @if(!empty($user->getcategory->category_name))
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-list"></i>
                     Category
                     </span>
                     <span class="history-info">{{ ucwords($user->getcategory->category_name) }}</span>
                  </p>
                   @endif
                  @if(!empty($user->experience_of_teacher))
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-list"></i>
                     Experience
                     </span>
                     <span class="history-info">{{ ucwords($user->experience_of_teacher) }} Years</span>
                  </p>
                   @endif
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="blank-space">
      <div class="conversations-wrap">
         <div class="single-day" id="getMessageAppend">
            <div class="chat-date">
               {{-- <p class="date">7th Aug 2020</p> --}}
            </div>

            @include('backend.chat._append_chat')

         </div>
      </div>
   </div>





   <div class="chat-message-area">

      <form action="#" class="messaging-form" method="post" id="messaging-form">
          <input type="hidden" value="{{ Auth::user()->getImage() }}" name="profile_pic">
          <input type="hidden" value="{{ Auth::user()->getName() }}" name="name">

         <input type="hidden" name="token" value="{{ Auth::user()->token }}">          
         <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">          
         <input type="hidden" name="receiver_id" id="get_receiver_id_chat" value="{{ $user->id }}">

         <div class="messaging-header d-lg-flex align-items-center justify-content-between">
            <div class="response-type">
            </div>
            <div class="chat-meta d-md-flex align-items-center justify-content-md-between justify-content-lg-end">
              
                  @if(!empty($user->OnlineUser()))
                     <span class="online-chat-status"><span><i class="fas fa-circle"></i></span>Online</span>
                  @else
                   <p class="last-seen">
                     Last Seen {{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}
                     </p>
                  @endif
               
               <p class="local-time thin-colored-text">
                  <span class="flag"><img src="{!! $user->getcountry->getImage() !!}" style="height: 15px;"></span>
                  <span class="time">{!! $user->gettimezonedate() !!}</span>
               </p>
            </div>
         </div>
         @if(empty($chat_history))
         <textarea name="message" id="chat-message" onkeyup="fnCheckForRestrictedWords(this.value)" required class="form-control" placeholder="Type a message here....." cols="10" rows="5"></textarea>
         <div id="getRestrictedMessage" style="color: red;display: none;">Reminder: Never accept or ask for direct payments. Doing so may get your account restricted.</div>
         <div class="message-send-btn-cont text-right" id="SendMessageButton">
            <button type="submit" class="message-send-btn">Send</button>
         </div>
         @endif
      </form>

   </div>


</div>



<script type="text/javascript">
   function fnCheckForRestrictedWords(txtInput) {
        var restrictedWords = new Array(
         @foreach($getbockchat as $block)
         "{{ trim(strtolower($block->name)) }}",
         @endforeach
          "paypal","snapchat");  
        var error = 0;  
        for (var i = 0; i < restrictedWords.length; i++) {  
            var val = restrictedWords[i];  
            if ((txtInput.toLowerCase()).indexOf(val.toString()) > -1) {  
                error = error + 1;  
            }  
        }  

        if (error > 0) {  
            $('#getRestrictedMessage').show();
            $('#SendMessageButton').hide();
        }  
        else {  
            $('#getRestrictedMessage').hide();
            $('#SendMessageButton').show();
        }  
   }
</script>


