@foreach($chat as $value)
      @if(Auth::user()->id == $value->sender_id)
      @if(!empty($value->message))
      <div class="single sent">
         <div class="inner">
            <div class="message">
               <p class="text">{{ $value->message }}</p>
            </div>
            <p class="chat-time">{!! date('Y-m-d h:i A',strtotime($value->created_at)) !!}</p>
         </div>                                 
      </div>
      @endif
      @else
      @if(!empty($value->message))
     <div class="single received">
         <div class="inner">
            <div class="message">
               <p class="text">{{ $value->message }}</p>
               <div class="options">
                  <button class="poper-btn"><i class="fas fa-chevron-down"></i></button>
                  <div class="options-wrap">
                     <ul class="options-content">
                        <li><a class="getReportMessage" id="{{ $user->id }}" chat-id="{{ $value->id }}" style="cursor: pointer;">Report</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <p class="chat-time">{!! date('Y-m-d h:i A',strtotime($value->created_at)) !!}</p>
         </div>                              
      </div>
      @endif
   @endif
@endforeach