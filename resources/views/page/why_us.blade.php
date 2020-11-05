@extends('layouts.app')
@section('content')
<!-- start: hero area -->
<section class="hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-4.jpg') }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row justify-content-center align-items-lg-center h-100">
         <!-- hero main content -->
         <div class="col-12 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize">Why US</h2>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div id="main-content" class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <!-- start: all students -->
            <section class="morestudents all-students">
               <div class="section-content">
                  <!-- profile list -->
                  <div class="profile-list">
                     <div class="row single-profile-list wow fadeInUp">
                          <h1 style="color: red;">What is Management?</h1>
                          <p>Management is essential for an organized life and necessary to run all types of management. Good management is the backbone of successful organizations. Managing life means getting things done to achieve life’s objectives and managing an organization means getting things done with and through other people to achieve its objectives.</p><br>
                          <h2 style="color: red;">Definition of Management</h2>
                          <p>Many management thinkers have defined management in their own ways. For example, Van Fleet and Peterson define management, ‘as a set of activities directed at the efficient and effective utilization of resources in the pursuit of one or more goals.’</p>
                          <p>Megginson, Mosley, and Pietri define management as ‘working with human, financial and physical resources to achieve organizational objectives by performing the planning, organizing, leading and controlling functions‘.</p>
                          <p>Whether management is an art or science, will continue to be a subject of debate. However, most management thinkers agree that some form of formal academic management background helps in managing successfully. Practically, all CEO’s are university graduates. Hence, the reason for including business degree programs in all academic institutions.</p>
                     </div>
             
                  </div>
               </div>
            </section>
            <!-- end: all students -->
         </div>
      </div>
   </div>
</div>
<!-- end: main content -->
@endsection
