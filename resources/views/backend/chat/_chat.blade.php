<div class="section-content">
   <!-- chat page heading -->
   <div class="chat-page-heading d-none d-md-block">
      <div class="row">
         <div class="col-md-6 col-lg-4">
            <div class="chat-head">
               <h6 class="chat-head-title text-capitalize">All conversations</h6>
            </div>
         </div>
         <div class="col-md-6 col-lg-8">
            <div class="chat-head">
               <h3 class="chat-head-title user-name" id="getChatName">Chat</h3>
            </div>
         </div>
      </div>
   </div>
   <!-- chat main content -->
   <div class="row">
      <div class="col-md-6 col-lg-4 order-2 order-md-1 mt-4 mt-md-0" id="getChatUserChat">
         @include('backend.chat._user')
      </div>
      <div class="col-md-6 col-lg-8 order-1 order-md-2">
         <div class="chat-head responsive d-md-none">
            <h3 class="chat-head-title user-name">Alicia Martin</h3>
         </div>
         <div class="chatbox-area" id="getMessageChat"></div>
      </div>
   </div>
</div>

