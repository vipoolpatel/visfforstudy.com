@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .grid-view
      {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      }
</style>
@endsection 
@section('content')
<!-- start: hero area -->
<section class="hero-area loggedin-hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-5.jpg') }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row align-items-lg-center h-100">
         <!-- hero main content -->
         <div class="col-12 col-lg-11 offset-lg-1 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize">Permission</h2>
               
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <!-- start: request section -->
            <section class="booking-section">
               <div class="row">
                  <div class="col-lg-11 offset-lg-1">
                     <div class="find-multi-search-box booking-form-container">
                        <form action="{{ url('admin/admin/update_permission') }}" method="post" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <input type="hidden" name="user_id" value="{{ Request::segment(4) }}">
                         
                            
                              <div class="grid-view">
                                 @foreach($getrecord as $value)
                               <div>
                                   <label style="font-weight: normal;margin-right: 20px;">
                                   <input  type="checkbox" name="permission[]" value="{{ $value->id }}"> {{ $value->name }}
                                   </label>
                               </div>
                                 
                                 @endforeach
                              </div>
                              
                    
                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Update') }}</button>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   var user_id = {{ Request::segment(4) }}; 
   my_fun(user_id);
   
     function my_fun(user_id){
    
        var user_id = user_id;
     
        $.ajax({
           url: '{{ url('admin/admin/get_permission') }}',
           data: { user_id: user_id,  
              "_token": "{{ csrf_token() }}"
              },
           dataType: 'json',
           type: 'POST',
           success: function (data) {
   
             $.each(data, function(key, role) {
               for (var i = 0; i < role.length; i++){
                 // console.log(i);
                 $('input[value=' + role[i].permission_id + ']').prop('checked', true);
   
               }
   
       });
   
     }
       });
   
   };
   
</script>
@endsection
